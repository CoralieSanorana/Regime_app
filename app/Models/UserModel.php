<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    // Très important : listez tous les champs que vous voulez autoriser en insertion/modification
    protected $allowedFields = [
        'nom', 
        'prenom', 
        'date_naissance', 
        'email', 
        'mot_de_passe', 
        'genre', 
        'role', 
        'is_gold', 
        'solde_monnaie'
    ];

    // Gestion du temps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // Laissez vide si vous n'avez pas de colonne updated_at

    // Type de retour (facultatif, 'array' par défaut)
    protected $returnType = 'array'; 
}