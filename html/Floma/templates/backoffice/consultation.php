<?php

use App\Manager\LangueGuideManager;
use App\Manager\TagManager;
use App\Manager\TypeRepasManager;
use App\Resource\LangueGuideResource;
use App\Resource\TagResource;
use App\Resource\TypeRepasResource;
use App\Service\ManageOption;
use App\Manager\JourOuvertureOffreManager;
use App\Resource\LangueGuideVisiteResource;

$head_title = "Consultation de mon offre";
$head_subtitle = "INFORMATIONS ENTREPRISE";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
$offer = $data['offer'];
print_r($offer);
//print_r($offer['langueGuideData']);

if (!isset($_SESSION['code_pro'])) {
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
                        <input name="offer_name" id="offer_name" type="text"
                            value="<?= htmlspecialchars($offer['titre']) ?>" disabled>

                    </div>

                    <div class="field">
                        <label for="categorie">Catégorie</label>
                        <p><?= htmlentities($offer['categorie']) ?></p>
                        <select name="categorie" id="categorie" onchange="afficherChamps()" style="display: none;">
                            <?php
                            $categorie = $offer['categorie'] ?? '';
                            ?>
                            <option <?= $categorie === 'Visite' ? 'selected' : '' ?>>Visite</option>
                            <option <?= $categorie === 'Spectacle' ? 'selected' : '' ?>>Spectacle</option>
                            <option <?= $categorie === 'Restaurant' ? 'selected' : '' ?>>Restaurant</option>
                            <option <?= $categorie === 'Activite' ? 'selected' : '' ?>>Activite</option>
                            <option <?= $categorie === "Parc d'attraction" ? 'selected' : '' ?>>Parc d'attraction</option>
                        </select>
                    </div>

                    <div class="formInline hidden align-end" id="champs-visite">
                        <div class="gap-vsm flex-col">
                            <label for="duree_visite">Duree *</label>
                            <input type="text" name="duree_visite" id="duree_visite"
                                value="<?= htmlspecialchars($offer['categoryData']['duree']) ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prix_minimal_visite">Prix minimal *</label>
                            <input type="number" name="prix_minimal_visite" id="prix_minimal_visite" placeholder="15.5"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal']) ?>" disabled>
                        </div>
                        <div>
                            <label class="checkbox-item">
                                <input type="checkbox" id="guideCheckbox" name="guide" id="guide" value="true" checked>
                                <span>Guide</span>
                            </label>
                        </div>
                        <div class="gap-vsm flex-col" id="selectGuides">
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
                            $guide = $offer['langueGuideData'];

                            $usedLangues = is_array($guide) ? array_map(fn($item) => $item['nom_langue'], $guide) : [];
                            $filteredEnrichedOffer = array_filter($enrichedOffer, function ($langue) use ($usedLangues) {
                                return !in_array($langue['nom_langue'], $usedLangues);
                            });

                            $guides = $manageOption->getGuides($filteredEnrichedOffer);
                            ?>

                            <!-- Sélecteur de langues disponibles -->
                            <select id="guideOptions" style="display:block; margin-top:10px;">
                                <?= $guides ?>
                            </select>

                            <!-- Liste des langues ajoutées -->
                            <select name="guides[]" id="selectedGuides" multiple style="margin-top:10px; min-height:100px;">
                                <?php foreach ($guide as $value) { ?>
                                    <option value="<?= $value['nom_langue'] ?>" selected>
                                        <?= htmlentities($value['nom_langue']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <!-- Boutons -->
                            <div class="containerBtnTagGuide">
                                <button type="button" onclick="addGuide()" class="BtnTagGuide">Ajouter une langue</button>
                                <button type="button" onclick="removeGuide()" class="BtnTagGuide">Retirer la langue</button>
                            </div>
                        </div>
                    </div>
                    <div class="formInline hidden" id="champs-spectacle">
                        <div class="gap-vsm flex-col">
                            <label for="duree_show">Duree *</label>
                            <input type="text" name="duree_show" id="duree_show"
                                value="<?= htmlspecialchars($offer['categoryData']['duree']) ?>" disabled>
                        </div>

                        <div class="gap-vsm flex-col">
                            <label for="prix_minimal_show">Prix minimal *</label>
                            <input type="number" name="prix_minimal_show" id="prix_minimal_show"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal']) ?>" disabled>
                        </div>
                        <div class=" gap-vsm flex-col">
                            <label for="capacite">Capacite *</label>
                            <input type="number" name="capacite" id="capacite" placeholder="500">
                        </div>
                    </div>
                    <div id="champs-restaurant" class="hidden formInline">
                        <div class="gap-vsm flex-col">
                            <label for="type_cuisine">Gamme de prix *</label>
                            <?php $dataRestaurant = $offer['categoryData'];
                            $gammes = [
                                1 => "Moins de 25 euros",
                                2 => "Entre 25 et 40 euros",
                                3 => "Plus de 40 euros"
                            ];
                            ?>
                            <select name="gamme_de_prix" id="gamme_de_prix" disabled>
                                <?php foreach ($gammes as $key => $label) { ?>
                                    <option value="<?= $key ?>" <?= ($dataRestaurant == $key) ? 'selected' : '' ?>>
                                        <?= htmlentities($label) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="gap-vsm flex-col" id="carte-restaurant-container">
                            <label for="url_carte_restaurant">Carte du restaurant *</label>

                            <?php if (!empty($dataRestaurant['url_carte_restaurant'])): ?>
                                <div id="carte-restaurant-preview" style="margin-bottom: 8px;">
                                    <p>Image actuelle :</p>
                                    <img src="<?= htmlentities($dataRestaurant['url_carte_restaurant']) ?>"
                                        alt="Carte du restaurant"
                                        style="max-width: 300px; height: auto; display: block; margin-bottom: 5px;">
                                    <button type="button" id="btn-supprimer-carte">Supprimer cette image</button>
                                </div>
                            <?php endif; ?>

                            <input type="file" name="url_carte_restaurant" id="url_carte_restaurant" accept="image/*">
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
                            <input type="text" name="duree_activity" id="duree_activity"
                                value="<?= htmlspecialchars($offer['categoryData']['duree']) ?>">
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="age_requis_activity">Age requis *</label>
                            <input type="number" name="age_requis_activity" id="age_requis_activity" placeholder="15">
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prestations_incluses">Prestations incluses *</label>
                            <input type="text" name="prestations_incluses" id="prestations_incluses"
                                placeholder="palmes, bouteille">
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prestations_non_incluses">Prestations non incluses *</label>
                            <input type="text" name="prestations_non_incluses" id="prestations_non_incluses"
                                placeholder="transport, combinaison">
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
                            <input type="number" name="prix_minimal_amusement" id="prix_minimal_amusement" min="1"
                                placeholder="15.5">
                        </div>
                        <div class="flex-col gap-vsm">
                            <label for="age_requis_amusement">Âge requis *</label>
                            <input type="number" name="age_requis_amusement" id="age_requis_amusement" min="1"
                                placeholder="15">
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="url_carte_parc">Carte du parc d'attraction *</label>
                            <input type="file" name="url_carte_parc" id="url_carte_parc">
                        </div>
                    </div>
                    <div class="formInline">
                        <div class="field">
                            <label for="conditions_accesibilite">Conditions d'accessibilité *</label>
                            <input name="conditions_accesibilite" id="conditions_accesibilite" type="text"
                                value="<?= htmlentities($offer['conditions_accessibilite']) ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col" id="selectGuides">
                            <label>Tags *
                                <span class="tooltip-trigger">
                                    <img src="./assets/icons/info_black.svg">
                                    <span class="tooltip-text">
                                        Maintenez Ctrl (ou Cmd) pour sélectionner plusieurs tags.
                                    </span>
                                </span>
                            </label>
                            <?php
                            $tagManager = new TagManager();
                            $manageOptionTag = new ManageOption();
                            $enrichedTag = TagResource::buildAll($tagManager->findAll());
                            $tag = $offer['tagData'];

                            $usedTag = is_array($tag) ? array_map(fn($item) => $item['nom_tag'], $tag) : [];
                            $filteredEnrichedTags = array_filter($enrichedTag, function ($tag) use ($usedTag) {
                                return !in_array($tag['nom_tag'], $usedTag);
                            });

                            $tags = $manageOptionTag->getTags($filteredEnrichedTags);
                            ?>

                            <select id="isNotRestauration" style="display:block;">
                                <?= $tags['isNotRestauration'] ?>
                            </select>
                            <select style="display:block;" id="isRestauration">
                                <?= $tags['isRestauration'] ?>
                            </select>
                            <select name="tag[]" id="selectedTag" multiple style=" min-height:100px;">
                                <?php foreach ($tag as $value) { ?>
                                    <option value="<?= $value['nom_tag'] ?>" selected>
                                        <?= htmlentities($value['nom_tag']) ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <!-- Boutons -->
                            <div class="containerBtnTagGuide">
                                <button type="button" onclick="addTag()" class="BtnTagGuide">
                                    Ajouter un tag
                                </button>
                                <button type="button" onclick="removeTag()" class="BtnTagGuide">
                                    Retirer un tag
                                </button>
                            </div>
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
                    <input name="nom_rue" id="nom_rue" type="text" value="<?= htmlspecialchars($offer['nom_rue']) ?>"
                        disabled>
                </div>

                <div class="formInline">
                    <div class="field">
                        <label for="numero_rue">Numéro *</label>
                        <input name="numero_rue" id="numero_rue" type="number"
                            value="<?= htmlspecialchars($offer['numero_rue']) ?>" disabled>
                    </div>
                    <div class="field">
                        <label for="complement_adresse">Complément adresse</label>
                        <input name="complement_adresse" id="complement_adresse" type="text"
                            value="<?= htmlspecialchars($offer['complement_adresse'] ?? "") ?>" disabled>

                    </div>
                </div>

                <div class="formInline">
                    <div class="field">
                        <label for="ville">Ville *</label>
                        <input name="ville" id="ville" type="text" value="<?= htmlspecialchars($offer['ville']) ?>"
                            disabled>
                    </div>

                    <div class="field">
                        <label for="code_postal">Code Postal *</label>
                        <input name="code_postal" id="code_postal" type="text"
                            value="<?= htmlspecialchars($offer['code_postal'] ?? "") ?>" disabled>
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
                    <input name="telephone" id="telephone" type="text" value="<?= htmlspecialchars($offer['telephone']) ?>"
                        disabled>
                </div>

                <div class="field">
                    <label for="site_web">Site web</label>
                    <input name="site_web" id="site_web" type="text"
                        value="<?= htmlspecialchars($offer['site_web'] ?? "") ?>" disabled>
                </div>

                <div class="field">
                    <label for="resume">Résumé *</label>
                    <textarea name="resume" id="resume" disabled><?= htmlspecialchars($offer['resume']) ?></textarea>

                </div>

                <div class="field">
                    <label for="description_detaillee">Description détaillée *</label>
                    <textarea name="description_detaillee" id="description_detaillee" class="bigField" type="text"
                        disabled><?= htmlspecialchars($offer['description_detaillee']) ?></textarea>
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
                        <input type="file" class="bigField" id="photo_offre" name="photo[]" multiple></input>
                    </label>
                </div>
            </section>
            <div class="buttonContainer">
                <?= black_button("Créer l'offre"); ?>
            </div>
    </form>
    <script src="./js/CreationOffre/displayForm.js"></script>
    <script src="./js/CreationOffre/verifFields.js"></script>
    <script src="./js/UpdateOffre/_js-UpdateOffer.js"></script>
<?php } ?>