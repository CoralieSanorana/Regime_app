<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\UserDetailModel;

class UserDetails extends BaseController
{
    public function index()
    {
        $model = new UserDetailModel();
        $data['UserDetails'] = $model->findAll();
        return view('UserDetails/index', $data);
    }

    public function updateUserDetails(){
        $UserDetailModel = new UserDetailModel();
        $userModel = new UserModel();
        $session = session();

        $user_id = $this->request->getPost('id');
        $details_id = $this->request->getPost('details_id');
        $poids_actuel = $this->request->getPost('poids_actuel');
        $taille = $this->request->getPost('taille');
        $genre = $this->request->getPost('genre');

        if($details_id){
            $UserDetailModel->update($details_id, [
                'poids_actuel' => $poids_actuel,
                'taille' => $taille
            ]);
            $userModel->update($user_id, [
                'genre' => $genre
            ]);
        } else {
            $UserDetailModel->insert([
                'user_id' => $user_id,
                'poids_actuel' => $poids_actuel,
                'taille' => $taille
            ]);
            $userModel->update($user_id, [
                'genre' => $genre
            ]);
        }

        $this->freshUser($user_id);
        return redirect()->back()->with('success', 'Détails du profil mis à jour avec succès.');
    }
}
