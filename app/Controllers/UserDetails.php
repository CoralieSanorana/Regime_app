<?php
namespace App\Controllers;
use App\Models\UsersModel;
class UserDetails extends BaseController
{
    public function index()
    {
        $model = new UserDetailsModel();
        $data['UserDetails'] = $model->findAll();
        return view('UserDetails/index', $data);
    }
}
