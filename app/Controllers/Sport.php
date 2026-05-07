<?php
namespace App\Controllers;
use App\Models\SportModel;
class Sport extends BaseController
{
    public function index()
    {
        $model = new SportModel();
        $data['sports'] = $model->findAll();
        return view('sports/index', $data);
    }
}
