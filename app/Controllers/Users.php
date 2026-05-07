<?php
namespace App\Controllers;
use App\Models\UsersModel;
class Users extends BaseController
{
    public function index()
    {
        $model = new UsersModel();
        $data['Users'] = $model->findAll();
        return view('Users/index', $data);
    }
}
