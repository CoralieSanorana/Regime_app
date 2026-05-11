<?php
namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\AchatModel;
use App\Models\TransactionModel;
use App\Models\UserDetailModel;
use App\Models\UserObjectifModel;
use App\Models\UserModel;

class RegimeController extends BaseController
{
    public function index()
    {
        $model = new RegimeModel();
        $data['regimes'] = $model->findAll();
        
        return view('regimes/index', $data);
    }

    public function exportList()
    {
        $model = new RegimeModel();
        return view('regimes/export_list', [
            'regimes' => $model->findAll(),
        ]);
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
        if (!$user_id || !$poids_cible) {
            return redirect()->back()->with('error', 'ID utilisateur ou poids cible manquant.');
        }
        $couples = $this->calculateCouples($user_id, $poids_cible);

        return $this->response->setJSON([
            'user_id' => (int) $user_id,
            'couples' => $couples,
        ]);

    }

    public function acheterRegime(){
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();
        $userModel = new UserModel();
        $userDetailModel = new UserDetailModel();
        $transactionModel = new TransactionModel();

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

        // Récupérer les détails du poids actuel de l'utilisateur
        $userDetails = $userDetailModel->where('user_id', $user_id)->first();
        $poids_depart = $userDetails ? (float) $userDetails['poids_actuel'] : 0;

        // Verifier que le user n'a pas déjà un régime en cours
        $derniereAchat = $this->getDerniereAchat($user_id);
        if ($derniereAchat) {
            $dateFinAchat = strtotime($derniereAchat['date_achat'] . ' + ' . $derniereAchat['duree_jours'] . ' days');
            if ($dateFinAchat > time()) {
                return redirect()->back()->with('error', 'Vous avez déjà un régime en cours. Veuillez attendre la fin de votre programme actuel avant d\'en acheter un nouveau.');
            }
        }

        $prix_total_paye = (float) $prix_total;
        // Verifier si le user est un GOLD et aplliquer une réduction de 15% 
        if ($user['is_gold']) {
            $prix_total_paye = round($prix_total * 0.85, 2);
        }

        // Verifier que l'utilisateur a suffisamment de solde pour acheter le régime
        if ($user['solde_monnaie'] < $prix_total_paye) {
            return redirect()->back()->with('error', 'Solde insuffisant pour acheter ce régime.');
        }

        // Déduire le prix du régime du solde de l'utilisateur
        $nouveau_solde = (float) $user['solde_monnaie'] - $prix_total_paye;
        $userModel->update($user_id, ['solde_monnaie' => $nouveau_solde]);
        // Inserer une transaction de type debit
        $transactionModel->insert([
            'user_id' => $user_id,
            'type_transaction' => 'debit',
            'description' => 'Achat de régime',
            'montant' => $prix_total_paye,
            'date_transaction' => date('Y-m-d H:i:s'),
        ]);

        // Inserer un achat de regime dans achats_programmes
        $achatModel = new AchatModel();
        $achatModel->insert([
            'user_id' => $user_id,
            'regime_id' => $regime_id,
            'sport_id' => $sport_id,
            'poids_depart' => $poids_depart,
            'poids_objectif' => $poids_cible,
            'duree_jours' => $duree_jours,
            'prix_total_paye' => $prix_total_paye,
            'date_achat' => date('Y-m-d H:i:s'),
        ]);

        // Mettre à jour la session avec le nouveau solde
        session()->set('user_solde', $nouveau_solde);

        return redirect()->to('/monRegime')->with('success', 'Régime acheté avec succès! Votre nouveau solde est de '.$nouveau_solde.' Ar.');
    }

    public function suggestions(){
        // Récupérer user_id et poids_cible depuis POST ou session
        $user_id = $this->request->getPost('user_id') ?? session()->get('user_id') ?? 1;
        $poids_cible = $this->request->getPost('poids_cible');

        // Si poids_cible n'est pas fourni, le récupérer depuis la dernière entrée de user_objectifs
        if (!$poids_cible) {
            $userObjectifModel = new UserObjectifModel();
            $dernier_objectif = $userObjectifModel->where('user_id', $user_id)
                                                    ->orderBy('date_selection', 'DESC')
                                                    ->first();
            if ($dernier_objectif) {
                $poids_cible = $dernier_objectif['poids_cible'];
            } else {
                return redirect()->back()->with('error', 'Aucun objectif trouvé. Veuillez d\'abord définir un objectif.');
            }
        }

        if (!$user_id || !$poids_cible) {
            return redirect()->back()->with('error', 'ID utilisateur ou poids cible manquant.');
        }

        // Calculer les couples régime-sport
        $couples = $this->calculateCouples($user_id, $poids_cible);
        
        return view('regimes/suggestions', ['couples' => $couples, 'user_id' => $user_id, 'poids_cible' => $poids_cible]);
    }

