<?php
use App\Service\MetricStarsCalculator;
use App\Enum\OfferCategoryEnum;
use App\Enum\OptionVisibiliteEnum;
use App\Service\RestaurantPriceRangeCalculator;

$starCalculator = new MetricStarsCalculator();
$euroCalculator = new RestaurantPriceRangeCalculator();
?>

<!-- Section Offre -->
<section>
    <h2>Découvrez nos offres</h2>

    <div class="offer-list">
        <?php foreach ($data["offers"] as $offer) { ?>
            <article class="offer-card">
                <!-- Image -->
                <div class="offer-card-img">
    
                    <?php
                    $optionsData = $offer['optionVisibiliteData'] ?? null;
    
                    $showPink = false;
                    $showGreen = false;
                
                    if ($optionsData) {
                        if (array_key_exists('nom_option', $optionsData)) {
                            $optionsData = [$optionsData];
                        }
    
                        foreach ($optionsData as $option) {
                            $label = $option['nom_option'] ?? null;
    
                            if ($label === OptionVisibiliteEnum::ALaUne->value) {
                                $showPink = true;
                                $showGreen = true;
                                break;
                            }
    
                            if ($label === OptionVisibiliteEnum::EnRelief->value) {
                                $showGreen = true;
                            }
                        }
                    }
                    ?>
    
                    <?php if ($showPink || $showGreen) { ?>
                        <div class="offer-card-img-badges">
    
                            <?php if ($showPink) { ?>
                                <div class="offer-card-img-badge-pink">
                                    <img src="/assets/icons/diamond_white.svg" alt="Icône diamant">
                                    <p class="very-small-text">Mis en avant</p>
                                </div>
                            <?php } ?>
    
                            <?php if ($showGreen) { ?>
                                <div class="offer-card-img-badge-green">
                                    <img src="/assets/icons/editor_choice_white.svg" alt="Icône choix éditeurs">
                                    <p class="very-small-text">Conseillé par nos équipes</p>
                                </div>
                            <?php } ?>
    
                        </div>
                    <?php } ?>
    
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
                    <?php if ($offer['categorie'] != OfferCategoryEnum::Restauration->value) {
                        if (isset($offer['categoryData'])) { ?>
                            <div class="offer-card-price">
                                <p><?= $offer['categoryData']['prix_minimal'] == 0 ? "Gratuit" : $offer['categoryData']['prix_minimal'] ?></p>
                                <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                            </div>
                        <?php } else { ?>
                            <div class="offer-card-price">
                                <p>Min. 0</p>
                                <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="offer-card-price-euros">
                            <?= $euroCalculator->calculEuros($offer['categoryData']['gamme_de_prix']) ?>
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
                    <p class="italic"><?= $offer['professionnelData']['raison_sociale'] ?></p>
    
                </div>
            </article>
        <?php } ?>
    </div>
</section>