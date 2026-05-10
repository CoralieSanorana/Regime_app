<?php

namespace App\Controllers;

use App\Models\ObjectifModel;

class Objectif extends BaseController
{
    public function index(): string
    {
        $objectifModel = new ObjectifModel();
        $data['objectifs'] = $objectifModel->findAll();

        return view('objectif',$data);
    }
}