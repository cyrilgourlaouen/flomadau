<?php

namespace App\Service;

use App\Entity\Activite;
use App\Entity\LangueGuideVisite;
use App\Entity\Offer;
use App\Entity\ParcAttraction;
use App\Entity\Restaurant;
use App\Entity\Spectacle;
use App\Entity\TypeRepasRestaurant;
use App\Entity\Visite;
use App\Manager\ActiviteManager;
use App\Manager\LangueGuideVisiteManager;
use App\Manager\OfferManager;
use App\Manager\ParcAttractionManager;
use App\Manager\RestaurantManager;
use App\Manager\SpectacleManager;
use App\Manager\TypeRepasRestaurantManager;
use App\Manager\VisiteManager;

class AddCategory 
{
    public function setActivity(int $id): void 
    {
        $activity = new Activite();
        $activityManager = new ActiviteManager();
        $activity->setDuree($_POST["duree_activity"]);
        $activity->setIdOffre($id);
        $activity->setPrixMinimal($_POST["prix_minimal_activity"]);
        $activity->setAgeRequis($_POST['age_requis_activity']);
        $activity->setPrestationsIncluses($_POST["prestations_incluses"]);
        $activity->setPrestationsNonIncluses($_POST["prestations_non_incluses"]);
        $activityManager->add($activity);
    }

    public function setAmusementParc(int $id): void 
    {
        $amusementPark = new ParcAttraction();
        $amusementParkManager = new ParcAttractionManager();
        $amusementPark->setIdOffre($id);
        $amusementPark->setNombreAttraction($_POST["nombre_attractions"]);
        $amusementPark->setPrixMinimal($_POST["prix_minimal_amusement"]);
        $amusementPark->setAgeRequis($_POST["age_requis_amusement"]);
        $amusementPark->setUrlPlan($_FILES["url_carte_parc"]["name"]);
        $amusementParkManager->add($amusementPark);
    }

    public function setRestauration(int $id): void 
    {
        $restauration = new Restaurant();
        $restaurationManager = new RestaurantManager();
        $restauration->setIdOffre($id);
        $restauration->setGammeDePrix($_POST["gamme_de_prix"]);
        $restauration->setUrlCarteRestaurant($_FILES["url_carte_restaurant"]["name"]);
        $restaurationManager->add($restauration);
        if (isset($_POST["types_repas"])) {
            $typeRepasRestaurant = new TypeRepasRestaurant();
            $typeRepasRestaurantManager = new TypeRepasRestaurantManager();
            foreach ($_POST["types_repas"] as $type) {
                $typeRepasRestaurant->setIdOffre($id);
                $typeRepasRestaurant->setIdType($type);
                $typeRepasRestaurantManager->add($typeRepasRestaurant);
            }
        }
    }

    public function setShow(int $id): void 
    {
        $show = new Spectacle();
        $showManager = new SpectacleManager();
        $show->setIdOffre($id);
        $show->setDuree($_POST["duree_show"]);
        $show->setCapacite($_POST["capacite"]);
        $show->setPrixMinimal($_POST["prix_minimal_show"]);
        $showManager->add($show);
    }

    public function setVisite(int $id) 
    {
        $visite = new Visite();
        $visiteManager = new VisiteManager();
        $visite->setIdOffre($id);
        $visite->setDuree($_POST["duree_visite"]);
        $visite->setPrixMinimal($_POST["prix_minimal_visite"]);
        isset($_POST["guide"]) ? $visite->setGuidee($_POST["guide"]) : $visite->setGuidee(false);
        $visiteManager->add($visite);

        if (isset($_POST["guide"])) {
            $langueGuideVisite = new LangueGuideVisite();
            $langueGuideVisiteManager = new LangueGuideVisiteManager();
            foreach($_POST["guides"] as $language) {
                $langueGuideVisite->setIdLangue($language);
                $langueGuideVisite->setIdOffre($id);
                $langueGuideVisiteManager->add($langueGuideVisite);
            }
        }
    }

    public function setOffer(): int 
    {
        $offerManager = new OfferManager();
        $offer = new Offer();
        $offer->setTitre($_POST['offer_name']);
        $offer->setConditionsAccessibilite($_POST["conditions_accesibilite"]);
        $offer->setResume(trim($_POST['resume']));
        $offer->setNumeroRue($_POST["numero_rue"]);
        $offer->setNomRue($_POST["nom_rue"]);
        $offer->setVille($_POST['ville']);
        $offer->setCodePostal($_POST['code_postal']);
        $offer->setDescriptionDetaillee(trim($_POST["description_detaillee"]));
        $offer->setCategorie($_POST['categorie']);
        $offer->setTelephone($_POST["telephone"]);
        $offer->setSiteWeb($_POST["site_web"]);
        $offer->setCodeProfessionnel(1);
        $_POST["complement_adresse"] ?? $offer->setComplementAdresse($_POST["complement_adresse"]);
        return $offerManager->addGetId($offer)[1];
    }
}