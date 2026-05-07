<?php
namespace App\Models;
use CodeIgniter\Model;
class UserDetailsModel extends Model
{
 protected $table = 'user_details';
 protected $allowedFields = ['id','user_id', 'poids_actuel', 'taille', 'update_at'];
}
