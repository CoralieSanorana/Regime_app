<?php
namespace App\Models;
use CodeIgniter\Model;
class CodeModel extends Model
{
 protected $table = 'codes_porte_monnaie';
 protected $allowedFields = ['id', 'code_secret', 'montant', 'est_valide'];
}
