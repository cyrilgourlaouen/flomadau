<?php
use App\Manager\OfferManager;
use App\Service\CategoryContent;
use App\Service\MetricStarsCalculator;

$stars = new MetricStarsCalculator();
$offerManager = new OfferManager();
$categoryContent = new CategoryContent();
$offer = $data["offer"];
$InfoOffer = isset($offer["typeRepasData"]) || isset($offer["langueGuideData"])
    ? $categoryContent->getContentCategory($offer["categoryData"], $offer["categorie"], $offer["conditions_accessibilite"], isset($offer["typeRepasData"]) ? $offer["typeRepasData"] : $offer["langueGuideData"])
    : $categoryContent->getContentCategory($offer["categoryData"], $offer["categorie"], $offer["conditions_accessibilite"]);
$fullAdresse = !$offer["numero_rue"] || !$offer["nom_rue"] ? $offer["ville"] : $offer["numero_rue"] . " " . $offer["nom_rue"];
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<div class="contentMob hideMob flex-col align-start gap-lg">
    <div>
        <img src="./uploads/offers/<?= $offer["imageData"][0]["url_img"] ?>" alt="image" class="full-height full-width">
    </div>
    <div class="content no-pad-top flex-col align-start gap-sm full-width">
        <section class="sectionOffreDetaille">
            <div class="rightPart flex-col align-start gap-sm">
                <h1>
                    <?= htmlspecialchars($offer["titre"]) ?>
                </h1>
                <div class="tags flex-row align-center gap-sm">
                    <?php foreach ($offer["tagData"] as $tag) { ?>
                        <div class="tag flex-row align-center">
                            <?= $tag["nom_tag"] ?>
                        </div>
                    <?php } ?>
                </div>
                <p>
                    <?= htmlspecialchars($offer["resume"]) ?>
                </p>
                <div class="flex-row align-start">
                    <?= $stars->calculStars($offer["note_moyenne"]) ?>
                    <p>
                        <?= "(" . htmlspecialchars($offer["nombre_avis"]) . ")" . " - " . htmlspecialchars($offer["categorie"]); ?>
                    </p>
                </div>
            </div>
        </section>
        <section class="sectionOffreDetaille">
            <div>
                <h3>
                    Informations sur l'offre
                </h3>

                <div class="gap"><?= $InfoOffer ?></div>
            </div>
        </section>
        <?php if ($offer["description_detaillee"]) { ?>
            <section class="sectionOffreDetaille">
                <div class="description flex-col align-start gap-sm">
                    <h3>
                        Description
                    </h3>
                    <p>
                        <?= htmlspecialchars($offer["description_detaillee"]) ?>
                    </p>
                </div>
            </section>
        <?php } ?>
        <section class="sectionOffreDetaille">
            <h3>
                Comment nous rejoindre ?
            </h3>
            <?php if ($fullAdresse) { ?>
                <div id="map" city="<?= $fullAdresse ?>" style="width: 100%; height: 300px;"></div>
            <?php } ?>
            <div class="align">
                <?php if ($offer["code_postal"]) { ?>
                    <img src="./assets/icons/location_primary.svg" alt="location">
                    <p>
                        <?= $fullAdresse ?>
                    </p>
                <?php } ?>
            </div>
        </section>
        <section class="sectionOffreDetaille">
            <div class="flex-col align-start gap-md">
                <?php if ($offer["telephone"] || $offer["site_web"]) { ?>
                    <h3>
                        Contact
                    </h3>
                    <?php if ($offer["telephone"]) { ?>
                        <div class="align">
                            <img src="./assets/icons/phone_primary.svg" alt="phone">
                            <p>
                                <?= htmlspecialchars($offer["telephone"]) ?>
                            </p>
                        </div>
                    <?php } ?>
                    <?php if ($offer["site_web"]) { ?>
                        <div class="align">
                            <img src="./assets/icons/earth_primary.svg" alt="earth">
                            <a href="<?= htmlspecialchars($offer["site_web"]) ?>">
                                <p>
                                    <?= htmlspecialchars($offer["site_web"]) ?>
                                </p>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </section>
        <div class="align">
            <p class="italic">
                Offre proposée par <?= $offer["professionnelData"]["raison_sociale"] ?>
            </p>
        </div>
    </div>
</div>

<div class="contentTab hideTab">
    <div class="accueil flex-row align-center fit-content">
        <a href="/" class="flex-row align">
            <img src="./assets/icons/chevron_left_black.svg" alt="chevron-left" class="chevronLeft">
            <h3>Accueil</h3>
        </a>
    </div>
    <div class="content no-pad-side flex-col align-start gap-lg">
        <section class="sectionOffreDetaille flex-row gap-lg">
            <div class="images">
                <img src="./uploads/offers/<?= $offer["imageData"][0]["url_img"] ?>" alt="croisiere">
            </div>
            <div class="rightPart flex-col align-start gap-sm">
                <div class="flex-row align-start">
                    <?= $stars->calculStars($offer["note_moyenne"]) ?>
                    <p>
                        <?= "(" . htmlspecialchars($offer["nombre_avis"]) . ")" . " - " . htmlspecialchars($offer["categorie"]); ?>
                    </p>
                </div>
                <h1>
                    <?= htmlspecialchars($offer["titre"]) ?>
                </h1>
                <div class="flex-col align-start gap-sm">
                    <h3>
                        Résumé
                    </h3>
                    <p>
                        <?= htmlspecialchars($offer["resume"]) ?>
                    </p>
                </div>
                <div class="flex-col align-start gap-md">
                    <?php if ($offer["telephone"] || $offer["site_web"]) { ?>
                        <h3>
                            Contact
                        </h3>
                        <?php if ($offer["telephone"]) { ?>
                            <div class="align">
                                <img src="./assets/icons/phone_primary.svg" alt="phone">
                                <p>
                                    <?= htmlspecialchars($offer["telephone"]) ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if ($offer["site_web"]) { ?>
                            <div class="align">
                                <img src="./assets/icons/earth_primary.svg" alt="earth">
                                <a href="<?= htmlspecialchars($offer["site_web"]) ?>">
                                    <p>
                                        <?= htmlspecialchars($offer["site_web"]) ?>
                                    </p>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="align">
                    <p class="italic">
                        Offre proposée par <?= $offer["professionnelData"]["raison_sociale"] ?>
                    </p>
                </div>
            </div>
        </section>
        <div class="infoTab flex-row align-start gap-lg">
            <section class="sectionOffreDetaille">
                <?php if ($offer["description_detaillee"]) { ?>
                    <div class="description flex-col align-start gap-sm">
                        <h3>
                            Description
                        </h3>
                        <p>
                            <?= htmlspecialchars($offer["description_detaillee"]) ?>
                        </p>
                    </div>
                <?php } ?>
                <div class="tags flex-row align-center gap-sm">
                    <?php foreach ($offer["tagData"] as $tag) { ?>
                        <div class="tag flex-row align-center">
                            <?= $tag["nom_tag"] ?>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <section class="sectionOffreDetaille">
                <div class="flex-col align-start gap-md">
                    <h3>
                        Informations sur l'offre
                    </h3>
                    <?= $InfoOffer ?>
                </div>
            </section>
        </div>
        <section class="sectionOffreDetaille gap-sm">
            <?php if ($fullAdresse) { ?>
                <h3>
                    Comment nous rejoindre ?
                </h3>
                <div id="mapTab" city="<?= $fullAdresse ?>" style="width: 100%; height: 300px;"></div>
                <div class="align">
                    <?php if ($offer["code_postal"]) { ?>
                        <img src="./assets/icons/location_primary.svg" alt="location">
                        <p>
                            <?= $fullAdresse ?>
                        </p>
                    <?php } ?>
                </div>
            <?php } ?>
        </section>
    </div>
</div>
<a href="?path=/avis/<?= $offer['id'] ?>">avis</a>
<?php $avis = $data['avis'];
    print_r($avis);
    exit;
?>
<div class="container-avis">
    <hr>
    <h3>Avis</h3>
    <?php ?>

</div>
<script src="./js/MapCalculator.js"></script>