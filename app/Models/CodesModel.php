<?php

namespace App\Models;

use CodeIgniter\Model;

class CodesModel extends Model
{
    protected $table = 'codes_porte_monnaie';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'code_secret',
        'montant',
        'est_valide'
    ];

    

}