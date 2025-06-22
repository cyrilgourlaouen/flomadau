<?php

namespace App\Controller\Creation;

use App\Entity\Avis;
use App\Manager\OfferManager;
use App\Manager\AvisManager;
use DateTimeImmutable;
use Floma\Controller\AbstractController;

class AvisController extends AbstractController
{
    public function home()
    {
        return $this->renderView(
            'backoffice/creation-offre.php',
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
    public function newComment()
    {
        if (isset($_POST) && isset($_FILES)) {
            $id = $_POST["id"];
            $avisManager = new AvisManager();
            $avis = new Avis();
            $offerManager = new OfferManager;
            $date = new DateTimeImmutable();
            $today = $date->format('Y-m-d');
            $avis->setTitre($_POST['titre_avis']);
            $avis->setCommentaire($_POST["commentaire_avis"]);
            $avis->setDateVisite(trim($_POST['date_visite_avis']));
            $avis->setContexteVisite($_POST["contexte_visite"]);
            $avis->setNote($_POST["note"]);
            $avis->setCodeMembre($_SESSION["id"]);
            $avis->setIdOffre($id);
            $avis->setDatePublication($today);
            $avisManager->add($avis);
            $offerManager->updateNoteMoy($id);
            return $this->redirectToRoute("/offer/$id");
        }
        return $this->redirectToRoute("/", ['state' => 'failure']);
    }
}