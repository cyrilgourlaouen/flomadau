<div>
    <?php
        use App\Service\MetricStarsCalculator;
        use App\Enum\OfferCategoryEnum;
        use App\Enum\OptionVisibiliteEnum;
        $starCalculator = new MetricStarsCalculator();

        include 'button.php';

        $nb_offres = 0;
        $nb_avis = 0;

        /*$now = new DateTime();
        $formatter = new IntlDateFormatter( "fr_FR" , IntlDateFormatter::NONE, IntlDateFormatter::NONE, null, null, 'MMMM');
        $mois = $formatter->format($now);
        echo($mois);*/
        $mois = 'JUIN';

        //En-tête
        $head_title = "ACCUEIL";
        $raison_sociale = null;//$data['offers'][0]['professionnelData']['raison_sociale'];
        if($raison_sociale === null){
            $head_subtitle = "";
        }else{
            $head_subtitle = $raison_sociale;
        }
        $head_svg = "/assets/icons/account_white.svg";
        include 'head_title.php';
    ?>
</div>
<div id="body_acceuil">
    <?php
        if(/*!*/isset($_SESSION['id'])){
            ?>
                <div class="msg_offer">
                    <p class="text_offer">Vous souhaitez bénéficier des options professionnelles ?</p>
                    <div id="btn_co_inscription">
                        <button id="btn_connexion"><a href="?path=/pro/connexion">Connexion</a></button>
                        <button id="btn_inscription"><a href="?path=/pro/inscription">Inscription</a></button>
                    </div>
                </div>
            <?php
        }else if(empty($data["offers"])){
            ?>
                <div>
                    <div class="msg_offer">
                        <p class="text_offer">Vous n'avez pas encore déposé d'offre</p>
                    </div>
                </div>
            <?php
        }else{
            include 'nav_searchbar.php';
    ?>
        <div class="list_offer">
    <?php
        foreach ($data["offers"] as $offer) { ?>
        <article class="offer-card">
            <!-- Image -->
            <div class="offer-card-img">

                <!-- Image de fond de l'offre -->
                <?php
                    $imageUrl = null;

                    if (!empty($offer['imageData']) && is_array($offer['imageData'])) {
                        // Cherche l'image principale en priorité
                        foreach ($offer['imageData'] as $img) {
                            if ($img['principale']) {
                                $imageUrl = $img['url_img'] ?? null;
                                break;
                            }
                        }
                    }
                ?>
                <?php if ($imageUrl) { ?>
                    <img src="/uploads/offers/<?= htmlspecialchars($imageUrl) ?>" alt="Image de l'offre" class="offer-card-img">
                <?php } ?>
            </div>
            <div class="offer-card-info-layout">
                <!-- Description -->
                <div class="offer-card-gap">
                    <h3><?= htmlspecialchars($offer['titre']) ?></h3>
                    <p><?= htmlspecialchars($offer['resume']) ?></p>
                </div>

                <div class="offer-card-category-prix-lieu">
                    <!-- Catégorie -->
                    <p>Catégorie : <?php echo $offer['categorie'];?></p>

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

                    <!-- Ville -->
                    <div class="offer-card-city">
                        <img src="/assets/icons/location_primary.svg" alt="Icone de localisation">
                        <p><?= htmlspecialchars($offer['ville']) ?></p>
                    </div>
                </div>

                <div class="offer-card-price-note">
                    <!-- Note -->
                    <div class="offer-card-note">
                        <div class="offer-card-note-stars">
                            <?= $starCalculator->calculStars($offer['note_moyenne']); ?>
                        </div>
                        <p>(<?= htmlspecialchars($offer['nombre_avis']) ?>)</p>
                    </div>
                    <p>Aucun avis non consulté</p>
                    <p>Aucun avis non répondu</p>
                </div>
            </div>
            <div id="offer-card-right-layout">
                <div id="offer-online-visibility">
                    <!--Options de vibilité choisies-->
                    <?php
                        $optionsData = $offer['optionVisibiliteData'] ?? null;

                        $une = false;
                        $relief = false;

                        if ($optionsData) {
                            if (array_key_exists('nom_option', $optionsData)) {
                                $optionsData = [$optionsData];
                            }

                            foreach ($optionsData as $option) {
                                $label = $option['nom_option'] ?? null;

                                if ($label === OptionVisibiliteEnum::ALaUne->value) {
                                    ?>
                                        <p>A la une</p>
                                    <?php
                                }

                                if ($label === OptionVisibiliteEnum::EnRelief->value) {
                                    ?>
                                        <p>A la une</p>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </article>
    <?php 
            }
        }
    ?>
    </div>
</div>