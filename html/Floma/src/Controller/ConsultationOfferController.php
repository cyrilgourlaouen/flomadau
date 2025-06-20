<?php

namespace App\Controller;

use App\Manager\OfferManager;
use Floma\Controller\AbstractController;
use App\Resource\OfferResource;


class ConsultationOfferController extends AbstractController
{
    public function show(int $id){
        print_r($id);
        $offerManager = new OfferManager();
        $offer = OfferResource::build($offerManager->find($id), [
            'categorie' => ['isMultiple' => false],
            'professionnel' => ['isMultiple' => false],
            'tagOffre' => ['isMultiple' => true],
            'langueGuideVisite' => ['isMultiple' => true],
            'typeRepasRestaurant' => ['isMultiple' => true],
            'image' => ['isMultiple' => false],
        ]);

        return $this->renderView('backoffice/consultation.php', [
            "offer" => $offer,
            'id' => $id,
            'seo' => [
                'title' => $offer['titre'],
                'description' => $offer['resume'],
            ]
        ]);
    }
}