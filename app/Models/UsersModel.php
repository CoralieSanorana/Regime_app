<?php
namespace App\Models;
use CodeIgniter\Model;
class UsersModel extends Model
{
 protected $table = 'users';
 protected $allowedFields = ['id','nom', 'prenom', 'date_naissance', 'adresse', 'email', 'mot_de_passe', 'genre', 'role', 'is_gold', 'solde_monnaie', 'created_at'];
}
