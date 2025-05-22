<?php
use App\Manager\OfferManager;
use App\Manager\TagManager;
use App\Service\CategoryContent;
use App\Service\MetricStarsCalculator;

$stars = new MetricStarsCalculator();
$offerManager = new OfferManager();
$categoryContent = new CategoryContent();
$offer = $data["offer"];
$InfoOffer =  isset($offer["typeRepasData"]) || isset($offer["langueGuideData"]) 
? $categoryContent->getContentCategory($offer["categoryData"], $offer["categorie"], $offer["conditions_accessibilite"], isset($offer["typeRepasData"]) ? $offer["typeRepasData"] : $offer["langueGuideData"]) 
: $categoryContent->getContentCategory($offer["categoryData"], $offer["categorie"], $offer["conditions_accessibilite"]);
$fullAdresse = !$offer["numero_rue"] || !$offer["nom_rue"] ? $offer["ville"] : $offer["numero_rue"] . " " . $offer["nom_rue"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="contentMob hideMob">
        <div class="images">
            <img src="./uploads/offers/croisiere.jpg" alt="croisiere">
        </div>
        <div class="content">
            <section class="tabMainHead">
                <div class="rightPart">
                    <h1>
                        <?= htmlspecialchars($offer["titre"]) ?>
                    </h1>
                    <div class="tags">
                        <?php foreach($offer["tagData"] as $tag) {?>
                            <div class="tag">
                                <?= $tag["nom_tag"]?>
                            </div>
                        <?php } ?>
                    </div>
                    <p>
                        <?= htmlspecialchars($offer["resume"]) ?>
                    </p>
                    <div class="category">
                        <?= $stars->calculStars($offer["note_moyenne"]) ?>
                        <p>
                            <?=  "(" .  htmlspecialchars($offer["nombre_avis"]) . ")" . " - " .  htmlspecialchars($offer["categorie"]); ?>
                        </p>
                    </div>
                </div>
            </section>
            <section>
                <div class="info">
                    <h3>
                        Informations sur l'offre
                    </h3>

                    <div class="gap"><?= $InfoOffer ?></div>
                </div>
            </section>
            <?php if ($offer["description_detaillee"]) {?>
            <section>
                <div class="description">
                    <h3>
                        Description
                    </h3>
                    <p>
                        <?= htmlspecialchars($offer["description_detaillee"]) ?>
                    </p>
                </div>
            </section>
            <?php } ?>
            <section>
                <h3>
                    Comment nous rejoindre ?
                </h3>
                <?php if ($fullAdresse) { ?>
                    <div id="map" city="<?= $fullAdresse ?>" style="width: 100%; height: 300px;"></div>
                <?php } ?>
                <div class="location">
                    <?php if ($offer["code_postal"]) { ?>
                        <img src="./assets/icons/location_primary.svg" alt="location">
                        <p>
                            <?= $fullAdresse ?>
                        </p>
                    <?php } ?>
                </div>
            </section>
            <section>
                <div class="contact">
                    <?php if ($offer["telephone"] || $offer["site_web"]) {?>
                    <h3>
                        Contact
                    </h3>
                    <?php if ($offer["telephone"]) { ?>
                        <div class="align">
                            <img src="./assets/icons/phone_primary.svg" alt="phone">
                            <p>
                                <?=  htmlspecialchars($offer["telephone"]) ?>
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
        <div class="accueil">
            <img src="./assets/icons/chevron_left_black.svg" alt="chevron-left">
            <h3>Accueil</h3>
        </div>
        <div class="content">
            <section class="tabMainHead">
                <div class="images">
                    <img src="./uploads/offers/croisiere.jpg" alt="croisiere">
                </div>
                <div class="rightPart">
                    <div class="category">
                        <?= $stars->calculStars($offer["note_moyenne"]) ?>
                        <p>
                            <?=  "(" .  htmlspecialchars($offer["nombre_avis"]) . ")" . " - " .  htmlspecialchars($offer["categorie"]); ?>
                        </p>
                    </div>
                    <h1>
                        <?= htmlspecialchars($offer["titre"]) ?>
                    </h1>
                    <div class="summary">
                        <h3>
                            Résumé
                        </h3>
                        <p>
                            <?= htmlspecialchars($offer["resume"]) ?>
                        </p>
                    </div>
                    <div class="contact">
                        <?php if ($offer["telephone"] || $offer["site_web"]) {?>
                        <h3>
                            Contact
                        </h3>
                        <?php if ($offer["telephone"]) { ?>
                            <div class="align">
                                <img src="./assets/icons/phone_primary.svg" alt="phone">
                                <p>
                                    <?=  htmlspecialchars($offer["telephone"]) ?>
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
                            Offre proposée par <?=  $offer["professionnelData"]["raison_sociale"]  ?>
                        </p>
                    </div>
                </div>
            </section>
            <div class="infoTab">
                <section class="leftPart">
                    <?php if ($offer["description_detaillee"]) {?>
                    <div class="description">
                        <h3>
                            Description
                        </h3>
                        <p>
                            <?= htmlspecialchars($offer["description_detaillee"]) ?>
                        </p>
                    </div>
                    <?php } ?>
                    <div class="tags">
                        <?php foreach($offer["tagData"] as $tag) {?>
                            <div class="tag">
                                <?= $tag["nom_tag"]?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <section>
                <div class="info">
                    <h3>
                        Informations sur l'offre
                    </h3>
                    <?= $InfoOffer ?>
                </div>
            </section>
            </div>
            <section>
                <?php if ($fullAdresse) { ?>
                <h3>
                    Comment nous rejoindre ?
                </h3>
                    <div id="mapTab" city="<?= $fullAdresse ?>" style="width: 100%; height: 300px;"></div>
                <div class="location">
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
<script src="./js/MapCalculator.js"></script>
</body>
</html>