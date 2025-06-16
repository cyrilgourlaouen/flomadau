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

        $enrichedOffers = OfferResource::buildAll($offerManager->findBy(['en_ligne' => true], ["date_creation" => "DESC"]), [
            'categorie' => ['isMultiple' => false],
            'professionnel' => ['isMultiple' => false],
            'option' => ['isMultiple' => true],
            'image' => ['isMultiple' => true],
        ]);

        
        $offerVisibilitySort = new OfferVisibilitySort();
        $sortedOffers = $offerVisibilitySort->sortVisibility($enrichedOffers);
        
        return $this->renderView(
            'front/main/home.php',
            [ 
                'offers' => $sortedOffers,
                'seo' => [
                    'title' => 'Accueil',
                    'descriptions'=> 'Page d\'accueil du PACT, parcourez nos offres, partagez vos expériences.'
                ]
            ]
        );
    }
}