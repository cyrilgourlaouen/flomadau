<?php

namespace App\Controller;

use App\Manager\ProfessionnelManager;
use App\Resource\ProfessionnelResource;
use Floma\Controller\AbstractController;
use Floma\View\Layout;

class CheckDataProController extends AbstractController
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
}