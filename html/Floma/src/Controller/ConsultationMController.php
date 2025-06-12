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
        return $this->renderView('front/consultation/consultation.php', ['title' => 'Information Membre'] );
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
