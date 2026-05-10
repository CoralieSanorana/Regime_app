<?php

namespace App\Controllers;

use App\Models\UserModel;

class Gold extends BaseController
{
    public function index()
    {
        $user_id = session()->get('user_id') ? session()->get('user_id') : 1;
        $userModel = new UserModel();
        $user = $userModel->find($user_id);
        $is_gold = $user['is_gold'];
        $data['is_gold'] = $is_gold;
        return view('gold',$data);
    }

    public function activate()
    {
        $user_id = session()->get('user_id') ?? 1;
        $userModel = new UserModel();
        $userModel->update($user_id, ['is_gold' => true]);
        return $this->response->setJSON(['status' => 'success']);
    }
}