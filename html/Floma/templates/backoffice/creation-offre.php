<?php

use App\Entity\TypeRepas;
use App\Manager\LangueGuideManager;
use App\Manager\OfferManager;
use App\Manager\TagManager;
use App\Manager\TypeRepasManager;
use App\Resource\LangueGuideResource;
use App\Resource\OfferResource;
use App\Resource\TagResource;
use App\Resource\TypeRepasResource;
use App\Service\ManageOption;
use App\Service\ManageTags;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}
$head_title = "Création du compte";
$head_subtitle = "INFORMATIONS ENTREPRISE";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php'
?>
<form action="?path=/offre/creation/new" method="post" enctype="multipart/form-data">
    <section class="formSectionContainer">

        <div class="h3-section">
            <h3>Information principales</h3>
            <hr>
        </div>

        <div class="formInline">
            <div class="field">
                <label for="offer_name">Nom de l'offre *</label>
                <input name="offer_name" type="text" placeholder="..." required>
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
            <div class="formInline hidden align-center" id="champs-visite">
                <div class="gap-vsm flex-col">
                    <label for="duree_visite">Duree *</label>
                    <input type="text" name="duree_visite" id="duree_visite" placeholder="2h30">
                </div>
                <div>
                    <label class="checkbox-item">
                        <input type="checkbox" id="guideCheckbox" name="guide" id="guide" value="true">
                        <span>Guide</span>
                    </label>
                </div>
                <div class="gap-vsm flex-col hidden" id="selectGuides">
                    <label for="guideOptions">Langue du guide:</label>
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
                <div class="gap-vsm flex-col">
                    <label for="prix_minimal_visite">Prix minimal *</label>
                    <input type="number" name="prix_minimal_visite" id="prix_minimal_visite" placeholder="15.5">
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
                    <select name="gamme_de_prix" id="gamme_de_prix">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="gap-vsm flex-col">
                    <label for="url_carte_restaurant" >Carte du restaurant *</label>
                    <input type="file" name="url_carte_restaurant">
                </div>
                

                <div class="checkbox-group flex-col">
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
                    <input type="text" name="prestations_incluses" id="prestations_incluses" placeholder="palmes incluses">
                </div>
                <div class="gap-vsm flex-col">
                    <label for="prestations_non_incluses">Prestations non incluses *</label>
                    <input type="text" name="prestations_non_incluses" id="prestations_non_incluses" placeholder="prévoir bouteille d'eau">
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
                    <label for="carte_parc" >Carte du parc d'attraction *</label>
                    <input type="file" name="carte_parc">
                </div>
            </div>

        <script>
        
        </script>
        </div>
        
        <div class="formInline">
            <div class="field">
                <label for="type">Type *</label>
                <input name="type" type="text" placeholder="Type d'offre" required>
            </div>

            <div class="field">
                <label for="conditions_accesibilite">Conditions d'accessibilité *</label>
                <input name="conditions_accesibilite" id="conditions_accesibilite" type="text" placeholder="Promotion" required>
            </div>

            <div class="gap-vsm flex-col">
                <label>Tags *</label>
                <?php 
                    $tagManager = new TagManager();
                    $manageOption = new ManageOption();
                    $enrichedOffer = TagResource::buildAll($tagManager->findAll());
                    $tags = $manageOption->getTags($enrichedOffer);
                ?>
                <select id="isNotRestauration" class='hidden' multiple>
                    <div><?= $tags["isNotRestauration"] ?></div>
                </select>
                <select id="isRestauration" class='hidden' multiple>
                    <div><?= $tags["isRestauration"] ?></div>
                </select>
            <div>
            </div>
        

        
    </section>

    <section class="formSectionContainer">

        <div class="h3-section">
            <h3>Adresse de votre offre</h3>
            <hr>
        </div>

        <div class="field">
            <label for="nom_rue">Rue</label>
            <input name="nom_rue" id="nom_rue" type="text" placeholder="Rue Lepic">
        </div>

        <div class="formInline">
            <div class="field">
                <label for="numero_rue">Numéro</label>
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
                <input name="ville" type="text" placeholder="Paris">
            </div>

            <div class="field">
                <label for="code_postal">Code Postal *</label>
                <input name="code_postal" type="text" placeholder="75000">
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
            <textarea name="resume" id="resume"  type="text" placeholder="Résumé court qui sera affiché dans la version miniature de votre offre" required></textarea>
        </div>

        <div class="field">
            <label for="description_detaillee">Description détaillée *</label>
            <textarea name="description_detaillee" id="description_detaillee" class="bigField" type="text" placeholder="Description détaillée qui sera affichée sur la page de votre offre." ></textarea>
        </div>

        <div class="field">
            <label for="photo"> Photo de l'offre * </label>
            <input type="file" class="bigField" name="photo" required></input>
        </div>
    </section>
    <div class="buttonContainer">
        <?= black_button('Se connecter'); ?>
    </div>
</form>
<script src="./js/displayForm.js"></script>