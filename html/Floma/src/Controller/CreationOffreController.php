<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class MainProController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/creation-offre-gratuite.php',
            [
                'seo' => [
                    'title' => 'Création d\'une offre gratuite',
                    'descriptions'=> 'Page de création d\'une offre pour les professionnels du domaine public'
                ]
            ]);
    }
}