<?php
namespace App\Controllers;
use App\Models\UsersModel;
use App\Models\CodeModel;
use App\Models\TransactionModel;
class Transaction extends BaseController
{
    public function index()
    {
        $model = new TransactionModel();
        $data['transactions'] = $model->findAll();
        return view('transactions/index', $data);
    }

    public function findOne($user_id)
    {
        $userModel = new UsersModel();
        $model = new TransactionModel();
        $user = $userModel->find($user_id);

        if (!$user) {
            return redirect()->to('/singIn')->with('error', 'Utilisateur introuvable.');
        }

        session()->set([
            'user_id' => $user['id'],
            'user_role' => $user['role'],
            'user_nom' => $user['nom'],
            'user_prenom' => $user['prenom'],
            'user_email' => $user['email'],
            'user_solde' => $user['solde_monnaie'],
            'user_gold' => $user['is_gold'],
        ]);

        $transactions = $model->where(['user_id' => $user_id])->findAll();
        $formattedTransactions = [];
        foreach ($transactions as $transaction) {
            $formattedTransactions[] = [
                'type' => $transaction['type_transaction'] ?? '',
                'description' => $transaction['description'] ?? '',
                'created_at' => $transaction['date_transaction'] ?? null,
                'amount' => $transaction['montant'] ?? 0,
            ];
        }

        $data['transactions'] = $formattedTransactions;
        $data['userSolde'] = $user['solde_monnaie'] ?? 0;
        return view('porte_monnaie/index', $data);
    }

    public function recharger(){
        $userModel = new UsersModel();
        $transactionModel = new TransactionModel();
        $codeModel = new CodeModel();

        $user_id = $this->request->getPost('user_id'); 
        $code = $this->request->getPost('code');
        $user = $userModel->find($user_id);

        $codeTrouver = $codeModel->where('code_secret', $code)->first();
        if (!empty($codeTrouver)) {
            if($codeTrouver['est_valide']){
                // Update le solde du user
                $new_solde = $user['solde_monnaie'] + $codeTrouver['montant'];
                $userModel->update($user_id, ['solde_monnaie'=> $new_solde]);

                session()->set('user_solde', $new_solde);

                // Inserer une transaction de type credit
                $transactionModel->insert([
                    'user_id' => $user_id,
                    'type_transaction' => 'credit',
                    'description' => 'Recharge via code: ' . $code,
                    'montant' => $codeTrouver['montant'],
                    'date_transaction' => date('Y-m-d H:i:s'),
                ]);
                
                // Update le code pour le marquer comme invalide
                $codeModel->update($codeTrouver['id'], ['est_valide' => false]);

                return redirect()->back()->with('success', 'Recharge réussie! Votre nouveau solde est de '.$new_solde.' Ar.');

            } else{
                return redirect()->back()->with('error', 'Code invalide ou deja utiliser! Veuillez saisir un autre code');
            }
        } else{
            return redirect()->back()->with('error', 'Code incorrect ou inexistant.');
        }
        



    }
}
