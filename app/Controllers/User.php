<?php

namespace App\Controllers;

use App\Models\UserModel;

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