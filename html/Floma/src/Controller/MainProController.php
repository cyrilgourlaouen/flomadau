<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class MainProController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/home.php',
            [
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions'=> 'Page d\'accueil d\'un professionnel PACT, parcourez vos offres, lisez vos avis.'
                ]
            ]);
    }
}