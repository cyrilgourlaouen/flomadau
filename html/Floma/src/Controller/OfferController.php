<?php

namespace App\Controller;

use Floma\Controller\AbstractController;
use App\Manager\OfferManager;

class OfferController extends AbstractController
{
    public function show($id)
    {
        $offerManager = new OfferManager();
        $offer = $offerManager->find($id);
        return $this->renderView('offer/DetailedOffer.php', [
            'offer' => $offer,
            'id' => $id,
        ]);
    }
}