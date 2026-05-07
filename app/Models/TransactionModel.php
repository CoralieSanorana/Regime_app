<?php
namespace App\Models;
use CodeIgniter\Model;
class TransactionModel extends Model
{
 protected $table = 'porte_monnaie_transactions';
 protected $allowedFields = ['id', 'user_id', 'montant', 'type_transaction', 'description', 'date_transaction'];
}
