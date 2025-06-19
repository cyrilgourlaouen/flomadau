<?php

use App\Manager\LangueGuideManager;
use App\Manager\TagManager;
use App\Manager\TypeRepasManager;
use App\Resource\LangueGuideResource;
use App\Resource\TagResource;
use App\Resource\TypeRepasResource;
use App\Service\ManageOption;

$head_title = "Création du compte";
$head_subtitle = "INFORMATIONS ENTREPRISE";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
if(!isset($_SESSION['code_pro'])){
    ?>
    <div id="body_acceuil">
        <div class="msg_offer">
            <p class="text_offer">Vous souhaitez bénéficier des options professionnelles ?</p>
            <div id="btn_co_inscription">
                <a href="?path=/pro/connexion"><button id="btn_connexion">Connexion</button></a>
                <a href="?path=/pro/inscription"><button id="btn_inscription">Inscription</button></a>
            </div>
        </div>
    </div>
    <?php
} else {
?>

<form action="?path=/offre/creation/new" method="post" enctype="multipart/form-data" class="formContainer">
    <section class="formSectionContainer">
        <section class="formSectionContainer">
        <div class="h3-section">
            <h3>Information principales</h3>
            <hr>
        </div>

        <div class="formInline">
            <div class="field">
                <label for="offer_name">Nom de l'offre *</label>
                <input name="offer_name" id="offer_name" type="text" placeholder="..." >
            </div>

            <div class="field">
                <label for="categorie">Catégorie</label>
                <select name="categorie" id="categorie" onchange="afficherChamps()">
                    <option value="" selected disabled hidden>-- Catégorie --</option>
                    <option value="Visite">Visite</option>
                    <option value="Spectacle">Spectacle</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Activite">Activite</option>
                    <option value="Parc d'attraction">Parc d'attraction</option>
                </select>
            </div>
            <div class="formInline hidden align-end" id="champs-visite">
                <div class="gap-vsm flex-col">
                    <label for="duree_visite">Duree *</label>
                    <input type="text" name="duree_visite" id="duree_visite" placeholder="2h30">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="prix_minimal_visite">Prix minimal *</label>
                    <input type="number" name="prix_minimal_visite" id="prix_minimal_visite" placeholder="15.5">
                </div>
                <div>
                    <label class="checkbox-item">
                        <input type="checkbox" id="guideCheckbox" name="guide" id="guide" value="true">
                        <span>Guide</span>
                    </label>
                </div>
                <div class="gap-vsm flex-col hidden" id="selectGuides">
                    <label for="guideOptions">Langue du guide *
                        <span class="tooltip-trigger">
                            <img src="./assets/icons/info_black.svg">
                            <span class="tooltip-text">
                                Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags.
                            </span>
                        </span>
                    </label>
                    <?php 
                        $guideManager = new LangueGuideManager();
                        $manageOption = new ManageOption();
                        $enrichedOffer = LangueGuideResource::buildAll($guideManager->findAll());
                        $guide = $manageOption->getGuides($enrichedOffer);
                    ?>
                        <select name="guides[]" id="guideOptions" multiple>    
                            <?= $guide ?>
                        </select>
                </div>
                
            </div>

            <div class="formInline hidden" id="champs-spectacle">
                <div class="gap-vsm flex-col">
                    <label for="duree_show">Duree *</label>
                    <input type="text" name="duree_show" id="duree_show" placeholder="2h30">
                </div>

                <div class="gap-vsm flex-col">
                    <label for="prix_minimal_show">Prix minimal *</label>
                    <input type="number" name="prix_minimal_show" id="prix_minimal_show" placeholder="15.5">
                </div>

                <div class="gap-vsm flex-col">
                    <label for="capacite">Capacite *</label>
                    <input type="number" name="capacite" id="capacite" placeholder="500">
                </div>
            </div>

            <div id="champs-restaurant" class="hidden formInline">
                <div class="gap-vsm flex-col">
                    <label for="type_cuisine">Gamme de prix *</label>
                    <select name="gamme_de_prix" class="text-center" id="gamme_de_prix">
                        <option value="" selected disabled hidden>-- Gamme --</option>
                        <option value="1">Moins de 25 euros</option>
                        <option value="2">Entre 25 et 40 euros</option>
                        <option value="3">Plus de 40 euros</option>
                    </select>
                </div>
                <div class="gap-vsm flex-col">
                    <label for="url_carte_restaurant" >Carte du restaurant *</label>
                    <input type="file" name="url_carte_restaurant" id="url_carte_restaurant">
                </div>
                <div class="checkbox-group flex-col" id="types_repas">
                    <label for="checkbox-group" class="text-center">Type de repas *</label>
                    <div class="flex-row gap-vsm">
                        <?php 
                        $typeRepasManager = new TypeRepasManager();
                        $typesRepas = TypeRepasResource::buildAll($typeRepasManager->findAll());
                        foreach ($typesRepas as $type) { ?>
                            <label class="checkbox-item">
                            <input type="checkbox" name="types_repas[]" value=<?= $type["id"]; ?>>
                            <p><?= $type["nom_type"]; ?></p>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div id="champs-activite" class="hidden formInline">
                <div class="gap-vsm flex-col">
                    <label for="duree_activity">Duree *</label>
                    <input type="text" name="duree_activity" id="duree_activity" placeholder="2h30">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="age_requis_activity">Age requis *</label>
                    <input type="number" name="age_requis_activity" id="age_requis_activity" placeholder="15">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="prestations_incluses">Prestations incluses *</label>
                    <input type="text" name="prestations_incluses" id="prestations_incluses" placeholder="palmes, bouteille">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="prestations_non_incluses">Prestations non incluses *</label>
                    <input type="text" name="prestations_non_incluses" id="prestations_non_incluses" placeholder="transport, combinaison">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="prix_minimal_activity">Prix minimal *</label>
                    <input type="number" name="prix_minimal_activity" id="prix_minimal_activity" placeholder="15.5">
                </div>
            </div>

            <div id="champs-parc" class="hidden formInline">
                <div class="flex-col gap-vsm">
                    <label for="nombre_attractions">Nombre d’attractions *</label>
                    <input type="number" name="nombre_attractions" id="nombre_attractions" min="1" placeholder="15">
                </div>
                <div class="flex-col gap-vsm">
                    <label for="prix_minimal_amusement">Prix minimal *</label>
                    <input type="number" name="prix_minimal_amusement" id="prix_minimal_amusement" min="1" placeholder="15.5">
                </div>
                <div class="flex-col gap-vsm">
                    <label for="age_requis_amusement">Âge requis *</label>
                    <input type="number" name="age_requis_amusement" id="age_requis_amusement" min="1" placeholder="15">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="url_carte_parc" >Carte du parc d'attraction *</label>
                    <input type="file" name="url_carte_parc" id="url_carte_parc">
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="conditions_accesibilite">Conditions d'accessibilité *</label>
                    <input name="conditions_accesibilite" id="conditions_accesibilite" type="text" placeholder="Accessible à tous" >
                </div>
                    
                <?php 
                    $tagManager = new TagManager();
                    $manageOption = new ManageOption();
                    $enrichedOffer = TagResource::buildAll($tagManager->findAll());
                    $tags = $manageOption->getTags($enrichedOffer);
                ?>
                <div class="gap-vsm flex-col hidden" id="isNotRestauration">
                    <label>Tags *
                        <span class="tooltip-trigger">
                            <img src="./assets/icons/info_black.svg">
                            <span class="tooltip-text">
                            Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags.
                            </span>
                        </span>
                    </label>
                    <select multiple name="tag[]" id="categoryAll">
                        <div><?= $tags["isNotRestauration"] ?></div>
                    </select>
                </div>
                <div class="gap-vsm flex-col hidden" id="isRestauration">
                    <label>Tags *
                        <span class="tooltip-trigger">
                            <img src="./assets/icons/info_black.svg">
                            <span class="tooltip-text">
                            Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags.
                            </span>
                        </span>
                    </label>
                    <select multiple name="tag[]" id="restaurant">
                        <div><?= $tags["isRestauration"] ?></div>
                    </select>
                <div>
            </div>
        </div>
    </section>
    <section class="formSectionContainer">
        <div class="h3-section">
            <h3>Horaire d'ouverture et fermeture</h3>
            <hr>
        </div>
        <div class="flex-col" id="horaires">
            <div id="horaire-container" class="horaire-container"></div>    
        </div>
    </section>

    <section class="formSectionContainer">

        <div class="h3-section">
            <h3>Adresse de votre offre</h3>
            <hr>
        </div>

        <div class="field">
            <label for="nom_rue">Rue *</label>
            <input name="nom_rue" id="nom_rue" type="text" placeholder="Rue Lepic">
        </div>

        <div class="formInline">
            <div class="field">
                <label for="numero_rue">Numéro *</label>
                <input name="numero_rue" id="numero_rue" type="number" placeholder="15">
            </div>
            <div class="field">
                <label for="complement_adresse">Complément adresse</label>
                <input name="complement_adresse" id="complement_adresse" type="text" placeholder="au 2eme étage">
            </div>
        </div>

        <div class="formInline">
            <div class="field">
                <label for="ville">Ville *</label>
                <input name="ville" id="ville" type="text" placeholder="Paris">
            </div>

            <div class="field">
                <label for="code_postal">Code Postal *</label>
                <input name="code_postal" id="code_postal" type="text" placeholder="75000">
            </div>
        </div>
    </section>

    <section class="formSectionContainer">
        <div class="h3-section">
            <h3>Contact</h3>
            <hr>
        </div>

        <div class="field">
            <label for="telephone">Téléphone *</label>
            <input name="telephone" id="telephone" type="text" placeholder="00 00 00 00 00">
        </div>

        <div class="field">
            <label for="site_web">Site web</label>
            <input name="site_web" id="site_web" type="text" placeholder="www.site.fr">
        </div>

        <div class="field">
            <label for="resume">Résumé *</label>
            <textarea name="resume" id="resume"  type="text" placeholder="Résumé court qui sera affiché dans la version miniature de votre offre" ></textarea>
        </div>

        <div class="field">
            <label for="description_detaillee">Description détaillée *</label>
            <textarea name="description_detaillee" id="description_detaillee" class="bigField" type="text" placeholder="Description détaillée qui sera affichée sur la page de votre offre." ></textarea>
        </div>

        <div class="field">
            <label for="photo"> Photo(s) de l'offre * 
                <span class="tooltip-trigger"><img src="./assets/icons/info_black.svg">
                    <span class="tooltip-text">
                    Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs images.
                    </span>
                </span>
            </label>
            <label class="custum-file-upload" for="file">
                <div class="icon">
                    <img src="./assets/icons/cloud_primary.svg" class="svg">
                </div>
                <div class="text">
                    <span>Click to upload image</span>
                </div>
                <input type="file" class="bigField" id="photo_offre" name="photo[]"  multiple></input>
            </label>
        </div>
    </section>
    <section class="formSectionContainer">
        <div class="h3-section">
            <h3>Mise en avant de votre offre 
                <span class="tooltip-trigger"><img src="./assets/icons/info_black.svg">
                    <span class="tooltip-text">
                        Prix mensuel
                    </span>
                </span>
            </h3>
            <hr>
        </div>
        <div class="toggle-wrapper">
            <label class="toggle-label">
                <div>
                    Offre à la une
                    <span class="tooltip-trigger"><img src="./assets/icons/info_black.svg">
                        <span class="tooltip-text">
                            Votre offre sera visible dans le carrousel principal de la page d’accueil – idéal pour maximiser la visibilité.
                        </span>
                    </span>
                </div>
                <input type="checkbox" id="featured" name="a_la_une">
                <span class="toggle-switch"></span>
            </label>

            <label class="toggle-label">
                <div>
                    Offre en relief
                    <span class="tooltip-trigger"><img src="./assets/icons/info_black.svg">
                        <span class="tooltip-text">
                            Votre offre sera marquée par un tag spécial pour attirer l’œil
                        </span>
                    </span>
                </div>
                <input type="checkbox" id="highlighted" name="en_relief">
                <span class="toggle-switch"></span>
            </label>
            <div class="price-display" id="price">
                Prix total : 0.00 €
            </div>
        </div>

    </section>
    <div class="buttonContainer">
        <?= black_button("Créer l'offre"); ?>
    </div>
</form>
<script src="./js/CreationOffre/displayForm.js"></script>
<script src="./js/CreationOffre/verifFields.js"></script>
<script src="./js/CalculateTarif.js"></script>
<?php } ?>