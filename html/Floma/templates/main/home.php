<?php
use App\Service\MetricStarsCalculator;
use App\Enum\OfferCategoryEnum;
use App\Service\RestaurantPriceRangeCalculator;

$starCalculator = new MetricStarsCalculator();
$euroCalculator = new RestaurantPriceRangeCalculator();
?>

<!-- Section Offre -->
<section>
    <h2>Découvrez nos offres</h2>

    <?php foreach ($data["offers"] as $offer) { ?>
        <article class="offer-card">
            <!-- Image -->
            <div class="offer-card-img">

                <!-- Icone de catégorie -->
                <?php
                $icon = OfferCategoryEnum::tryFrom($offer['categorie'])?->getIcon();
                if ($icon) { ?>
                    <div class="offer-card-img-category-icon">
                        <img src="<?= $icon['path'] ?>" alt="<?= $icon['alt'] ?>">
                    </div>
                <?php } ?>

                <!-- Image de fond de l'offre -->
                <img src="/uploads/offers/chateau-de-lannion.jpg" alt="" class="offer-card-img-main">
            </div>

            <!-- Description -->
            <h3><?= htmlspecialchars($offer['titre']) ?></h3>
            <p><?= htmlspecialchars($offer['resume']) ?></p>

            <div class="offer-card-price-note">
                <!-- Note -->
                <div class="offer-card-note">
                    <div class="offer-card-note-stars">
                        <?= $starCalculator->calculStars($offer['note_moyenne']); ?>
                    </div>
                    <p>(<?= htmlspecialchars($offer['nombre_avis']) ?>)</p>
                </div>

                <!-- Prix -->
                <?php if ($offer['categorie'] != OfferCategoryEnum::Restauration->value) { ?>
                    <div class="offer-card-price">
                        <?= $offer['categoryData']->getPrixMinimal() ? '<p>' . $offer['categoryData']->getPrixMinimal() . '</p>' : '<p>Min. 0 €</p>' ?>
                        <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                    </div>
                <?php } else { ?>
                    <div class="offer-card-price-euros">
                        <?= $euroCalculator->calculEuros($offer['categoryData']->getGammeDePrix()) ?>
                    </div>
                <?php } ?>
            </div>

            <div class="offer-card-city-author">
                <!-- Ville -->
                <div class="offer-card-city">
                    <img src="/assets/icons/location_on_primary.svg" alt="">
                    <p><?= htmlspecialchars($offer['ville']) ?></p>
                </div>

                <!-- Auteur -->
                <p class="italic"><?= htmlspecialchars("Inconnu") ?></p>
            </div>
        </article>
    <?php } ?>
</section>