<?php
namespace App\Controllers;

use App\Models\CodesModel;

class Codes extends BaseController
{
    public function index()
    {
        $model = new CodesModel();
        $data['codes'] = $model->findAll();

        return view('codes/index',$data);
    }

    
}