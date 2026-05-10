<?php 

namespace App\Models;

use CodeIgniter\Model;

class UserObjectifModel extends Model
{
    protected $table = 'user_objectifs'; 
    protected $id = 'id';

    protected $allowedFields = [
        'user_id', 'objectif_id','poids_cible' ,'date_selection'
    ];

}