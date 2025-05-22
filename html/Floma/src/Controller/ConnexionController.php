<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

/**
 * Class ConnexionController
 *
 * @package App\Controller
 */
class ConnexionController extends AbstractController
{
    /**
     * @return void
     */
    public function logIn()
    {
        return $this->renderView(
            'front/connexion.php', 
            [
                'seo' => [
                    'title' => 'LogIn',
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