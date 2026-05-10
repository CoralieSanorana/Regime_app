<?php

namespace App\Controllers;

use App\Models\PrixGold;
use App\Models\UserModel;

class Gold extends BaseController
{
    public function index()
    {
        $user_id = session()->get('user_id') ? session()->get('user_id') : 1;
        $userModel = new UserModel();
        $user = $userModel->find($user_id);
        $is_gold = $user['is_gold'];

        $prix_gold = new PrixGold();
        $prix = $prix_gold->orderBy('date_mise_a_jour', 'DESC')->first();
    
        $data['is_gold'] = $is_gold;
        $data['prix'] = $prix['prix'] ?? 30000;
        return view('gold',$data);
    }

    public function activate()
    {
        $user_id = session()->get('user_id') ?? 1;
        $userModel = new UserModel();
        $prix_gold = new PrixGold();
        $prix = $prix_gold->orderBy('date_mise_a_jour', 'DESC')->first();
        $user = $userModel->find($user_id);
        $solde = $user['solde_monnaie'];
        $prix_gold = $prix['prix'] ?? 30000;
        if ($solde >= $prix_gold) {
            $solde_restant = $solde - $prix_gold;
            $userModel->update($user_id, ['solde_monnaie' => $solde_restant]);
            $userModel->update($user_id, ['is_gold' => true]);
        }else{
            return $this->response->setJSON(['status' => 'error', 'message' => 'Solde insuffisant pour activer l\'option Gold.']);
        }
        return $this->response->setJSON(['status' => 'success']);
    }
}