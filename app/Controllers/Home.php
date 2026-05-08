<?php

namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\UserDetailsModel;

class Home extends BaseController
{
    public function singIn(): string
    {return view('sing_in');}
    
    public function singUp(): string
    {return view('sing_up');}

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

            return redirect()->to('/profil/'.$user['id']);
        } else {
            return redirect()->to('/')->with('error', 'Email ou mot de passe incorrect.');
        }
    }

    public function logout(){
        session()->destroy();
        return redirect()->to('/')->with('success', 'Déconnexion réussie.');
    }

    public function profil($user_id){
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

        return view('profil', ['profil' => $profil]);
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

    public function inscription(){
        $userModel = new UsersModel();

        $nom = $this->request->getPost('nom');
        $prenom = $this->request->getPost('prenom');
        $genre = $this->request->getPost('genre');
        $email = $this->request->getPost('email');
        $adresse = $this->request->getPost('adresse');
        $date_naissance = $this->request->getPost('date_naissance');
        $mot_de_passe = $this->request->getPost('password');
        $confirme_pwd = $this->request->getPost('confirme_password');

        if ($mot_de_passe !== $confirme_pwd) {
            return redirect()->back()->with('error', 'Le mot de passe et la confirmation ne correspondent pas.');
        }

        $userModel->insert([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'adresse' => $adresse,
            'mot_de_passe' => $mot_de_passe,
            'date_naissance' => $date_naissance,
            'genre' => $genre
        ]);

        return redirect()->to('/')->with('success', 'Inscription réussie.');
    }
}