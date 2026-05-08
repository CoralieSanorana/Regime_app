<?php
namespace App\Controllers;

use App\Models\AchatModel;

class AchatController extends BaseController
{
    public function index()
    {
        $model = new AchatModel();
        $data['achats'] = $model->findAll();
        
        // This view might not exist yet, but passing data standard way
        return view('achats/index', $data);
    }
}
