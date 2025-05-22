<?php

namespace App\Controller;

use Floma\Controller\AbstractController;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class InscriptionController extends AbstractController
{
    /**
     * @return string
     */
    public function home()
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
    public function signUp()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        return $this->redirectToRoute('home', ['state' => 'success']);
    }

}
