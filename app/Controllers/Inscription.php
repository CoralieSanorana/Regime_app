<?php

namespace App\Controllers;

use App\Models\UserDetailModel;
use App\Models\UserModel;

class Inscription extends BaseController
{
    public function index()
    {
        $data['validation'] = session()->getFlashdata('validation');
        return view('inscription', $data);
    }

    public function save() 
    {
        $model = new UserModel();
        $userDetailsModel = new UserDetailModel();

        $data = $this->request->getPost();
        
        $data['role']          = 'user';
        $data['is_gold']       = 0;
        $data['solde_monnaie'] = 0.00;

        // Information personnelle
        if (!$model->insert($data)) {
            return redirect()->back()
                            ->withInput()
                            ->with('validation', $model->errors());
        }

        // Information sanitaire
        $userId = $model->getInsertID();

        $detailsData = [
            'user_id' => $userId,
            'poids_actuel' => $data['poids_actuel'],
            'taille' => $data['taille']
        ];

        
        if (!$userDetailsModel->insert($detailsData)) {
            
            $model->delete($userId); // Supprimer l'utilisateur créé pour éviter les données orphelines
            return redirect()->back()
                            ->withInput()
                            ->with('validation', $userDetailsModel->errors());
        }

        return redirect()->to('/login')->with('success', 'Votre compte NutriPath est prêt !');
    }
}