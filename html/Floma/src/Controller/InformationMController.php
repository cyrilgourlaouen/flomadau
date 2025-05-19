<?php

namespace App\Controller;

use Floma\Controller\AbstractController;

/**
 * Class InformationMController
 *
 * @package App\Controller
 */
class InformationMController extends AbstractController
{
    /**
     * @return string
     */
    public function information()
    {
        return $this->renderView('front/information.php', ['title' => 'Information Membre']);
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