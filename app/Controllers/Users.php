<?php
namespace App\Controllers;
use App\Models\UserModel;
class Users extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['Users'] = $model->findAll();
        return view('Users/index', $data);
    }
}
