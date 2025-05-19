<section>
    <h2>Découvrez nos offres</h2>
    <?php
        foreach ($data["offers"] as $offer) { ?>
            <article class="offer-card">
                <div>
                    <img src="/uploads/offers/chateau-de-lannion.jpg" alt="" class="offer-card-main-img">
                </div>
                <h3><?= htmlspecialchars($offer->getTitre()) ?></h3>
                <p><?= htmlspecialchars($offer->getResume()) ?></p>
                <div class="offer-card-price-note">
                    <!-- Note -->
                     <div class="offer-card-note">
                        
                     </div>
                    <!-- Prix -->
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