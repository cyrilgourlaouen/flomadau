<?php

namespace App\Controller;

use App\Manager\OfferManager;
use App\Resource\OfferResource;
use Floma\Controller\AbstractController;
use Floma\View\Layout;

class MainProController extends AbstractController
{
    public function home()
    {

        $offerManager = new OfferManager();

        $enrichedOffers = OfferResource::buildAll($offerManager->findBy(['code_professionnel' => 2]), [
            'categorie' => ['isMultiple' => false],
            'professionnel' => ['isMultiple' => false],
            'option' => ['isMultiple' => true],
            'image' => ['isMultiple' => true],
        ]);

        return $this->renderView(
            'backoffice/home.php',
            [
                'offers' => $enrichedOffers,
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions'=> 'Page d\'accueil d\'un professionnel PACT, parcourez vos offres, lisez vos avis.'
                ]
            ]);
    }
}