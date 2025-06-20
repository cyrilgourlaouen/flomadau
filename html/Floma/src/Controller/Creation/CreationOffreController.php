<?php

namespace App\Controller\Creation;

use App\Entity\Image;
use App\Entity\ProPrive;
use App\Entity\TagOffre;
use App\Enum\OfferCategoryEnum;
use App\Manager\ImageManager;
use App\Manager\ProfessionnelManager;
use App\Manager\ProPriveManager;
use App\Manager\TagOffreManager;
use App\Resource\ProfessionnelResource;
use App\Service\AddCategory;
use App\Service\HoraireManage;
use App\Service\UploadsImage;
use Floma\Controller\AbstractController;

class CreationOffreController extends AbstractController
{
    public function home()
    {
        $proManager = new ProfessionnelManager();
        if(isset($_SESSION['code_pro'])){
            $infosPro = ProfessionnelResource::buildAll($proManager->findBy(['code' => $_SESSION['code_pro']]), [
                'compte' => ['isMultiple' => false],
                'prive' => ['isMultiple' => false],
            ]);
        }
        return $this->renderView(
            'backoffice/creation-offre.php',
            [
                'infosPro' => $infosPro,
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
        if (isset($_POST) && isset($_FILES)) {
            $proPriveManager = new ProPriveManager();
            $proPrive = new ProPrive();
            if ($_POST["cvv"]) {
                $proPrive->setNumeroCarte($_POST["card-number"]);
                $dateExplode = explode('/', $_POST["expiration-date"]);
                $dateExpirationFr = $dateExplode[1].'-'.$dateExplode[0] . "-01";
                $proPrive->setDateExpiration($dateExpirationFr);
                $proPrive->setSiren($_POST["siren"]);
                $proPriveManager->updateCompte($proPrive, $_SESSION["code_pro"]);
            }
            $addCategory = new AddCategory();
            $uploadsImage = new UploadsImage();
            $uploadsImage->uploads();
            $image = new Image();
            $imageManager = new ImageManager();
            $horaireManager = new HoraireManage();
            $tagOffre = new TagOffre();
            $tagOffreManager = new TagOffreManager();
            $id = $addCategory->setOffer();
            foreach($_POST["tag"] as $tag) {
                $tagOffre->setIdTag($tag);
                $tagOffre->setIdOffre($id);
                $tagOffreManager->add($tagOffre);
            }
            $horaireManager->setHourly($id);
            for ($i=0; $i < sizeof($_FILES["photo"]["name"]); $i++) { 
                $image->setIdOffre($id);
                $i == 0 ? $image->setPrincipale(true) : $image->setPrincipale(false);
                $image->setUrlImg($_FILES["photo"]["name"][$i]);
                $imageManager->add($image);
            }
            if ($_POST["categorie"] === OfferCategoryEnum::Activity->value) {
                $addCategory->setActivity($id);

            } elseif ($_POST["categorie"] === OfferCategoryEnum::AmusementPark->value) {
                $addCategory->setAmusementParc($id);

            } elseif ($_POST["categorie"] === OfferCategoryEnum::Restauration->value) {
                $addCategory->setRestauration($id);

            } elseif ($_POST["categorie"] === OfferCategoryEnum::Show->value) {
                $addCategory->setShow($id);  

            } elseif ($_POST["categorie"] === OfferCategoryEnum::Visite->value) {
                $addCategory->setVisite($id);

            }
            return $this->redirectToRoute('/pro');
        }
        return $this->redirectToRoute('/offre/creation', ['state' => 'failure']);
    }
}