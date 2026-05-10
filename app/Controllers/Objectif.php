<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\UserDetailModel;
use App\Models\UserObjectifModel;

class Objectif extends BaseController
{
    public function index(): string
    {
        $objectifModel = new ObjectifModel();
        $user_id = session()->get('user_id') ? session()->get('user_id') : 1; // Par defaut l'utilisateur 1 (à remplacer par la session réelle)
        $userDetailModel = new UserDetailModel();
        $data['user'] = $userDetailModel->getByUserId($user_id); 
        $data['objectifs'] = $objectifModel->findAll();
        $data['poids_actuel'] = $data['user']['poids_actuel'] ?? 0;

        return view('objectif',$data);
    }

    public function save(){

        $objectif = $this->request->getPost('objectif');
        $poids_cible = $this->request->getPost('poids_cible');
        $userId = session()->get('user_id') ? session()->get('user_id') : 1; // Par defaut l'utilisateur 1 (à remplacer par la session réelle)
        $objectifModel = new ObjectifModel();
        $objectifData = $objectifModel->getByLibelle($objectif);
        $data = [
            'user_id' => $userId,
            'objectif_id' => $objectifData['id'],
            'poids_cible' => $poids_cible
        ];

        // Enregistrer l'objectif sélectionné pour l'utilisateur
        $userObjectifModel = new UserObjectifModel();
        $userObjectifModel->insert($data);


        // Validation ok
        echo json_encode([
            'status' => 'success',
            'message' => 'Données enregistrées'
        ]);

    }
}