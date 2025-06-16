<div>
    <?php

        use App\Service\MetricStarsCalculator;
        use App\Enum\OfferCategoryEnum;
        use App\Enum\OptionVisibiliteEnum;
        $starCalculator = new MetricStarsCalculator();

        include 'button.php';

        $raison_sociale = null;

        if(isset($_SESSION['code_pro'])){
            $nbOffres = count($data['offers']);
            /*TODO récupérer le nombre d'avis non consulté*/
            $nbAvisNonConsulte = 0;
            $nbAvisNonRepondu = 0;

            foreach($data['offers'] as $offre){
                foreach($offre['avisData'] as $avis){
                    if(empty($avis['reponseProData'])){
                        $nbAvisNonRepondu++;
                    }
                }
            }

            $raison_sociale = $data['offers'][0]['professionnelData']['raison_sociale'];
        }

        //En-tête
        $head_title = "ACCUEIL";
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
        if(!isset($_SESSION['code_pro'])){
            ?>
                <div class="msg_offer">
                    <p class="text_offer">Vous souhaitez bénéficier des options professionnelles ?</p>
                    <div id="btn_co_inscription">
                        <a href="?path=/pro/connexion"><button id="btn_connexion">Connexion</button></a>
                        <a href="?path=/pro/inscription"><button id="btn_inscription">Inscription</button></a>
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
            /*TODO : Implémenter barre de recherche + filtres si on a le temps */
            include 'nav_searchbar.php';
    ?>
        <div id="list_offer">
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
                <div class="offer-card-section-one">
                    <h3><?= htmlspecialchars($offer['titre']) ?></h3>
                    <?php 
                        if(strlen($offer['description_detaillee']) > 200){
                            $description = substr($offer['description_detaillee'],0, 200);
                            if(strrpos($description, ' ')){
                                $description = substr($description, 0, strrpos($description, ' '));
                            }
                            $description.='...';
                        }else{
                            $description = $offer['description_detaillee'];
                        }
                    ?>
                    <p><?= htmlspecialchars($description) ?></p>
                </div>
                <div class="offer-card-section-two">
                    <div class="offer-card-category-prix-lieu">
                        <!-- Catégorie -->
                        <p>Catégorie : <?= $offer['categorie'];?></p>

                        <!-- Prix -->
                        <?php if ($offer['categorie'] != OfferCategoryEnum::Restauration->value) {
                            if (isset($offer['categoryData'])) { ?>
                                <div class="offer-card-price">
                                    <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                                    <p><?= $offer['categoryData']['prix_minimal'] == 0 ? "Gratuit" : $offer['categoryData']['prix_minimal'] ?> euros</p>
                                </div>
                            <?php } else { ?>
                                <div class="offer-card-price">
                                    <p>Min. 0</p>
                                    <img src="/assets/icons/euro_symbol_primary.svg" alt="Icone d'euro">
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="offer-card-price-euros">
                                <?= str_repeat("<img src='/assets/icons/paid_primary.svg' alt='Icone d'euro'>", $offer["categoryData"]["gamme_de_prix"]) ?>
                            </div>
                        <?php } ?>

                        <!-- Ville -->
                        <div class="offer-card-city">
                            <img src="/assets/icons/location_primary.svg" alt="Icone de localisation">
                            <p><?= htmlspecialchars($offer['ville']) ?></p>
                        </div>
                    </div>
                
                    <div class="offer-card-note-avis">
                        <!-- Note -->
                        <div class="offer-card-note">
                            <div class="offer-card-note-stars">
                                <?= $starCalculator->calculStars($offer['note_moyenne']); ?>
                            </div>
                            <p>(<?= htmlspecialchars($offer['nombre_avis']) ?>)</p>
                        </div>
                        <?php
                            $lienNbAvisNnConsulte = 0;
                            $lienNbAvisNnRepondu = 0;
                            
                            foreach($offer['avisData'] as $avisOffre){
                                if(empty($avisOffre['reponseProData'])){
                                    $lienNbAvisNnRepondu++ ;
                                }
                            }

                            if($lienNbAvisNnRepondu === 0){
                                $lienNbAvisNnRepondu = 'Aucun';
                            }
                            
                            if($lienNbAvisNnConsulte === 0){
                                $lienNbAvisNnConsulte = 'Aucun';
                            }
                        ?>
                        <!--TODO A completer quand la page sera ok--><a href=""><?= $lienNbAvisNnConsulte ?> avis non consulté</a>
                        <!--TODO A completer quand la page sera ok--><a href=""><?= $lienNbAvisNnRepondu ?> avis non répondu</a>
                    </div>
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
                                        <p>En relief</p>
                                    <?php
                                }
                            }
                        }
                    ?>
                </div>
                <!-- Btn voir plus -->
                <!--TODO le faire pointer vers la page de consultation-->
                <?= button('Voir plus', 'btn_voir_plus'); ?>
            </div>
        </article>
    <?php 
            }
        }
    ?>
    </div>
</div>