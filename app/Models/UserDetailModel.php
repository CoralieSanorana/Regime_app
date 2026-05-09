<?php
namespace App\Models;

use CodeIgniter\Model;

class UserDetailModel extends Model
{
    protected $table = 'user_details';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 'poids_actuel', 'taille'
    ];

    protected $validationRules = [
        'user_id'      => 'required|numeric|is_unique[user_details.user_id]',
        'poids_actuel' => 'required|numeric|greater_than[0]',
        'taille'       => 'required|numeric|greater_than[0]',
    ];

    protected $validationMessages = [
        'user_id' => [
            'required'  => 'L\'ID de l\'utilisateur est obligatoire',
            'is_unique' => 'Cet utilisateur a déjà des informations sanitaires enregistrées'
        ],
        'poids_actuel' => ['required' => 'Le poids est obligatoire', 'greater_than' => 'Le poids doit être positif'],
        'taille'       => ['required' => 'La taille est obligatoire', 'greater_than' => 'La taille doit être positive']
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at'; 
}