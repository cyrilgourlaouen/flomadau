<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use App\Manager\OfferManager;
use \App\Manager\AvisManager;
use App\Resource\OfferResource;
use App\Entity\Avis;

class OfferController extends AbstractController
{
    public function show(int $id)
    {
        $offerManager = new OfferManager();

        $enrichedOffer = OfferResource::build($offerManager->find($id), [
            'categorie' => ['isMultiple' => false],
            'professionnel' => ['isMultiple' => false],
            'tagOffre' => ['isMultiple' => true],
            'langueGuideVisite' => ['isMultiple' => true],
            'typeRepasRestaurant' => ['isMultiple' => true],
            'image' => ['isMultiple' => false],
        ]);
        $avisManager = new AvisManager();
        $avis = $avisManager->findBy(['id_offre' => $id]);

        return $this->renderView('front/offer/DetailedOffer.php', [
            "offer" => $enrichedOffer,
            "avis" => $avis,
            'id' => $id,
            'seo' => [
                'title' => $enrichedOffer['titre'],
                'description' => $enrichedOffer['resume'],
            ]
        ]);
    }
}