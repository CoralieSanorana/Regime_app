<?php

namespace App\Models;

use CodeIgniter\Model;

class PrixGold extends Model
{
    protected $table = 'prix_gold'; 
    protected $id = 'id';

    protected $allowedFields = [
        'prix' , 'date_mise_a_jour'
    ];
}