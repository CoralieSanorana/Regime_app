<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom', 'prenom', 'date_naissance', 'email', 
        'mot_de_passe', 'genre', 'role', 'is_gold', 'solde_monnaie'
    ];

    protected $validationRules = [
        'nom'            => 'required|min_length[3]|max_length[50]',
        'prenom'         => 'required|min_length[3]|max_length[50]',
        'date_naissance' => 'required|valid_date',
        'email'          => 'required|valid_email|is_unique[users.email]',
        'mot_de_passe'   => 'required|min_length[3]',
        'mot_de_passe_confirmer' => 'required|matches[mot_de_passe]',
        'genre'          => 'required|in_list[M,F]',
    ];

    protected $validationMessages = [
        'nom' => ['required' => 'Le nom est obligatoire', 'min_length' => 'Minimum 3 caractères'],
        'prenom' => ['required' => 'Le prénom est obligatoire', 'min_length' => 'Minimum 3 caractères'],
        'date_naissance' => ['required' => 'La date de naissance est obligatoire', 'valid_date' => 'Date de naissance invalide'],
        'email' => ['required' => 'L\'email est obligatoire', 'valid_email' => 'Email invalide', 'is_unique' => 'Email déjà utilisé'],
        'mot_de_passe' => ['required' => 'Le mot de passe est obligatoire', 'min_length' => 'Minimum 3 caractères'],
        'mot_de_passe_confirmer' => ['required' => 'La confirmation est obligatoire', 'matches' => 'Les mots de passe ne correspondent pas'],
        'genre' => ['required' => 'Le genre est obligatoire', 'in_list' => 'Genre invalide']
    ];

    // Dates automatiques
    protected $useTimestamps = false;
}