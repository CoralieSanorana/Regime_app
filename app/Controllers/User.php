<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\UserDetailModel;

class User extends BaseController
{
    /**
     * Affiche la liste de tous les utilisateurs
     */
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return view('users/index', $data);
    }

    public function profil(){
        $userModel = new UserModel();
        $UserDetailModel = new UserDetailModel();
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

        $user_details = $UserDetailModel->where(['user_id' => $user_id])->first();
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
        $userModel = new UserModel();
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
        $userModel = new UserModel();
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

    /**
     * Enregistre un nouvel utilisateur dans la base de données
     */
    public function store()
    {
        $model = new UserModel();

        // Récupération et hachage du mot de passe pour la sécurité
        $password = $this->request->getPost('mot_de_passe');

        $data = [
            'nom'            => $this->request->getPost('nom'),
            'prenom'         => $this->request->getPost('prenom'),
            'date_naissance' => $this->request->getPost('date_naissance'),
            'email'          => $this->request->getPost('email'),
            'mot_de_passe'   => password_hash($password, PASSWORD_DEFAULT),
            'genre'          => $this->request->getPost('genre'),
            'role'           => $this->request->getPost('role') ?? 'user',
            'is_gold'        => $this->request->getPost('is_gold') ? 1 : 0,
            'solde_monnaie'  => $this->request->getPost('solde_monnaie') ?? 0.00,
        ];

        if ($model->insert($data)) {
            return redirect()->to('/users')->with('success', 'Utilisateur créé avec succès !');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    /**
     * Affiche les détails d'un utilisateur spécifique
     */
    public function show($id = null)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);

        if (!$data['user']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Utilisateur introuvable.");
        }

        return view('users/show', $data);
    }

    /**
     * Met à jour le solde d'un utilisateur (Exemple d'action spécifique)
     */
    public function addMoney($id, $amount)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if ($user) {
            $nouveauSolde = $user['solde_monnaie'] + $amount;
            $model->update($id, ['solde_monnaie' => $nouveauSolde]);
            
            return redirect()->back()->with('success', 'Solde mis à jour !');
        }
    }

    /**
     * Supprime un utilisateur
     */
    public function delete($id = null)
    {
        $model = new UserModel();
        $model->delete($id);

        return redirect()->to('/users')->with('success', 'Utilisateur supprimé.');
    }
}