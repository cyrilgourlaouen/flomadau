<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class ProfilProController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/ProfilPro.php',
            [
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions'=> 'Page d\'accueil d\'un professionnel PACT, parcourez vos offres, lisez vos avis.'
                ]
            ]);
    }
}