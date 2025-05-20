<?php
    use App\Service\MetricStarsCalculator;
    use App\Enum\OfferCategoryEnum;
    use function App\Enum\getCategoryIcon;

    $metric = new MetricStarsCalculator();
?>
<section>
    <h2>Découvrez nos offres</h2>
    <?php
        foreach ($data["offers"] as $offer) { ?>
            <img src="<?= getCategoryIcon(OfferCategoryEnum::Show) ?>" alt="">
            <article class="offer-card">
                <div class="offer-card-img">
                    <img src="/uploads/offers/chateau-de-lannion.jpg" alt="" class="offer-card-main-img">
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
                    <p><?= htmlspecialchars("Inconnu") ?></p>
                </div>
            </article>
        <?php } ?>
</section>