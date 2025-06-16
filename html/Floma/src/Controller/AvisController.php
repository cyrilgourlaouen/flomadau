<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use App\Manager\AvisManager;
use App\Resource\AvisResource;

class AvisController extends AbstractController
{
    public function show(int $id)
    {
        $avisManager = new AvisManager();
        $avis = $avisManager->findBy(['id_offre' => $id]);

        return $this->renderView('front/offer/DetailedOffer.php', [
            "avis" => $avis,
        ]);
    }
}