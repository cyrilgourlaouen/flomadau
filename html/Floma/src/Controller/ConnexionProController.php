<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class ConnexionProController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/connexion_pro.php',
            [
                'seo' => [
                    'title' => 'Connexion du compte professionnel',
                    'descriptions'=> 'Page de connexion d\'un professionnel PACT afin d\'avoir accès à vos offres.'
                ]
            ]);
    }
}