<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class SignupProController extends AbstractController
{
    public function show()
    {
        $this->setLayout(Layout::BACK);
        
        return $this->renderView(
            'backoffice/signup_page.php',
            [
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions'=> 'Page d\'accueil d\'un professionnel PACT, parcourez vos offres, lisez vos avis.'
                ]
            ]);
    }
}