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

    public function exportList()
    {
        $model = new CodeModel();
        return view('codes/export_list', [
            'codes' => $model->findAll(),
        ]);
    }

    public function add()
    {return view('codes/form');}

    public function addCode()
    {
        $model = new CodeModel();
        $data = [
            'code_secret' => $this->request->getPost('code_secret'),
            'montant' => $this->request->getPost('montant'),
            'est_valide' => $this->request->getPost('est_valide')
        ];
        $model->save($data);
        return redirect()->to('/codes')->with('succes', 'Code de recharge ajouté avec succès.');
    }

    public function edit($id)
    {
        $model = new CodeModel();
        $data['code'] = $model->find($id);
        return view('codes/form', ['code' => $data['code'], 'isEdit' => true]);
    }

    public function updateCode($id)
    {
        $model = new CodeModel();
        $data = [
            'code_secret' => $this->request->getPost('code_secret'),
            'montant' => $this->request->getPost('montant'),
            'est_valide' => $this->request->getPost('est_valide')
        ];
        $model->update($id, $data);
        return redirect()->to('/codes')->with('succes', 'Code de recharge mis à jour avec succès.');
    }
}
