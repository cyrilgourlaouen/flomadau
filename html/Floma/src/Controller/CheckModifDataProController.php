<?php

namespace App\Controller;

use App\Manager\ProfessionnelManager;
use App\Manager\CompteManager;
use App\Resource\CompteResource;
use App\Resource\ProfessionnelResource;
use Floma\Controller\AbstractController;
use Floma\View\Layout;

class CheckModifDataProController extends AbstractController
{

    public function home()
    {
        $proManager = new ProfessionnelManager();

        $infosPro = [];

        if(isset($_SESSION['code_pro'])){
            $infosPro = ProfessionnelResource::buildAll($proManager->findBy(['code' => $_SESSION['code_pro']]), [
                'compte' => ['isMultiple' => false],
                'prive' => ['isMultiple' => false],
            ]);

        }

        return $this->renderView(
            'backoffice/checkModifDataPro.php',
            [
                'infosPro' => $infosPro,
                'seo' => [
                    'title' => 'Mes informations',
                    'descriptions'=> 'Page de consultation de ses informations de compte pour un professionnel'
                ]
            ]);
    }


    public function checkData() {
        //email pas déjà associé
        //mdp correct
        $dataJson = [];
        $dataJson['success'] = true;

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $dataJson['error'] = 'Méthode non autorisée';
            $dataJson['success'] = false;
            exit;
        }

        $compteManager = new CompteManager();
        
        //Si maj compte + mdp
        if(isset($_POST['old-password'])){

            $password = $_POST['old-password'] ?? '';
            $passwordValide = $this->validePassword($password, $compteManager);
            var_dump($passwordValide);

            if($passwordValide){

            }else{
                $dataJson['success'] = false;
                $dataJson['erreurMotPasse'] = 'Le mot de passe ne correspond pas';
            }

        //Si maj compte + carte bancaire
        }else if(isset($_POST['card-number'])){
        
        //Si maj compte + carte bancaire + mdp
        }else if(isset($_POST['card-number']) && isset($_POST['old-password'])){
        
        //Si maj compte seulement
        }else{
            $email = $_POST['email'] ?? '';
            $emailValide = $this->valideMail($email, $compteManager);

            if($emailValide){

            }else{
                $dataJson['success'] = false;
                $dataJson['erreurMotPasse'] = 'Le mot de passe ne correspond pas';
            }
        }

        if($dataJson['success'] === true){

        }else{
            echo json_encode($dataJson);
        }
    }


    private function valideMail($email, $compteManager): bool {
        if (empty($email)) return false;

        $allMember = CompteResource::buildAll($compteManager->findAll());
        print_r($allMember);

        foreach ($allMember as $member) {
            if($member['email'] === $email) {
                return false;
            }
        }

        return true;
    }


    private function validePassword($password, $compteManager) {
        if (empty($password)) return false;
        echo('apres test');

        var_dump(password_hash($password, PASSWORD_DEFAULT));
        $account = CompteResource::buildAll($compteManager->findBy(['mot_de_passe' => password_hash($password, PASSWORD_DEFAULT)]));
        print_r($account);
        
        if(empty($account)){
            return false;
        }else{
            print_r($account);
        }
    }


    private function udpateAccount($donnees){

    }


    private function udpateAccountPassword($donnees){

    }


    private function udpateAccountCard($donnees){

    }


    private function udpateAccountPasswordCard($donnees){

    }
}