    private function calculateCouples($user_id, $poids_cible) {
        $regimeModel = new RegimeModel();
        $userDetailModel = new UserDetailModel();
        $sportModel = new SportModel();

        // Récupérer les détails de l'utilisateur
        $userDetails = $userDetailModel->where('user_id', $user_id)->first();
        if (!$userDetails) {
            return [];
        }

        $poids_actuel = (float) $userDetails['poids_actuel'];
        $poids_cible = (float) $poids_cible;
        $diff_poids = $poids_actuel - $poids_cible;

        if ($diff_poids === 0.0) {
            return [];
        }

        $regimes = $regimeModel->findAll();
        $sports = $sportModel->findAll();
        $bestByRegime = [];
        $direction = $diff_poids > 0 ? 'prise_de_poids' : 'perte_de_poids';

        foreach ($regimes as $regime) {
            $regimeId = $regime['id'] ?? null;
            if (!$regimeId) {
                continue;
            }

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
                $duree_jours = (int) ceil($duree);

                if ($duree_jours <= 0) {
                    continue;
                }
                $prix_total = $duree_jours * ($regime['prix_journalier'] ?? 0);

                $candidate = [
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
                    'duree_jours' => $duree_jours,
                    'prix_total' => round($prix_total, 2)
                ];

                if (!isset($bestByRegime[$regimeId]) || $duree_jours < $bestByRegime[$regimeId]['duree_jours']) {
                    $bestByRegime[$regimeId] = $candidate;
                }
            }
        }

        $couples = array_values($bestByRegime);

        usort($couples, static function (array $left, array $right): int {
            return $left['duree_jours'] <=> $right['duree_jours'];
        });

        return $couples;
    }

    public function monRegime(){
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour accéder à votre régime personnalisé.');
        }

        $achatModel = new AchatModel();
        $derniereAchat = $this->getDerniereAchat($user_id);

        if (!$derniereAchat) {
            return view('regimes/mon_regime', ['monRegime' => null]);
            return redirect()->to('/regimes')->with('success', 'Vous n\'avez pas encore de régime en cours, veuillez voir les suggestions.');
        }

        $regime = $regimeModel->find($derniereAchat['regime_id']);
        $sport = $sportModel->find($derniereAchat['sport_id']);

        if (!$regime || !$sport) {
            return redirect()->back()->with('error', 'Régime ou sport introuvable.');
        }

        $duree_restante = max(0, $derniereAchat['duree_jours'] - ((time() - strtotime($derniereAchat['date_achat'])) / (60 * 60 * 24)));
        $temps_ecoule = (time() - strtotime($derniereAchat['date_achat'])) / (60 * 60 * 24);
        $jour_actuel = (int) floor($temps_ecoule) + 1;  // Jour courant (1-indexed)
        $jour_actuel = min($jour_actuel, $derniereAchat['duree_jours']);  // Ne pas dépasser la durée
        $poids_estime = round($derniereAchat['poids_depart'] + (($regime['poids_impact_journalier'] ?? 0) + ($sport['poids_impact_journalier'] ?? 0)) * $temps_ecoule, 1);
        $pourcentage_avancement = round(($temps_ecoule / $derniereAchat['duree_jours']) * 100, 1);
        $pourcentage_avancement = min($pourcentage_avancement, 100);  // Ne pas dépasser 100%
        $date_fin = date('Y-m-d', strtotime($derniereAchat['date_achat'] . ' + ' . $derniereAchat['duree_jours'] . ' days'));
        $monRegime = [
            'achat' => $derniereAchat,
            'regime' => $regime,
            'sport' => $sport,
            'poids_estime' => $poids_estime,
            'jour_actuel' => $jour_actuel,
            'duree_restante' => round($duree_restante, 1),
            'pourcentage_avancement' => $pourcentage_avancement,
            'date_fin' => $date_fin
        ];

        return view('regimes/mon_regime', ['monRegime' => $monRegime]);
    }

    public function exportMonRegime()
    {
        $regimeModel = new RegimeModel();
        $sportModel = new SportModel();

        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter pour exporter votre régime.');
        }

        $derniereAchat = $this->getDerniereAchat($user_id);
        if (!$derniereAchat) {
            return redirect()->to('/monRegime')->with('error', 'Aucun régime en cours à exporter.');
        }

        $regime = $regimeModel->find($derniereAchat['regime_id']);
        $sport = $sportModel->find($derniereAchat['sport_id']);

        if (!$regime || !$sport) {
            return redirect()->to('/monRegime')->with('error', 'Régime ou sport introuvable.');
        }

        $temps_ecoule = (time() - strtotime($derniereAchat['date_achat'])) / (60 * 60 * 24);
        $jour_actuel = min((int) floor($temps_ecoule) + 1, (int) $derniereAchat['duree_jours']);
        $poids_estime = round($derniereAchat['poids_depart'] + (($regime['poids_impact_journalier'] ?? 0) + ($sport['poids_impact_journalier'] ?? 0)) * $temps_ecoule, 1);
        $pourcentage_avancement = min(round(($temps_ecoule / $derniereAchat['duree_jours']) * 100, 1), 100);
        $date_fin = date('d/m/Y', strtotime($derniereAchat['date_achat'] . ' + ' . $derniereAchat['duree_jours'] . ' days'));

        $monRegime = [
            'achat' => $derniereAchat,
            'regime' => $regime,
            'sport' => $sport,
            'poids_estime' => $poids_estime,
            'jour_actuel' => $jour_actuel,
            'pourcentage_avancement' => $pourcentage_avancement,
            'date_fin' => $date_fin,
        ];

        return view('regimes/export_mon_regime', ['monRegime' => $monRegime]);
    }

    public function getDerniereAchat($user_id){
        $achatModel = new AchatModel();
        $derniereAchat = $achatModel->where('user_id', $user_id)->orderBy('date_achat', 'DESC')->first();
        return $derniereAchat;
    }
}
