<?php

namespace App\Controller;

use Floma\Controller\AbstractController;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class MainController extends AbstractController {

    /**
     * @return string
     */
    public function home() {
        return $this->renderView('main/home.php', ['title' => 'Accueil']);
    }

    /**
     * @return null
     */
    public function contact() {
		// Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
		return $this->redirectToRoute('home', ['state' => 'success']);
	}
}