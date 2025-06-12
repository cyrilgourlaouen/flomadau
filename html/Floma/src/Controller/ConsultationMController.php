<?php


namespace App\Controller;


use App\Manager\CompteManager;
use Floma\Controller\AbstractController;
use App\Entity\Compte;


/**
 * Class InformationMController
 *
 * @package App\Controller
 */
class ConsultationMController extends AbstractController
{
   
    /**
     * @return void
     */
    public function consultation()
    {
        return $this->renderView('front/consultation/consultation.php', 
            ['seo' => [
                    'title' => 'Consultation',
                    'description' => 'Page de consultation des informations du membre'
                ]],
    );
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
