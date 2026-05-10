<?php

namespace App\Models;

use CodeIgniter\Model;

class ObjectifModel extends Model
{
    protected $table = 'objectifs'; 
    protected $id = 'id';

    protected $allowedFields = [
        'libelle' , 'image_url' , 'description'
    ];

}