<?php
namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\UserDetailsModel;
use App\Models\UsersModel;

class RegimeController extends BaseController
{
    public function index()
    {
        $model = new RegimeModel();
        $data['regimes'] = $model->findAll();
        
        return view('regimes/index', $data);
    }

    public function addRegime(){
        $regimeModel = new RegimeModel();

        $nom = $this->request->getPost('nom_regime');
        $description = $this->request->getPost('description');
        $viande = $this->request->getPost('viande');
        $volaille = $this->request->getPost('volaille');
        $poisson = $this->request->getPost('poisson');
        $poids_impact = $this->request->getPost('poids_impact_journalier');
        $prix_journalier = $this->request->getPost('prix_journalier');

        $regimeModel->insert([
            'nom_regime' => $nom,
            'description' => $description,
            'pourcentage_viande' => $viande,
            'pourcentage_poisson' => $poisson,
            'pourcentage_volaille' => $volaille,
            'poids_impact_journalier' => $poids_impact,
            'prix_journalier' => $prix_journalier
        ]);

        return redirect()->to('/regimes')->with('succes','Nouveau régime ajouté avec succès.');
    }

    public function addForm(){
        return view('regimes/form');
    }

    public function deleteRegime($id){
        $regimeModel = new RegimeModel();
        $regimeModel->delete($id);
        return redirect()->to('/regimes')->with('succes','Régime supprimé avec succès.');
    }

    public function editRegime($id){
        $regimeModel = new RegimeModel();
        $regime = $regimeModel->find($id);
        if (!$regime) {
            return redirect()->to('/regimes')->with('error', 'Régime introuvable.');
        }
        return view('regimes/form', ['regime' => $regime]);
    }

    public function updateRegime($id){
        $regimeModel = new RegimeModel();

        $nom = $this->request->getPost('nom_regime');
        $description = $this->request->getPost('description');
        $viande = $this->request->getPost('viande');
        $volaille = $this->request->getPost('volaille');
        $poisson = $this->request->getPost('poisson');
        $poids_impact = $this->request->getPost('poids_impact_journalier');
        $prix_journalier = $this->request->getPost('prix_journalier');

        $regimeModel->update($id, [
            'nom_regime' => $nom,
            'description' => $description,
            'pourcentage_viande' => $viande,
            'pourcentage_poisson' => $poisson,
            'pourcentage_volaille' => $volaille,
            'poids_impact_journalier' => $poids_impact,
            'prix_journalier' => $prix_journalier
        ]);

        return redirect()->to('/regimes')->with('succes','Régime mis à jour avec succès.');
    }

    public function getRegimeUser($user_id, $poids_cible){
        $regimeModel = new RegimeModel();
        $userModel = new UsersModel();
        $userDetailsModel = new UserDetailsModel();
        $sportModel = new SportModel();

         if (!$user_id || !$poids_cible) {
            return redirect()->back()->with('error', 'ID utilisateur ou poids cible manquant.');
        }

        $user = $userModel->find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilisateur introuvable.');
        }

        $userDetails = $userDetailsModel->where('user_id', $user_id)->first();
        if (!$userDetails || !isset($userDetails['poids_actuel'])) {
            return redirect()->back()->with('error', 'Les détails du poids actuel sont introuvables pour cet utilisateur.');
        }

        $poids_actuel = (float) $userDetails['poids_actuel'];
        $poids_cible = (float) $poids_cible;
        $diff_poids = $poids_actuel - $poids_cible;

        if ($diff_poids === 0.0) {
            return $this->response->setJSON([
                'user_id' => (int) $user_id,
                'poids_actuel' => $poids_actuel,
                'poids_cible' => $poids_cible,
                'difference_poids' => $diff_poids,
                'couples' => []
            ]);
        }

        $regimes = $regimeModel->findAll();
        $sports = $sportModel->findAll();
        $couples = [];
        $direction = $diff_poids > 0 ? 'prise_de_poids' : 'perte_de_poids';

        foreach ($regimes as $regime) {
            $effet_regime = (float) ($regime['poids_impact_journalier'] ?? 0);
            foreach ($sports as $sport) {
                $effet_jour = (float) ($sport['poids_impact_journalier'] ?? 0);
                $impact_total = $effet_regime + $effet_jour;

                if ($impact_total == 0.0) {
                    continue;
                }

                if ($diff_poids > 0 && $impact_total <= 0) {
                    continue;
                }

                if ($diff_poids < 0 && $impact_total >= 0) {
                    continue;
                }

                $duree = abs($diff_poids) / abs($impact_total);
                $prix_total = $duree * ($regime['prix_journalier'] ?? 0);

                if ($duree <= 0) {
                    continue;
                }

                $couples[] = [
                    'user_id' => (int) $user_id,
                    'poids_actuel' => $poids_actuel,
                    'poids_cible' => $poids_cible,
                    'difference_poids' => $diff_poids,
                    'direction' => $direction,
                    'regime' => $regime,
                    'sport' => $sport,
                    'effet_regime' => $effet_regime,
                    'effet_jour' => $effet_jour,
                    'impact_total' => $impact_total,
                    'duree_jours' => round($duree, 2),
                    'prix_total' => round($prix_total, 2)
                ];
            }
        }

