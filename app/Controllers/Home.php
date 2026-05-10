<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UserDetailsModel;

class Home extends BaseController
{
    public function singIn(): string
    {return view('sing_in');}
    
    public function login(){
        $email = $this->request->getPost('email');
        $mot_de_passe = $this->request->getPost('mot_de_passe');
        $userModel = new UsersModel();
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

    public function profil(){
        $userModel = new UsersModel();
        $userDetailsModel = new UserDetailsModel();
        $user_id = session()->get('user_id');
        $user = $userModel->find($user_id);
        if (!$user) {
            return redirect()->to('/')->with('error', 'Utilisateur introuvable.');
        }

        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'user_role' => $user['role'],
            'user_nom' => $user['nom'],
            'user_prenom' => $user['prenom'],
            'user_email' => $user['email'],
            'user_solde' => $user['solde_monnaie'],
            'user_gold' => $user['is_gold'],
        ]);

        $user_details = $userDetailsModel->where(['user_id' => $user_id])->first();
        if (empty($user_details) || !is_array($user_details)) {
            $user_details = [
                'id' => null,
                'poids_actuel' => 0,
                'taille' => 0,
            ];
        }
        $profil = [
            'id' => $user['id'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'date_naissance' => $user['date_naissance'],
            'email' => $user['email'],
            'mot_de_passe' => $user['mot_de_passe'],
            'adresse' => $user['adresse'],
            'genre' => $user['genre'],
            'role' => $user['role'],
            'created_at' => $user['created_at'],
            'is_gold' => $user['is_gold'],
            'solde_monnaie' => $user['solde_monnaie'],
            'details_id' => $user_details['id'],
            // Provide both 'poids_actuel' (DB field) and 'poids' (view expects this)
            'poids_actuel' => isset($user_details['poids_actuel']) ? $user_details['poids_actuel'] : 0,
            'poids' => isset($user_details['poids_actuel']) ? $user_details['poids_actuel'] : 0,
            'taille' => isset($user_details['taille']) ? $user_details['taille'] : 0
        ];

        return view('users/profil', ['profil' => $profil]);
    }

    public function updatePwd(){
        $userModel = new UsersModel();
        $user_id = $this->request->getPost('id');
        $new_password = $this->request->getPost('new_password');
        $old_password = $this->request->getPost('old_password');

        if($new_password != $old_password){
            $userModel->update($user_id, ['mot_de_passe' => $new_password]);
            return redirect()->back()->with('success', 'Mot de passe mis à jour avec succès.');
        } else {
            return redirect()->back()->with('error', 'Error: Le nouveau mot de passe est identique à l\'ancien.');
        }
    }

    public function updateUser(){
        $userModel = new UsersModel();
        $session = session();

        $user_id = $this->request->getPost('id');
        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $date_naissance = $this->request->getPost('date_naissance');
        $email = $this->request->getPost('email');
        $adresse = $this->request->getPost('adresse');
        $genre = $this->request->getPost('genre');

        // Update user info
        $userModel->update($user_id, [
            'nom' => $nom,
            'prenom' => $prenom,
            'date_naissance' => $date_naissance,
            'email' => $email,
            'adresse' => $adresse,
            'genre' => $genre
        ]);

        $this->freshUser($user_id);
        return redirect()->back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updateUserDetails(){
        $userDetailsModel = new UserDetailsModel();
        $userModel = new UsersModel();
        $session = session();

        $user_id = $this->request->getPost('id');
        $details_id = $this->request->getPost('details_id');
        $poids_actuel = $this->request->getPost('poids_actuel');
        $taille = $this->request->getPost('taille');
        $genre = $this->request->getPost('genre');

        if($details_id){
            $userDetailsModel->update($details_id, [
                'poids_actuel' => $poids_actuel,
                'taille' => $taille
            ]);
            $userModel->update($user_id, [
                'genre' => $genre
            ]);
        } else {
            $userDetailsModel->insert([
                'user_id' => $user_id,
                'poids_actuel' => $poids_actuel,
                'taille' => $taille
            ]);
            $userModel->update($user_id, [
                'genre' => $genre
            ]);
        }

        $this->freshUser($user_id);
        return redirect()->back()->with('success', 'Détails du profil mis à jour avec succès.');
    }

    public function freshUser($user_id){
        $userModel = new UsersModel();
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

    public function objectif($user_id){
        $userModel = new UsersModel();
        $userDetailsModel = new UserDetailsModel();
        $user = $userModel->find($user_id);

        if (!$user) {
            return redirect()->to('/')->with('error', 'Utilisateur introuvable.');
        }

        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'user_role' => $user['role'],
            'user_nom' => $user['nom'],
            'user_prenom' => $user['prenom'],
            'user_email' => $user['email'],
            'user_solde' => $user['solde_monnaie'],
            'user_gold' => $user['is_gold'],
        ]);

        $userDetails = $userDetailsModel->where('user_id', $user_id)->first();
        $currentWeight = $userDetails['poids_actuel'] ?? null;

        return view('regimes/objectif', [
            'user' => $user,
            'currentWeight' => $currentWeight,
        ]);
    }

    public function gold($user_id){
        $userModel = new UsersModel();
        $user = $userModel->find($user_id);

        if (!$user) {
            return redirect()->to('/')->with('error', 'Utilisateur introuvable.');
        }

        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'user_role' => $user['role'],
            'user_nom' => $user['nom'],
            'user_prenom' => $user['prenom'],
            'user_email' => $user['email'],
            'user_solde' => $user['solde_monnaie'],
            'user_gold' => $user['is_gold'],
        ]);

        return view('users/gold', [
            'user' => $user,
        ]);
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
            $currentUser = (new UsersModel())->find($userId);
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

        $achats = $db->table('achats_programmes')
            ->select('poids_depart, poids_objectif')
            ->get()
            ->getResultArray();

        foreach ($achats as $achat) {
            $poidsDepart = (float) ($achat['poids_depart'] ?? 0);
            $poidsObjectif = (float) ($achat['poids_objectif'] ?? 0);

            if ($poidsObjectif < $poidsDepart) {
                $objectiveCounts['reduce']++;
            } elseif ($poidsObjectif > $poidsDepart) {
                $objectiveCounts['increase']++;
            } else {
                $objectiveCounts['ideal']++;
            }
        }

        $objectiveChart = [
            ['label' => 'Réduire le poids', 'value' => $objectiveCounts['reduce'], 'color' => '#4ade80'],
            ['label' => 'Augmenter le poids', 'value' => $objectiveCounts['increase'], 'color' => '#60a5fa'],
            ['label' => 'IMC idéal', 'value' => $objectiveCounts['ideal'], 'color' => '#f59e0b'],
        ];

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
