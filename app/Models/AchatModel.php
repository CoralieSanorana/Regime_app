<?php
namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table = 'achats_programmes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id', 
        'regime_id', 
        'sport_id', 
        'poids_depart', 
        'poids_objectif', 
        'duree_jours', 
        'prix_total_paye', 
        'date_achat'
    ];
}
