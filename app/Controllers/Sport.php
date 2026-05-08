<?php
namespace App\Controllers;
use App\Models\SportModel;
class Sport extends BaseController
{
    public function index()
    {
        $model = new SportModel();
        $data['sports'] = $model->findAll();
        return view('sports', $data);
    }

    public function add()
    {return view('sport_form');}

    public function addSport()
    {
        $model = new SportModel();
        $data = [
            'nom_activite' => $this->request->getPost('nom_sport'),
            'description' => $this->request->getPost('description'),
            'effet_jour' => $this->request->getPost('effet_jour'),
        ];
        $model->save($data);
        return redirect()->to('/sports')->with('succes', 'Sport ajouté avec succès.');
    }

    public function edit($id)
    {
        $model = new SportModel();
        $data['sport'] = $model->find($id);
        return view('sport_form', ['sport' => $data['sport'], 'isEdit' => true]);
    }

    public function updateSport($id)
    {
        $model = new SportModel();
        $data = [
            'nom_activite' => $this->request->getPost('nom_sport'),
            'description' => $this->request->getPost('description'),
            'effet_jour' => $this->request->getPost('effet_jour'),
        ];
        $model->update($id, $data);
        return redirect()->to('/sports')->with('succes', 'Sport mis à jour avec succès.');
    }

    public function deleteSport($id)
    {
        $model = new SportModel();
        $model->delete($id);
        return redirect()->to('/sports')->with('succes', 'Sport supprimé avec succès.');
    }
}
