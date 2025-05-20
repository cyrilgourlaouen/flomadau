<?php
use App\Service\MetricStarsCalculator;
use App\Enum\OfferCategoryEnum;

$metric = new MetricStarsCalculator();
?>
<section>
    <h2>Découvrez nos offres</h2>
    <?php
    foreach ($data["offers"] as $offer) { ?>
        <article class="offer-card">
            <div class="offer-card-img">

                <!-- Badges de l'offre -->
                 <div class="offer-card-img-badges">
                    <div class="offer-card-img-badge">
                        <img src="/assets/icons/accessible_black.svg" alt="Accessible">
                        <p>A la une</p>
                    </div>
                    <div class="offer-card-img-badge">

                    </div>
                 </div>

                <!-- Icone de catégorie -->
                <?php
                $icon = OfferCategoryEnum::tryFrom($offer->getCategorie())?->getIcon();
                if ($icon) { ?>
                    <div class=" offer-card-img-category-icon">
                        <img src="<?= $icon['path'] ?>" alt="<?= $icon['alt'] ?>">
                    </div>
                <?php } ?>

                <!-- Image de fond de l'offre -->
                <img src="/uploads/offers/chateau-de-lannion.jpg" alt="" class="offer-card-img-main">
            </div>
            <h3><?= htmlspecialchars($offer->getTitre()) ?></h3>
            <p><?= htmlspecialchars($offer->getResume()) ?></p>
            <div class="offer-card-price-note">
                <!-- Note -->
                <div class="offer-card-note">
                    <div class="offer-card-note-stars">
                        <?= $metric->calculStars($offer->getNoteMoyenne()); ?>
                    </div>
                    <p>(<?= htmlspecialchars($offer->getNombreAvis()) ?>)</p>
                </div>
                <!-- Prix -->
                <div>
                    <img src="/assets/icons/pr" alt="">
                    <p>(<?= htmlspecialchars($offer->getNombreAvis()) ?>)</p>
                </div>
            </div>
            <div class="offer-card-city-author">
                <!-- Ville -->
                <div class="offer-card-city">
                    <img src="/assets/icons/location_on_primary.svg" alt="">
                    <p><?= htmlspecialchars($offer->getVille()) ?></p>
                </div>

                <!-- Autheur -->
                <p class="italic"><?= htmlspecialchars("Inconnu") ?></p>
            </div>
        </article>
    <?php } ?>
</section>