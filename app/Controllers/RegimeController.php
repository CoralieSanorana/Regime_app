<?php
namespace App\Controllers;

use App\Models\RegimeModel;

class RegimeController extends BaseController
{
    public function index()
    {
        $model = new RegimeModel();
        $data['regimes'] = $model->findAll();
        
        return view('regimes/index', $data);
    }
}
