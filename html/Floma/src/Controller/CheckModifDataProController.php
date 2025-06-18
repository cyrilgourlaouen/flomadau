<?php

namespace App\Controller;

use App\Manager\ProfessionnelManager;
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

        $email = $_POST['email'] ?? '';
        $password = $_POST['old-password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Email invalide']);
            return;
        }

        $isAvailable = $this->isEmailAvailable($email);
        echo json_encode(['success' => true, 'available' => $isAvailable]);
    }
}