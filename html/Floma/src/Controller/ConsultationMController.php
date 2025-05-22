<?php

namespace App\Controller;

use App\Manager\CompteManager;
use Floma\Controller\AbstractController;

/**
 * Class InformationMController
 *
 * @package App\Controller
 */
class ConsultationMController extends AbstractController
{
    
    /**
     * @return string
     */
    public function consultation()
    {
        $compteManager = new CompteManager();
        $account = $compteManager->findBy(["email" => $_SESSION['user']['email']]);
        return $this->renderView('front/consultation.php', ['title' => 'Information Membre', 'account' => $account] );
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