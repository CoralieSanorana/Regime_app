<?php
namespace App\Controllers;
use App\Models\CodesModel;
class Code extends BaseController
{
    public function index()
    {
        $model = new CodesModel();
        $data['codes'] = $model->findAll();
        return view('codes/index', $data);
    }

    public function exportList()
    {
        $model = new CodesModel();
        return view('codes/export_list', [
            'codes' => $model->findAll(),
        ]);
    }

    public function add()
    {return view('codes/form');}

    public function addCode()
    {
        $model = new CodesModel();
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
        $model = new CodesModel();
        $data['code'] = $model->find($id);
        return view('codes/form', ['code' => $data['code'], 'isEdit' => true]);
    }

    public function updateCode($id)
    {
        $model = new CodesModel();
        $data = [
            'code_secret' => $this->request->getPost('code_secret'),
            'montant' => $this->request->getPost('montant'),
            'est_valide' => $this->request->getPost('est_valide')
        ];
        $model->update($id, $data);
        return redirect()->to('/codes')->with('succes', 'Code de recharge mis à jour avec succès.');
    }

    public function deleteCode($id)
    {
        $model = new CodesModel();
        $model->delete($id);
        return redirect()->to('/codes')->with('succes', 'Code de recharge supprimé avec succès.');
    }
}
