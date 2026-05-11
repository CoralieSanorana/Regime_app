<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserDetailModel;

class Home extends BaseController
{
    public function singIn(): string
    {return view('sing_in');}
    
    public function login(){
        $email = $this->request->getPost('email');
        $mot_de_passe = $this->request->getPost('mot_de_passe');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();    
        if($user && $user['mot_de_passe'] === $mot_de_passe){
            // Use CI session helper for consistent session handling
            $session = session();
            $session->set([
                'user_id' => $user['id'],
                'user_role' => $user['role'],
                'user_nom' => $user['nom'],
                'user_prenom' => $user['prenom'],
                'user_email' => $user['email'],
                'user_solde' => $user['solde_monnaie'],
                'user_gold' => $user['is_gold']
            ]);

            if (($user['role'] ?? 'user') === 'admin') {
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/profil');
        } else {
            return redirect()->to('/')->with('error', 'Email ou mot de passe incorrect.');
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/')->with('success', 'Déconnexion réussie.');
    }

    public function freshUser($user_id){
        $userModel = new UserModel();
        $session = session();

        $freshUser = $userModel->find($user_id);
        if ($freshUser) {
            $session->set([
                'user_id' => $freshUser['id'],
                'user_role' => $freshUser['role'],
                'user_nom' => $freshUser['nom'],
                'user_prenom' => $freshUser['prenom'],
                'user_email' => $freshUser['email'],
                'user_solde' => $freshUser['solde_monnaie'],
                'user_gold' => $freshUser['is_gold'],
            ]);
        }
    }

    public function dashboard(){
        $session = session();
        $userId = $session->get('user_id');
        $userRole = $session->get('user_role');

        if ($userRole !== 'admin') {
            if ($userId) {
                return redirect()->to('/profil');
            }

            return redirect()->to('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $db = db_connect();

        $currentUser = null;
        if ($userId) {
            $currentUser = (new UserModel())->find($userId);
        }

        $totalUsers = (int) $db->table('users')->countAllResults();
        $goldUsers = (int) $db->table('users')->where('is_gold', 1)->countAllResults();

        $walletRow = $db->table('users')
            ->selectSum('solde_monnaie', 'total_solde')
            ->get()
            ->getRowArray();
        $totalWallet = (float) ($walletRow['total_solde'] ?? 0);

        $objectiveCounts = [
            'reduce' => 0,
            'increase' => 0,
            'ideal' => 0,
        ];

        // Récupérer les achats
        $achats = $db->table('achats_programmes ap')
            ->select('ap.user_id, ap.poids_depart, ap.poids_objectif')
            ->get()
            ->getResultArray();

        // Récupérer le dernier objectif choisi pour chaque utilisateur
        $userObjectives = $db->table('user_objectifs uo')
            ->select('uo.user_id, uo.objectif_id')
            ->join('objectifs o', 'o.id = uo.objectif_id', 'left')
            ->orderBy('uo.date_selection', 'DESC')
            ->get()
            ->getResultArray();

        // Créer une map du dernier objectif par utilisateur
        $userLastObjective = [];
        foreach ($userObjectives as $uo) {
            if (!isset($userLastObjective[$uo['user_id']])) {
                $userLastObjective[$uo['user_id']] = $uo['objectif_id'];
            }
        }

        // Récupérer les libellés des objectifs
        $objectifs = $db->table('objectifs')
            ->select('id, libelle')
            ->get()
            ->getResultArray();
        
        $objectiveLabels = [];
        foreach ($objectifs as $obj) {
            $objectiveLabels[$obj['id']] = $obj['libelle'];
        }

        // Compter les objectifs pour chaque achat
        $objectiveCountMap = [];
        foreach ($achats as $achat) {
            $userId = (int) $achat['user_id'];
            
            // Si l'utilisateur a choisi un objectif, l'utiliser
            if (isset($userLastObjective[$userId])) {
                $objectiveId = $userLastObjective[$userId];
                $label = $objectiveLabels[$objectiveId] ?? 'Perdre du Poids';
                $objectiveCountMap[$label] = ($objectiveCountMap[$label] ?? 0) + 1;
            } else {
                // Sinon, déterminer par la comparaison des poids
                $poidsDepart = (float) ($achat['poids_depart'] ?? 0);
                $poidsObjectif = (float) ($achat['poids_objectif'] ?? 0);

                if ($poidsObjectif < $poidsDepart) {
                    $objectiveCountMap['Perdre du Poids'] = ($objectiveCountMap['Perdre du Poids'] ?? 0) + 1;
                } elseif ($poidsObjectif > $poidsDepart) {
                    $objectiveCountMap['Augmenter son Poids'] = ($objectiveCountMap['Augmenter son Poids'] ?? 0) + 1;
                } else {
                    $objectiveCountMap['Atteindre l\'IMC idéal'] = ($objectiveCountMap['Atteindre l\'IMC idéal'] ?? 0) + 1;
                }
            }
        }

        // Préparer les données pour le graphique avec les couleurs appropriées
        $colorMap = [
            'Perdre du Poids' => '#4ade80',
            'Augmenter son Poids' => '#60a5fa',
            'Atteindre l\'IMC idéal' => '#f59e0b',
        ];

        $objectiveChart = [];
        foreach ($objectiveLabels as $id => $label) {
            $objectiveChart[] = [
                'label' => $label,
                'value' => $objectiveCountMap[$label] ?? 0,
                'color' => $colorMap[$label] ?? '#9ca3af',
            ];
        }

        $pieSegments = [];
        $pieOffset = 0;
        $objectiveTotal = array_sum(array_column($objectiveChart, 'value'));
        foreach ($objectiveChart as $item) {
            if ($objectiveTotal <= 0 || $item['value'] <= 0) {
                continue;
            }

            $segment = ($item['value'] / $objectiveTotal) * 100;
            $pieSegments[] = $item['color'] . ' ' . number_format($pieOffset, 2, '.', '') . '% ' . number_format($pieOffset + $segment, 2, '.', '') . '%';
            $pieOffset += $segment;
        }

        $pieBackground = $pieSegments
            ? 'conic-gradient(' . implode(', ', $pieSegments) . ')'
            : 'conic-gradient(#e5e7eb 0% 100%)';

        $popularRegimes = $db->table('achats_programmes ap')
            ->select('ap.regime_id, r.nom_regime, COUNT(*) AS total_achats')
            ->join('regimes r', 'r.id = ap.regime_id', 'left')
            ->groupBy('ap.regime_id, r.nom_regime')
            ->orderBy('total_achats', 'DESC')
            ->limit(6)
            ->get()
            ->getResultArray();

        $maxRegimeCount = 0;
        foreach ($popularRegimes as $regime) {
            $maxRegimeCount = max($maxRegimeCount, (int) ($regime['total_achats'] ?? 0));
        }

        foreach ($popularRegimes as &$regime) {
            $count = (int) ($regime['total_achats'] ?? 0);
            $regime['bar_height'] = $maxRegimeCount > 0 ? round(($count / $maxRegimeCount) * 100) : 0;
            $regime['total_achats'] = $count;
        }
        unset($regime);

        $rechargeTransactions = $db->table('porte_monnaie_transactions t')
            ->select('t.id, t.user_id, t.montant, t.description, t.date_transaction, u.nom, u.prenom')
            ->join('users u', 'u.id = t.user_id', 'left')
            ->like('t.description', 'Recharge via code', 'after')
            ->orderBy('t.date_transaction', 'DESC')
            ->limit(8)
            ->get()
            ->getResultArray();

        foreach ($rechargeTransactions as &$transaction) {
            $code = 'Code non enregistré';
            if (!empty($transaction['description']) && preg_match('/Recharge via code[:\s-]*(.+)$/i', $transaction['description'], $matches)) {
                $code = trim($matches[1]);
            }

            $transaction['code'] = $code;
            $transaction['user_name'] = trim(($transaction['prenom'] ?? '') . ' ' . ($transaction['nom'] ?? ''));
            $transaction['montant_formatted'] = number_format((float) ($transaction['montant'] ?? 0), 0, ',', ' ');
            $transaction['date_formatted'] = !empty($transaction['date_transaction']) ? date('d/m/Y H:i', strtotime($transaction['date_transaction'])) : '-';
        }
        unset($transaction);

        return view('dashboard', [
            'currentUser' => $currentUser,
            'totalUsers' => $totalUsers,
            'goldUsers' => $goldUsers,
            'totalWallet' => $totalWallet,
            'objectiveChart' => $objectiveChart,
            'objectiveCounts' => $objectiveCounts,
            'objectiveTotal' => $objectiveTotal,
            'pieBackground' => $pieBackground,
            'popularRegimes' => $popularRegimes,
            'rechargeTransactions' => $rechargeTransactions,
        ]);
    }
}
