<?php

namespace App\Controller;

use App\Manager\OfferManager;
use App\Resource\OfferResource;
use App\Service\OfferVisibilitySort;
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
        $offerManager = new OfferManager();

        $enrichedOffers = OfferResource::buildAll($offerManager->findBy(['en_ligne' => true]), [
            'categorie' => ['isMultiple' => false],
            'professionnel' => ['isMultiple' => false],
            'option' => ['isMultiple' => true],
            'image' => ['isMultiple' => true],
        ]);
        
        return $this->renderView(
            'front/main/home.php',
            [ 
                'offers' => $enrichedOffers,
                'seo' => [
                    'title' => 'Accueil',
                    'descriptions'=> 'Page d\'accueil du PACT, parcourez nos offres, partagez vos expériences.'
                ]
            ]
        );
    }
}