<?php
use App\Service\MetricStarsCalculator;

$Stars = new MetricStarsCalculator();
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
    <div class="contentTab">
        <div class="accueil">
            <img src="./assets/icons/chevron_left_black.svg" alt="chevron-left">
            <p class="subtitle">Accueil</p>
        </div>
        <div class="images hideMob">
            <img src="./uploads/offers/croisiere.jpg" alt="croisiere">
        </div>
        <div class="content">
            <section class="tabMainHead">
                <div class="images hideTab">
                    <img src="./uploads/offers/croisiere.jpg" alt="croisiere">
                </div>
                <div class="rightPart">
                    <h1>
                        <?= htmlspecialchars($data['offer']->getTitre()) ?>
                    </h1>
                    <div class="tags">
                        <div class="tag">
                            Plein air
                        </div>
                        <div class="tag">
                            Sport
                        </div>
                        <div class="tag">
                            Famille
                        </div>
                    </div>
                    <p>
                        <?= htmlspecialchars($data['offer']->getResume()) ?>
                    </p>
                    <div class="category">
                        <?= $Stars->calculStars($data['offer']->getNoteMoyenne()) ?>
                        <p>
                            <?=  "(" .  htmlspecialchars($data['offer']->getNombreAvis()) . ")" . " - " .  htmlspecialchars($data['offer']->getCategory()); ?>
                        </p>
                    </div>
                </div>
                <section class="hideTab">
                    <div class="contact">
                        <p class="subtitle">
                            Contact
                        </p>
                        <?php if ($data['offer']->getTelephone()) { ?>
                            <div class="phone">
                                <img src="./assets/icons/phone_primary.svg" alt="phone">
                                <p>
                                    <?=  htmlspecialchars($data['offer']->getTelephone()) ?>
                                </p>
                            </div>
                        <?php } ?>
                        <?php if ($data['offer']->getSiteWeb()) { ?>
                            <div class="site">
                                <img src="./assets/icons/earth_primary.svg" alt="earth">
                                <a href="<?= htmlspecialchars($data['offer']->getSiteWeb()) ?>">
                                    <p>
                                        <?= htmlspecialchars($data['offer']->getSiteWeb()) ?>
                                    </p>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            </section>

            <section>
                <div class="info">
                    <p class="subtitle">
                        Informations sur l'offre
                    </p>
                </div>
            </section>




            <section>
                <div class="description">
                    <p class="subtitle">
                        Description
                    </p>
                    <p>
                        <?= htmlspecialchars($data['offer']->getDescriptionDetaillee()) ?>
                    </p>
                </div>
            </section>
            <section>
                <p class="subtitle">
                    Comment nous rejoindre ?
                </p>
                <?php if ($data['offer']->getAdressePostale()) { ?>
                    <div id="map" city="<?= $data['offer']->getVille() ?>" style="width: 100%; height: 300px;"></div>
                <?php } ?>
                <div class="location">
                    <?php if ($data['offer']->getAdressePostale()) { ?>
                        <img src="./assets/icons/location_primary.svg" alt="location">
                        <p>
                            <?= htmlspecialchars($data['offer']->getAdressePostale()) ?>
                        </p>
                    <?php } ?>
                </div>
            </section>

            <section class="hideTel">
                <div class="contact">
                    <p class="subtitle">
                        Contact
                    </p>
                    <?php if ($data['offer']->getTelephone()) { ?>
                        <div class="phone">
                            <img src="./assets/icons/phone_primary.svg" alt="phone">
                            <p>
                                <?=  htmlspecialchars($data['offer']->getTelephone()) ?>
                            </p>
                        </div>
                    <?php } ?>
                    <?php if ($data['offer']->getSiteWeb()) { ?>
                        <div class="site">
                            <img src="./assets/icons/earth_primary.svg" alt="earth">
                            <a href="<?= htmlspecialchars($data['offer']->getSiteWeb()) ?>">
                                <p>
                                    <?= htmlspecialchars($data['offer']->getSiteWeb()) ?>
                                </p>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </section>
            <div>
                Offre proposée par l'Association 
                <div class="italic">
                    <?php echo "br br patapim" ?>
                </div>
            </div>
        </div>
    </div>
<script src="./js/MapCalculator.js"></script>
</body>
</html>
<style>
@media (width >= 26.75rem) {
    .category {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }

    .accueil {
        display: none;
    }

    .images img{
        width:100%;
        height:100%;
    }

    .hideTab {
        display: none;
    }

    .infoImage {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 25px;
    }

    .resume {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 10px;
    }

    .content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        padding: 1.25rem;
    }

    .phone {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }

    .site {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }

    .rightPart {
        display: flex; 
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 10px;
        width:100%;
    }

    .contact {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 15px;
    }

    .tag {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 0px 0.5rem;
        width: 4.813rem;
        height: 1.625rem;
        background: #005BB5;
        border-radius: 5px;
        color: #ffffff
    }

    .tags {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        align-content: flex-start;
        padding: 0px;
        gap: 0px 0.625rem;
    }

    .description {
        margin: 0 -1.25rem;
        padding: 0.938rem 1.25rem;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        isolation: isolate;
        background-color: #E5EFF6;
    }

    .location {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }
}

@media (width >= 90rem) {
    .accueil {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }

    .hideTab {
        display: block;
    }

    .hideMob {
        display: none;
    }

    .contentTab {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 35px;
        gap: 25px;
    }

    .category {
        display: flex;
        flex-direction: row;
        align-items: center;
        padding: 0px;
        gap: 3px;
    }

    .images img{
        width:39.875rem;
        height:24.563rem;
        border-radius: 15px;
    }

    .infoImage {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 25px;
    }

    .resume {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 10px;
    }

    .info {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 15px;
    }

    .phone {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 5px;
    }

    .site {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 5px;
    }

    .contact {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding: 0px;
        gap: 15px;
    }

    .tabMainHead {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 25px;
    }

}

body {
    background: #F5F7FA;
}


</style>
