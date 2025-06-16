<?php

namespace App\Controller\Creation;

use App\Entity\Activite;
use App\Entity\LangueGuideVisite;
use App\Entity\Offer;
use App\Entity\ParcAttraction;
use App\Entity\Restaurant;
use App\Entity\Spectacle;
use App\Entity\TypeRepas;
use App\Entity\TypeRepasRestaurant;
use App\Entity\Visite;
use App\Enum\OfferCategoryEnum;
use App\Manager\ActiviteManager;
use App\Manager\LangueGuideVisiteManager;
use App\Manager\OfferManager;
use App\Manager\ParcAttractionManager;
use App\Manager\RestaurantManager;
use App\Manager\SpectacleManager;
use App\Manager\TypeRepasManager;
use App\Manager\TypeRepasRestaurantManager;
use App\Manager\VisiteManager;
use App\Resource\OfferResource;
use App\Service\UploadsImage;
use Floma\Controller\AbstractController;

class CreationOffreController extends AbstractController
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
    public function newOffer()
    {
        if (isset($_POST) && isset($_FILES)) {
            $uploadsImage = new UploadsImage();
            $uploadsImage->uploads();
            $offerManager = new OfferManager();
            $offer = new Offer();
            $offer->setTitre($_POST['offer_name']);
            $offer->setConditionsAccessibilite($_POST["conditions_accesibilite"]);
            $offer->setResume($_POST['resume']);
            $offer->setNumeroRue($_POST["numero_rue"]);
            $offer->setNomRue($_POST["nom_rue"]);
            $offer->setVille($_POST['ville']);
            $offer->setCodePostal($_POST['code_postal']);
            $offer->setDescriptionDetaillee($_POST["description_detaillee"]);
            $offer->setCategorie($_POST['categorie']);
            $offer->setTelephone($_POST["telephone"]);
            $offer->setSiteWeb($_POST["site_web"]);
            $offer->setCodeProfessionnel(1);
            isset($_POST["complement_adresse"]) ?? $offer->setComplementAdresse($_POST["complement_adresse"]);
            $offerManager = new OfferManager();
            $offerManager->add($offer);
            $enrichedOffer = OfferResource::build($offerManager->findOneBy(["description_detaillee" => $_POST["description_detaillee"]]));
            if ($_POST["categorie"] === OfferCategoryEnum::Activity->value) {
                $activity = new Activite();
                $activityManager = new ActiviteManager();
                $activity->setDuree($_POST["duree_activity"]);
                $activity->setIdOffre($enrichedOffer["id"]);
                $activity->setPrixMinimal($_POST["prix_minimal_activity"]);
                $activity->setAgeRequis($_POST['age_requis_activity']);
                $activity->setPrestationsIncluses($_POST["prestations_incluses"]);
                $activity->setPrestationsNonIncluses($_POST["prestations_non_incluses"]);
                $activityManager->add($activity);

            } elseif ($_POST["categorie"] === OfferCategoryEnum::AmusementPark->value) {
                $amusementPark = new ParcAttraction();
                $amusementParkManager = new ParcAttractionManager();
                $amusementPark->setIdOffre($enrichedOffer["id"]);
                $amusementPark->setNombreAttraction($_POST["nombre_attraction"]);
                $amusementPark->setPrixMinimal($_POST["prix_minimal_amusement"]);
                $amusementPark->setAgeRequis($_POST["age_requis_amusement"]);
                $amusementPark->setUrlPlan($_POST["url_parc_attraction"]);
                $amusementParkManager->add($amusementPark);

            } elseif ($_POST["categorie"] === OfferCategoryEnum::Restauration->value) {
                $restauration = new Restaurant();
                $restaurationManager = new RestaurantManager();
                $restauration->setIdOffre($enrichedOffer["id"]);
                $restauration->setGammeDePrix($_POST["gamme_de_prix"]);
                $restauration->setUrlCarteRestaurant('$_POST["url_carte_restaurant"]');
                $restaurationManager->add($restauration);
                if (isset($_POST["types_repas"])) {
                    $typeRepasRestaurant = new TypeRepasRestaurant();
                    $typeRepasRestaurantManager = new TypeRepasRestaurantManager();
                    foreach ($_POST["types_repas"] as $type) {
                        $typeRepasRestaurant->setIdOffre($enrichedOffer["id"] );
                        $typeRepasRestaurant->setIdType($type);
                        $typeRepasRestaurantManager->add($typeRepasRestaurant);
                    }
                }
                
            } elseif ($_POST["categorie"] === OfferCategoryEnum::Show->value) {
                $show = new Spectacle();
                $showManager = new SpectacleManager();
                $show->setIdOffre($enrichedOffer["id"]);
                $show->setDuree($_POST["duree_show"]);
                $show->setCapacite($_POST["capacite"]);
                $show->setPrixMinimal($_POST["prix_minimal_show"]);
                $showManager->add($show);
                print_r($show);
                exit;

            } elseif ($_POST["categorie"] === OfferCategoryEnum::Visite->value) {
                $visite = new Visite();
                $visiteManager = new VisiteManager();
                $visite->setIdOffre($enrichedOffer["id"]);
                $visite->setDuree($_POST["duree_visite"]);
                $visite->setPrixMinimal($_POST["prix_minimal_visite"]);
                isset($_POST["guide"]) ? $visite->setGuidee($_POST["guide"]) : $visite->setGuidee(false);
                $visiteManager->add($visite);

                if (isset($_POST["guide"])) {
                    $langueGuideVisite = new LangueGuideVisite();
                    $langueGuideVisiteManager = new LangueGuideVisiteManager();
                    foreach($_POST["guides"] as $language) {
                        $langueGuideVisite->setIdLangue($language);
                        $langueGuideVisite->setIdOffre($enrichedOffer["id"]);
                        $langueGuideVisiteManager->add($langueGuideVisite);
                    }
                }
            }
            return $this->redirectToRoute('/');
        }
        return $this->redirectToRoute('/offre/creation', ['state' => 'failure']);
    }
}