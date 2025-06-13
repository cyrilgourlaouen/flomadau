<?php
use App\Service\MetricStarsCalculator;
use App\Enum\OfferCategoryEnum;
use App\Enum\OptionVisibiliteEnum;

$starCalculator = new MetricStarsCalculator();

$highlightedOffers = array_filter($data["offers"], function($offer) {
    return !empty($offer['optionVisibiliteData']) &&
        in_array(
            OptionVisibiliteEnum::ALaUne->value,
            array_column($offer['optionVisibiliteData'], 'nom_option')
        );
});
?>

<!-- Selection du moment -->
<?php if($highlightedOffers) { ?>
<section class="highlighted-offers-section">
    <h2>Sélection du moment</h2>
    <div class="highlighted-offers-list-arrows">
        <img src="/assets/icons/left_square_chevron_black.png" id="highlighted-arrow-left" alt="">
        <img src="/assets/icons/right_square_chevron_black.png" id="highlighted-arrow-right" alt="">
    </div>
    <div class="highlighted-offers-list">
        <?php foreach ($highlightedOffers as $offer) { ?>
                <a href="?path=offer/<?= $offer['id'] ?>" class="highlighted-card">
                    <!-- Image -->
                    <div class="highlighted-card-img">
                        <!-- Icône de catégorie -->
                        <?php
                        $icon = OfferCategoryEnum::tryFrom($offer['categorie'])?->getIcon();
                        if ($icon) { ?>
                            <div class="highlighted-card-img-category-icon">
                                <img class="highlighted-card-img-category-icon-img" src="<?= $icon['path'] ?>" alt="<?= $icon['alt'] ?>">
                            </div>
                        <?php } ?>

                        <!-- Image de fond de l'offre -->
                        <?php
                        $imageUrl = null;

                        if (!empty($offer['imageData']) && is_array($offer['imageData'])) {
                            foreach ($offer['imageData'] as $img) {
                                if (!empty($img['principale'])) {
                                    $imageUrl = $img['url_img'] ?? null;
                                    break;
                                }
                            }

                            if (!$imageUrl && isset($offer['imageData'][0]['url_img'])) {
                                $imageUrl = $offer['imageData'][0]['url_img'];
                            }
                        }
                        ?>
                        <?php if ($imageUrl) { ?>
                            <img src="/uploads/offers/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'offre" class="offer-card-img-main">
                        <?php } else { ?>
                            <img src="assets/images/no-image.png" alt="Image de l'offre" class="offer-card-img-main">
                        <?php } ?>
                    </div>

                    <!-- Description -->
                    <div class="highlighted-card-info">
                        <!-- Titre -->
                        <h3><?= htmlspecialchars($offer['titre']) ?></h3>
                        
                        <!-- Note -->
                        <div class="highlighted-card-note">
                            <div class="highlighted-card-note-stars">
                                <?= $starCalculator->calculStars($offer['note_moyenne']); ?>
                            </div>
                            <p>(<?= htmlspecialchars($offer['nombre_avis']) ?>)</p>
                        </div>

                        <!-- Prix -->
                        <?php if ($offer['categorie'] != OfferCategoryEnum::Restauration->value) {
                            if (isset($offer['categoryData'])) { ?>
                                <div class="highlighted-card-price">
                                    <p><?= $offer['categoryData']['prix_minimal'] == 0 ? "Gratuit" : $offer['categoryData']['prix_minimal'] ?>
                                    </p>
                                    <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                                </div>
                            <?php } else { ?>
                                <div class="highlighted-card-price">
                                    <p>Min. 0</p>
                                    <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="highlighted-card-price-euros">
                                <?= str_repeat("<img src='/assets/icons/euro_symbol_primary.svg' alt='Icone d'euro'>", $offer["categoryData"]["gamme_de_prix"]) ?>
                            </div>
                        <?php } ?>

                        <!-- Ville -->
                        <div class="highlighted-card-city">
                            <img src="/assets/icons/location_primary.svg" alt="Icone de localisation">
                            <p><?= htmlspecialchars($offer['ville']) ?></p>
                        </div>
                    </div>
                </a>
            <?php } ?>
    </div>
</section>
<?php } ?>

<!-- Section Offre -->
<section class="offer-section">
    <h2>Découvrez nos offres</h2>

    <div class="offer-list">
        <?php foreach ($data["offers"] as $offer) { ?>
            <a href="?path=offer/<?= $offer['id'] ?>" class="offer-card">
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

                    <!-- Icône de catégorie -->
                    <?php
                    $icon = OfferCategoryEnum::tryFrom($offer['categorie'])?->getIcon();
                    if ($icon) { ?>
                        <div class="offer-card-img-category-icon">
                            <img class="offer-card-img-category-icon-img" src="<?= $icon['path'] ?>" alt="<?= $icon['alt'] ?>">
                        </div>
                    <?php } ?>

                    <!-- Image de fond de l'offre -->
                    <?php
                    $imageUrl = null;

                    if (!empty($offer['imageData']) && is_array($offer['imageData'])) {
                        foreach ($offer['imageData'] as $img) {
                            if (!empty($img['principale'])) {
                                $imageUrl = $img['url_img'] ?? null;
                                break;
                            }
                        }

                        if (!$imageUrl && isset($offer['imageData'][0]['url_img'])) {
                            $imageUrl = $offer['imageData'][0]['url_img'];
                        }
                    }
                    ?>
                    <?php if ($imageUrl) { ?>
                        <img src="/uploads/offers/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'offre" class="offer-card-img-main">
                    <?php } else { ?>
                        <img src="assets/images/no-image.png" alt="Image de l'offre" class="offer-card-img-main">
                    <?php } ?>

                </div>

                <div class="offer-card-info-layout">
                    <!-- Description -->
                    <div class="offer-card-gap">
                        <h3><?= htmlspecialchars($offer['titre']) ?></h3>
                        <p><?= htmlspecialchars($offer['resume']) ?></p>
                    </div>

                    <div class="offer-card-gap">
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
                                        <p><?= $offer['categoryData']['prix_minimal'] == 0 ? "Gratuit" : $offer['categoryData']['prix_minimal'] ?>
                                        </p>
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
                                    <?= str_repeat("<img src='/assets/icons/euro_symbol_primary.svg' alt='Icone d'euro'>", $offer["categoryData"]["gamme_de_prix"]) ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="offer-card-city-author">
                            <!-- Ville -->
                            <div class="offer-card-city">
                                <img src="/assets/icons/location_primary.svg" alt="Icone de localisation">
                                <p><?= htmlspecialchars($offer['ville']) ?></p>
                            </div>

                            <!-- Auteur -->
                            <p class="italic"><?= $offer['professionnelData']['raison_sociale'] ?></p>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</section>
<script src="/js/highlightedOffer.js"></script>