<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use Floma\View\Layout;

class MainProController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/creation-offre-gratuite.php',
            [
                'seo' => [
                    'title' => 'Création d\'une offre gratuite',
                    'descriptions'=> 'Page de création d\'une offre pour les professionnels du domaine public'
                ]
            ]);
    }

    /**
     * @return null
     */
    public function newOffer()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        if (isset($_POST)) {
            $offer = new Offer();
            $offer->setTitre($_POST['offer_name']);
            $offer->setResume($_POST['resume']);
            $offer->setVille($_POST['ville']);
            $offer->setCodePostal($_POST['code_postal']);
            $offer->setCategorie($_POST['categorie']);
            $offer->setCategorie($_POST['categorie']);

            $offerManager = new OfferManager();
            $offerManager->add($offer);
            return $this->redirectToRoute('/');
        }
        return $this->redirectToRoute('/offre/creation', ['state' => 'failure']);
    }
}