        usort($couples, static function (array $left, array $right): int {
            return $left['duree_jours'] <=> $right['duree_jours'];
        });

        return $this->response->setJSON([
            'user_id' => (int) $user_id,
            'poids_actuel' => $poids_actuel,
            'poids_cible' => $poids_cible,
            'difference_poids' => $diff_poids,
            'direction' => $direction,
            'couples' => $couples,
        ]);

    }

    public function acheterRegime(){
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $userModel = new UsersModel();
        $transactionModel = new TransactionModel();
        $homeController = new Home();

        $user_id = $this->request->getPost('user_id');
        $regime_id = $this->request->getPost('regime_id');
        $sport_id = $this->request->getPost('sport_id');
        $duree_jours = $this->request->getPost('duree_jours');
        $prix_total = $this->request->getPost('prix_total');
        $poids_cible = $this->request->getPost('poids_cible');

         if (!$regime_id || !$sport_id || !$duree_jours || !$prix_total || !$poids_cible) {
            return redirect()->back()->with('error', 'Données du couple régime-sport invalides ou incomplètes.');
        }

        $regime = $regimeModel->find($regime_id);
        $sport = $sportModel->find($sport_id);
        $user = $userModel->find($user_id);

        if (!$regime || !$sport || !$user) {
            return redirect()->back()->with('error', 'Régime, sport ou utilisateur introuvable.');
        }

        if ($user['solde_monnaie'] < $prix_total) {
            return redirect()->back()->with('error', 'Solde insuffisant pour acheter ce régime.');
        }

        // Déduire le prix du régime du solde de l'utilisateur
        $nouveau_solde = (float) $user['solde_monnaie'] - $prix_total;
        $userModel->update($user_id, ['solde_monnaie' => $nouveau_solde]);
        // Inserer une transaction de type debit
        $transactionModel->insert([
            'user_id' => $user_id,
            'type_transaction' => 'debit',
            'description' => 'Achat de régime',
            'montant' => $prix_total,
            'date_transaction' => date('Y-m-d H:i:s'),
        ]);

        // Inserer un achat de regime dans achats_programmes
        $achatModel = new AchatModel();
        $achatModel->insert([
            'user_id' => $user_id,
            'regime_id' => $regime_id,
            'sport_id' => $sport_id,
            'poids_depart' => $couple['poids_actuel'] ?? 0,
            'poids_objectif' => $poids_cible,
            'duree_jours' => $duree_jours,
            'prix_total_paye' => $prix_total,
            'date_achat' => date('Y-m-d H:i:s'),
        ]);
        // Refresh les données de session de l'utilisateur
        $homeController->refreshSessionUserData($user_id);

        return redirect()->to('/monRegime')->with('success', 'Régime acheté avec succès! Votre nouveau solde est de '.$nouveau_solde.' Ar.');
    }

    public function suggestions(){
        $user_id = $this->request->getPost('user_id');
        $poids_cible = $this->request->getPost('poids_cible');
        if (!$user_id || !$poids_cible) {
            return redirect()->back()->with('error', 'ID utilisateur ou poids cible manquant.');
        }
        $couples = $this->getRegimeUser($user_id, $poids_cible);
        return view('regimes/suggestions', ['couples' => $couples]);
    }

    public function monRegime(){
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour accéder à votre régime personnalisé.');
        }

        $achatModel = new AchatModel();
        $derniereAchat = $achatModel->where('user_id', $user_id)->orderBy('date_achat', 'DESC')->first();

        if (!$derniereAchat) {
            return redirect()->to('/regimes')->with('success', 'Vous n\'avez pas encore de régime en cours, veuillez voir les suggestions.');
        }

        $regime = $regimeModel->find($derniereAchat['regime_id']);
        $sport = $sportModel->find($derniereAchat['sport_id']);
        $duree_restante = max(0, $derniereAchat['duree_jours'] - ((time() - strtotime($derniereAchat['date_achat'])) / (60 * 60 * 24)));
        $temps_ecoule = (time() - strtotime($derniereAchat['date_achat'])) / (60 * 60 * 24);
        $poids_estime = $derniereAchat['poids_depart'] + ($regime['poids_impact_journalier'] + $sport['poids_impact_journalier']) * $temps_ecoule;
        $date_fin = date('Y-m-d', strtotime($derniereAchat['date_achat'] . ' + ' . $derniereAchat['duree_jours'] . ' days'));
        $monRegime = [
            'achat' => $derniereAchat,
            'regime' => $regime,
            'sport' => $sport,
            'poids_estime' => $poids_estime,
            'duree_restante' => round($duree_restante, 2),
            'date_fin' => $date_fin
        ];

        return view('regimes/mon_regime', ['monRegime' => $monRegime]);
    }
}
