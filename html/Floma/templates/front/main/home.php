<?php
use App\Service\MetricStarsCalculator;
use App\Enum\OfferCategoryEnum;
use App\Enum\OptionVisibiliteEnum;

$starCalculator = new MetricStarsCalculator();

$highlightedOffers = array_filter($data["offers"], function ($offer) {
    return !empty($offer['optionVisibiliteData']) &&
        in_array(
            OptionVisibiliteEnum::ALaUne->value,
            array_column($offer['optionVisibiliteData'], 'nom_option')
        );
});
?>

<!-- Selection du moment -->
<?php if ($highlightedOffers) { ?>
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
                                <img class="highlighted-card-img-category-icon-img" src="<?= $icon['path'] ?>"
                                    alt="<?= $icon['alt'] ?>">
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
                            <img src="/uploads/offers/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'offre"
                                class="offer-card-img-main">
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


<div class="filter-modal">
    <div class="filter-modal-content-wrapper">
        <div class="filter-modal-header">
            <h2>Filtrer par</h2>
            <img src="/assets/icons/close_black.svg" alt="close icon" id="filter-close-icon">
        </div>
        <div class="filter-modal-content">
            <div class="filter-modal-sort" id="filter-modal-category">
                <h3>Catégorie</h3>
                <div class="filter-modal-category-options">
                    <?php foreach (OfferCategoryEnum::cases() as $category) { ?>
                        <div class="filter-modal-category-option" data-category="<?= $category->value ?>">
                            <img src="<?= $category->getIcon()['path'] ?>" alt="<?= $category->getIcon()['alt'] ?>">
                            <p><?= $category->value ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="filter-modal-sort" id="filter-modal-date">
                <h3>Date</h3>
                <div class="filter-modal-date-options">
                    <div class="filter-modal-date-option">
                        <label for="start-date">Début</label>
                        <input type="date" id="start-date">
                    </div>
                    <div class="filter-modal-date-option">
                        <label for="end-date">Fin</label>
                        <input type="date" id="end-date">
                    </div>
                </div>
            </div>
            <div id="filter-modal-location">
                <h3>Lieu</h3>
                <div>

                </div>
            </div>
            <div class="filter-modal-sort" id="filter-modal-price">
                <h3>Prix</h3>
                <div class="filter-modal-price-options">
                    <div class="filter-modal-price-minimum">
                        <label for="min-price">Min</label>
                        <div class="filter-modal-price-icon-wrapper">
                            <div class="filter-modal-price-icon">
                                <img src="/assets/icons/euro_symbol_white.svg" alt="Symbole euro">
                            </div>
                            <input type="number" name="Minimum" id="min-price">
                        </div>
                    </div>
                    <div class="filter-modal-price-maximum">
                        <label for="">Max</label>
                        <div class="filter-modal-price-icon-wrapper">
                            <div class="filter-modal-price-icon">
                                <img src="/assets/icons/euro_symbol_white.svg" alt="Symbole euro">
                            </div>
                            <input type="number" name="Maximum" id="max-price">
                        </div>
                    </div>
                </div>

                <div class="filter-modal-price-range-options">
                    <p class="filter-modal-price-range-option" data-price-range="1">Moins de 25€</p>
                    <p class="filter-modal-price-range-option" data-price-range="2">Entre 25 - 40€</p>
                    <p class="filter-modal-price-range-option" data-price-range="3">Plus de 40€</p>
                </div>
            </div>


            <div class="filter-modal-sort" id="filter-modal-note">
                <h3>Note</h3>
                <div>

                </div>
            </div>
            <div class="filter-modal-sort" id="filter-modal-status">
                <h3>Statut</h3>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Offre -->
<section class="offer-section" data-offers='<?= htmlspecialchars(json_encode($data["offers"]), ENT_QUOTES, 'UTF-8') ?>'>
    <h2>Découvrez nos offres</h2>

    <div class="offer-controls">
        <div class="offer-search">
            <div class="offer-search-bar">
                <input type="text" id="offer-search-input" placeholder="Rechercher par lieu, catégorie, mot-clé">
            </div>
            <div class="offer-search-filters">
                <button id="offer-search-filter-button">Filtrer</button>

                <!-- Catégorie -->
                <div class="desktop-filter-dropdown">
                    <button class="desktop-filter-button" id="desktop-categorie-button">Catégorie <span
                            id="selected-category-label"></span></button>
                    <div class="desktop-filter-options" id="desktop-categorie-options">
                        <?php foreach (OfferCategoryEnum::cases() as $category) { ?>
                            <p class="desktop-filter-option" data-category="<?= $category->value ?>"><?= $category->value ?>
                            </p>
                        <?php } ?>
                    </div>
                </div>

                <!-- Prix -->
                <div class="desktop-filter-dropdown">
                    <button class="desktop-filter-button" id="offer-price-desktop-button">
                        Prix <span id="selected-price-label"></span>
                    </button>
                    <div id="desktop-price-options">
                        <div>
                            <label for="min-price">Min</label>
                            <div class="filter-modal-price-icon-wrapper">
                                <div class="filter-modal-price-icon">
                                    <img src="/assets/icons/euro_symbol_white.svg" alt="Symbole euro">
                                </div>
                                <input type="number" name="Minimum" id="min-price-desktop">
                            </div>
                        </div>
                        <div>
                            <label for="">Max</label>
                            <div class="filter-modal-price-icon-wrapper">
                                <div class="filter-modal-price-icon">
                                    <img src="/assets/icons/euro_symbol_white.svg" alt="Symbole euro">
                                </div>
                                <input type="number" name="Maximum" id="max-price-desktop">
                            </div>
                        </div>
                    </div>
                    <div id="desktop-price-range-options">
                        <p class="desktop-price-range-option" data-price-range="1">Moins de 25€</p>
                        <p class="desktop-price-range-option" data-price-range="2">Entre 25 - 40€</p>
                        <p class="desktop-price-range-option" data-price-range="3">Plus de 40€</p>
                    </div>
                </div>

                <!-- Date -->
                <div class="desktop-filter-dropdown">
                    <button class="desktop-filter-button" id="offer-date-desktop-button">
                        Date <span id="selected-date-label"></span>
                    </button>
                    <div id="desktop-date-options">
                        <div class="desktop-date-option">
                            <label for="start-date">Début</label>
                            <input type="date" id="desktop-start-date">
                        </div>
                        <div class="desktop-date-option">
                            <label for="end-date">Fin</label>
                            <input type="date" id="desktop-end-date">
                        </div>
                    </div>
                </div>

                <select name="Statut" id="">
                    <option value="">Statut</option>
                </select>
                <select name="Note" id="">
                    <option value="">Note</option>
                </select>

                <!-- Tri -->
                <div class="offer-sort-desktop">
                    <button id="offer-sort-desktop-button">
                        Trier par : <span id="selected-sort-desktop-label">Date d'ajout</span>
                    </button>
                    <div id="offer-sort-desktop-options">
                        <p id="date" class="selected-sort">Date d'ajout</p>
                        <p id="asc">Prix croissant</p>
                        <p id="desc">Prix décroissant</p>
                        <p id="note">Note</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="offer-sort-mobile">
            <button id="offer-sort-mobile-button">
                Trier par : <span id="selected-sort-mobile-label"></span>
            </button>
            <div id="offer-sort-mobile-options">
                <p id="date" class="selected-sort">Date d'ajout</p>
                <p id="asc">Prix croissant</p>
                <p id="desc">Prix décroissant</p>
                <p id="note">Note</p>
            </div>
        </div>
    </div>

    <div class="offer-list">
        <?php foreach ($data["offers"] as $offer) { ?>
            <a href="?path=offer/<?= $offer['id'] ?>" class="offer-card" data-offer-id="<?= $offer['id'] ?>">
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
                        <img src="/uploads/offers/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'offre"
                            class="offer-card-img-main">
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
<script type="module" src="/js/offerDisplayControl.js"></script>