<?php

use App\Manager\LangueGuideManager;
use App\Manager\TagManager;
use App\Manager\TypeRepasManager;
use App\Resource\JourOuvertureResource;
use App\Resource\LangueGuideResource;
use App\Resource\TagResource;
use App\Resource\TypeRepasResource;
use App\Service\HoraireManage;
use App\Service\ManageOption;
use App\Manager\JourOuvertureOffreManager;
use App\Resource\LangueGuideVisiteResource;

$head_title = "Consultation de mon offre";
$head_subtitle = "INFORMATIONS ENTREPRISE";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
$offer = $data['offer'];
if (!isset($_SESSION['code_pro'])) { ?>
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
    <form action="?path=/offre/updateOffer" method="post" enctype="multipart/form-data" class="formContainer">
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
                            value="<?= htmlspecialchars($offer['titre'] ?? "") ?>" disabled>

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
                                value="<?= htmlspecialchars($offer['categoryData']['duree'] ?? "") ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prix_minimal_visite">Prix minimal *</label>
                            <input type="number" name="prix_minimal_visite" id="prix_minimal_visite"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal'] ?? "") ?>" disabled>
                        </div>
                        <div>
                            <label class="checkbox-item">
                                <input type="checkbox" id="guideCheckbox" name="guide" id="guide" value="true" checked
                                    disabled>
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
                            $guide = $offer['langueGuideData'] ?? "";

                            $usedLangues = is_array($guide) ? array_map(fn($item) => $item['nom_langue'], $guide) : [];
                            $filteredEnrichedOffer = array_filter($enrichedOffer, function ($langue) use ($usedLangues) {
                                return !in_array($langue['nom_langue'], $usedLangues);
                            });

                            $guides = $manageOption->getGuides($filteredEnrichedOffer);
                            ?>

                            <!-- Sélecteur de langues disponibles -->
                            <select id="guideOptions" disabled>
                                <?= $guides ?>
                            </select>

                            <!-- Liste des langues ajoutées -->
                            <select name="guides[]" id="selectedGuides" multiple disabled>
                                <?php if (is_array($guide)) {
                                    foreach ($guide as $value) { ?>
                                        <option value="<?= $value['nom_langue'] ?>" selected>
                                            <?= htmlentities($value['nom_langue'] ?? "") ?>
                                        </option>
                                    <?php }
                                } ?>
                            </select>


                            <!-- Boutons -->
                            <div class="containerBtnTagGuide">
                                <button type="button" onclick="addGuide()" class="BtnConsultation" disabled>Ajouter une
                                    langue</button>
                                <button type="button" onclick="removeGuide()" class="BtnConsultation" disabled>Retirer la
                                    langue</button>
                            </div>
                        </div>
                    </div>
                    <div class="formInline hidden" id="champs-spectacle">
                        <div class="gap-vsm flex-col">
                            <label for="duree_show">Duree *</label>
                            <input type="text" name="duree_show" id="duree_show"
                                value="<?= htmlspecialchars($offer['categoryData']['duree'] ?? "") ?>" disabled>
                        </div>

                        <div class="gap-vsm flex-col">
                            <label for="prix_minimal_show">Prix minimal *</label>
                            <input type="number" name="prix_minimal_show" id="prix_minimal_show"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal'] ?? "") ?>" disabled>
                        </div>
                        <div class=" gap-vsm flex-col">
                            <label for="capacite">Capacite *</label>
                            <input type="number" name="capacite" id="capacite"
                                value="<?= htmlentities($offer['categoryData']['capacite'] ?? "") ?>" disabled>
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
                                    <img src="/assets/images/<?= $dataRestaurant['url_carte_restaurant'] ?>"
                                        alt="Carte du restaurant" class="imagePreview">
                                    <button class="BtnConsultationSupprimer" type="button" id="btn-supprimer-carte"
                                        disabled>Supprimer</button>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="url_carte_restaurant" id="url_carte_restaurant" accept="image/*"
                                disabled>
                        </div>
                        <div class="checkbox-group flex-col" id="types_repas">
                            <label for="checkbox-group" class="text-center">Type de repas *</label>
                            <div class="flex-row gap-vsm">
                                <?php
                                $typeRepasManager = new TypeRepasManager();
                                $typesRepas = TypeRepasResource::buildAll($typeRepasManager->findAll());

                                $typesRepasSelectedIds = !empty($offer['typeRepasData']) && is_array($offer['typeRepasData'])
                                    ? array_map(function ($item) {
                                        return (int) $item['id'];
                                    }, $offer['typeRepasData'])
                                    : [];


                                foreach ($typesRepas as $type) {
                                    $id = (int) $type['id'];
                                    $isChecked = in_array($id, $typesRepasSelectedIds);
                                    ?>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="types_repas[]" value="<?= $id ?>" <?= $isChecked ? 'checked' : '' ?> disabled>
                                        <p><?= htmlspecialchars($type["nom_type"] ?? "") ?></p>
                                    </label>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div id="champs-activite" class="hidden formInline">
                        <div class="gap-vsm flex-col">
                            <label for="duree_activity">Duree *</label>
                            <input type="text" name="duree_activity" id="duree_activity"
                                value="<?= htmlspecialchars($offer['categoryData']['duree'] ?? "") ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="age_requis_activity">Age requis *</label>
                            <input type="number" name="age_requis_activity" id="age_requis_activity"
                                value="<?= htmlspecialchars($offer['categoryData']['age_requis'] ?? "") ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prestations_incluses">Prestations incluses *</label>
                            <input type="text" name="prestations_incluses" id="prestations_incluses"
                                value="<?= htmlspecialchars($offer['categoryData']['prestations_incluses'] ?? "") ?>"
                                disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prestations_non_incluses">Prestations non incluses *</label>
                            <input type="text" name="prestations_non_incluses" id="prestations_non_incluses"
                                value="<?= htmlspecialchars($offer['categoryData']['prestations_non_incluses'] ?? "") ?>"
                                disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="prix_minimal_activity">Prix minimal *</label>
                            <input type="number" name="prix_minimal_activity" id="prix_minimal_activity"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal'] ?? "") ?>" disabled>
                        </div>
                    </div>

                    <div id="champs-parc" class="hidden formInline">
                        <div class="flex-col gap-vsm">
                            <label for="nombre_attractions">Nombre d’attractions *</label>
                            <input type="number" name="nombre_attractions" id="nombre_attractions" min="1"
                                value="<?= htmlspecialchars($offer['categoryData']['nombre_attraction'] ?? "") ?>" disabled>
                        </div>
                        <div class="flex-col gap-vsm">
                            <label for="prix_minimal_amusement">Prix minimal *</label>
                            <input type="number" name="prix_minimal_amusement" id="prix_minimal_amusement" min="1"
                                value="<?= htmlspecialchars($offer['categoryData']['prix_minimal'] ?? "") ?>" disabled>
                        </div>
                        <div class="flex-col gap-vsm">
                            <label for="age_requis_amusement">Âge requis *</label>
                            <input type="number" name="age_requis_amusement" id="age_requis" min="1"
                                value="<?= htmlspecialchars($offer['categoryData']['age_requis'] ?? "") ?>" disabled>
                        </div>
                        <div class="gap-vsm flex-col">
                            <label for="url_carte_parc">Carte du parc d'attraction *</label>

                            <div class="image-preview-item" data-image-id="<?= htmlspecialchars($img['id'] ?? "") ?>">
                                <img src="/assets/images/<?= htmlspecialchars($img['url_plan'] ?? "") ?>" alt="Image Parc"
                                    class="imagePreview">
                                <button type="button" class="BtnConsultationSupprimer"
                                    data-image-id="<?= htmlspecialchars($img['id'] ?? "") ?>" disabled>Supprimer</button>
                            </div>

                            <p>Ajouter de nouvelles images :</p>
                            <input type="file" name="url_img[]" id="url_img_offre" accept="image/*" multiple disabled>
                        </div>
                    </div>
                </div>
                <div class="formInline">
                    <div class="field">
                        <label for="conditions_accesibilite">Conditions d'accessibilité *</label>
                        <input name="conditions_accesibilite" id="conditions_accesibilite" type="text"
                            value="<?= htmlentities($offer['conditions_accessibilite'] ?? "") ?>" disabled>
                    </div>
                    <div class="gap-vsm flex-col" id="selectTags">
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
                        $manageOption = new ManageOption(); // On peut garder le même objet si même logique
                        $enrichedTags = TagResource::buildAll($tagManager->findAll());
                        $tag = $offer['tagData'];

                        $usedTags = is_array($tag) ? array_map(fn($item) => $item['nom_tag'], $tag) : [];
                        $filteredEnrichedTags = array_filter($enrichedTags, function ($tag) use ($usedTags) {
                            return !in_array($tag['nom_tag'], $usedTags);
                        });

                        $tags = $manageOption->getTags($filteredEnrichedTags);
                        ?>

                        <!-- Sélecteur de tags disponibles -->
                        <select id="isNotRestauration" disabled>
                            <?= $tags['isNotRestauration'] ?>
                        </select>
                        <select id="isRestauration" disabled>
                            <?= $tags['isRestauration'] ?>
                        </select>

                        <!-- Liste des tags ajoutés -->
                        <select name="tags[]" id="selectedTags" multiple disabled>
                            <?php foreach ($tag as $value) { ?>
                                <option value="<?= $value['nom_tag'] ?>" selected>
                                    <?= htmlentities($value['nom_tag'] ?? "") ?>
                                </option>
                            <?php } ?>
                        </select>

                        <!-- Boutons -->
                        <div class="containerBtnTagGuide">
                            <button type="button" onclick="addTag()" class="BtnConsultation" disabled>Ajouter un
                                tag</button>
                            <button type="button" onclick="removeTag()" class="BtnConsultation" disabled>Retirer un
                                tag</button>
                        </div>
                    </div>
            </section>
            <section class="formSectionContainer">
                <div id="horaire-container" class="horaire-container"></div>
                <?php
                $horaireManager = new JourOuvertureOffreManager();
                $horaires = $horaireManager->findBy(['id_offre' => $offer['id']]);

                $joursParId = [
                    1 => 'Lundi',
                    2 => 'Mardi',
                    3 => 'Mercredi',
                    4 => 'Jeudi',
                    5 => 'Vendredi',
                    6 => 'Samedi',
                    7 => 'Dimanche',
                ];

                $horaireData = [];
                foreach ($joursParId as $jour) {
                    $horaireData[$jour] = [];
                }

                foreach ($horaires as $h) {
                    $idJour = $h->getIdJour(); // ID numérique
                    if (isset($joursParId[$idJour])) {
                        $jour = $joursParId[$idJour]; // Nom du jour
                        $horaireData[$jour][] = [
                            'ouverture' => substr($h->getHoraireDebut(), 0, 5), // "HH:MM"
                            'fermeture' => substr($h->getHoraireFin(), 0, 5),
                        ];
                    }
                }
                ?>

                <script>
                    const horaireData = <?= json_encode($horaireData, JSON_UNESCAPED_UNICODE) ?>;
                </script>

                </div>
            </section>

            <section class="formSectionContainer">

                <div class="h3-section">
                    <h3>Adresse de votre offre</h3>
                    <hr>
                </div>

                <div class="field">
                    <label for="nom_rue">Rue *</label>
                    <input name="nom_rue" id="nom_rue" type="text" value="<?= htmlspecialchars($offer['nom_rue'] ?? "") ?>"
                        disabled>
                </div>

                <div class="formInline">
                    <div class="field">
                        <label for="numero_rue">Numéro *</label>
                        <input name="numero_rue" id="numero_rue" type="number"
                            value="<?= htmlspecialchars($offer['numero_rue'] ?? "") ?>" disabled>
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
                        <input name="ville" id="ville" type="text" value="<?= htmlspecialchars($offer['ville'] ?? "") ?>"
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
                    <input name="telephone" id="telephone" type="text"
                        value="<?= htmlspecialchars($offer['telephone'] ?? "") ?>" disabled>
                </div>

                <div class="field">
                    <label for="site_web">Site web</label>
                    <input name="site_web" id="site_web" type="text"
                        value="<?= htmlspecialchars($offer['site_web'] ?? "") ?>" disabled>
                </div>

                <div class="field">
                    <label for="resume">Résumé *</label>
                    <textarea name="resume" id="resume" disabled><?= htmlspecialchars($offer['resume'] ?? "") ?></textarea>

                </div>

                <div class="field">
                    <label for="description_detaillee">Description détaillée *</label>
                    <textarea name="description_detaillee" id="description_detaillee" class="bigField" type="text"
                        disabled><?= htmlspecialchars($offer['description_detaillee'] ?? "") ?></textarea>
                </div>
                <div class="gap-vsm flex-col" id="carte-restaurant-container">
                    <div class="image-upload-section">
                        <?php $imgOfferArray = $offer['imageData'] ?? []; ?>
                        <?php if (!empty($imgOfferArray)): ?>
                            <p>Images actuelles :</p>
                            <div id="images-offre-preview-container"
                                style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 8px;">
                                <?php foreach ($imgOfferArray as $img): ?>
                                    <div class="image-preview-item" data-image-id="<?= htmlspecialchars($img['id']) ?>">
                                        <img src="/assets/images/<?= htmlspecialchars($img['url_img']) ?>" alt="Image Offre"
                                            class="imagePreview">
                                        <button type="button" class="BtnConsultationSupprimer"
                                            data-image-id="<?= htmlspecialchars($img['id']) ?>" disabled>Supprimer</button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <label for="url_img_offre" class="btn-file">Choisir des images</label>
                        <input type="file" name="url_img[]" id="url_img_offre" accept="image/*" multiple disabled>

                    </div>
                </div>
            </section>
            <div class="updateContainer">
                <button class="BtnConsultation updateBtn" id="updateOfferBtn" type="button" disabled>Modifier l'offre</button>
            </div>
            <div class="hidden submitContainer">
                <button type="button" class="BtnConsultation" id="undoOfferBtn">
                    Annuler
                </button>
                <button class="BtnConsultation" id="SubmitOfferBtn">
                    <p>Accepter</p>
                </button>
            </div>
    </form>
    <script src="./js/UpdateOffre/displayForm.js"></script>
    <script src="./js/UpdateOffre/verifFields.js"></script>
    <script src="./js/UpdateOffre/_js-UpdateOffer.js"></script>
<?php } ?>