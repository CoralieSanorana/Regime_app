<?php
namespace App\Controllers;
use App\Models\CodeModel;
class Code extends BaseController
{
    public function index()
    {
        $model = new CodeModel();
        $data['codes'] = $model->findAll();
        return view('codes/index', $data);
    }
}
