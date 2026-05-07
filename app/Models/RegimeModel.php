<?php
namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom_regime', 
        'description', 
        'pourcentage_viande', 
        'pourcentage_poisson', 
        'pourcentage_volaille', 
        'poids_impact_journalier', 
        'prix_journalier'
    ];
}
