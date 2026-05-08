<?php
namespace App\Models;
use CodeIgniter\Model;
class SportModel extends Model
{
 protected $table = 'activites_sportives';
 protected $allowedFields = ['nom_activite', 'description', 'effet_jour'];
}
