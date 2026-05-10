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
        $data['taille'] = $data['user']['taille'] ?? 0; // Taille en cm
        
        // Calcul de l'IMC: IMC = poids / (taille en mètres)^2
        if ($data['poids_actuel'] > 0 && $data['taille'] > 0) {
            $tailleEnMetres = $data['taille'] / 100;
            $data['imc'] = round($data['poids_actuel'] / ($tailleEnMetres * $tailleEnMetres), 1);
            // Poids idéal pour un IMC de 25 (limite haute de "normal")
            $data['poids_ideal'] = round(25 * ($tailleEnMetres * $tailleEnMetres), 1);
        } else {
            $data['imc'] = 0;
            $data['poids_ideal'] = 0;
        }

        return view('regimes/objectif',$data);
    }

    public function save(){
        try {
            $objectif = $this->request->getPost('objectif');
            $poids_cible = $this->request->getPost('poids_cible');
            
            if (!$objectif || !$poids_cible) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Objectif ou poids cible manquant.'
                ], 400);
            }

            $userId = session()->get('user_id') ? session()->get('user_id') : 1;
            $objectifModel = new ObjectifModel();
            $objectifData = $objectifModel->getByLibelle($objectif);

            if (!$objectifData) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Objectif introuvable en base de données.'
                ], 404);
            }

            $data = [
                'user_id' => $userId,
                'objectif_id' => $objectifData['id'],
                'poids_cible' => $poids_cible
            ];

            // Enregistrer l'objectif sélectionné pour l'utilisateur
            $userObjectifModel = new UserObjectifModel();
            if (!$userObjectifModel->insert($data)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Erreur lors de l\'enregistrement : ' . implode(', ', $userObjectifModel->errors())
                ], 500);
            }

            // Succès
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Objectif enregistré avec succès!'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Erreur serveur : ' . $e->getMessage()
            ], 500);
        }
    }
}