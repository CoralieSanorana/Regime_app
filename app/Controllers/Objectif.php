<?php

namespace App\Controllers;

class Objectif extends BaseController
{
    public function index(): string
    {
        return view('objectif');
    }
}