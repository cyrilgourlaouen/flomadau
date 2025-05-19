<?php

namespace App\Controller;

use Floma\Controller\AbstractController;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * @return void
     */
    public function home()
    {
        return $this->renderView(
            'main/home.php', 
            [
                'seo' => [
                    'title' => 'Accueil',
                    'descriptions'=> 'Page d\'accueil du PACT, parcourez nos offres, partagez vos expériences.'
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