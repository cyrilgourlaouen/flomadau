<?php

namespace App\Controller;

use Floma\Controller\AbstractController;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class InscriptionMembreController extends AbstractController
{
    /**
     * @return string
     */
    public function inscription_front()
    {
        return $this->renderView(
            'front/inscription/create_member.php', 
            [
                'seo' => [
                    'title' => 'Création d\'un compte membre',
                    'descriptions'=> 'Page pour crée un compte membre'
                ]
            ]);
    }

    /**
     * @return null
     */
    public function contact()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        return $this->redirectToRoute('home', ['state' => 'success']);
    }

}
