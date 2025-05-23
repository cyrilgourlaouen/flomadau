<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}
$head_title = "Création du compte";
$head_subtitle = "INFORMATIONS ENTREPRISE";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
?>
<form class=".formContainer" action="?path=/offre/creation/new">
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
                    <option value="Visite">Visite</option>
                    <option value="Spectacle">Spectacle</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Activite">Activite</option>
                    <option value="Parc d'attraction">Parc d'attraction</option>
                </select>
            </div>
            <div class="formInline hidden" id="champs-visite">
                <div>
                    <label for="Duree">Duree *</label>
                    <input type="text" name="Duree" id="Duree">
                </div>
                <div>
                    <label for="guide">guide</label>
                    <input type="text" name="guide" id="guide">
                </div>
                <div >
                    <label for="prix_minimal">prix minimal *</label>
                    <input type="text" name="prix_minimal" id="prix_minimal">
                </div>
            </div>
            <div class="formInline hidden" id="champs-spectacle">
                <div>
                    <label for="duree">duree *</label>
                    <input type="text" name="duree" id="duree">
                </div>

                <div>
                    <label for="prix_minimal">prix minimal *</label>
                    <input type="text" name="prix_minimal" id="prix_minimal">
                </div>

                <div>
                    <label for="capacite">capacite *</label>
                    <input type="text" name="capacite" id="capacite">
                </div>
            </div>

            

            <div id="champs-restaurant" class="hidden">
                <label for="type_cuisine">Type de cuisine :</label>
                <input type="text" name="type_cuisine" id="type_cuisine">
            </div>

            <div id="champs-activite" class="hidden">
                <label for="niveau_difficulte">Niveau de difficulté :</label>
                <select name="niveau_difficulte" id="niveau_difficulte" >
                    <option value="Facile">Facile</option>
                    <option value="Moyen">Moyen</option>
                    <option value="Difficile">Difficile</option>
                </select>
            </div>

            <div id="champs-parc" class="hidden">
                <label for="nombre_attractions">Nombre d’attractions :</label>
                <input type="number" name="nombre_attractions" id="nombre_attractions" min="1">
            </div>
        </form>

        <script>
        function afficherChamps() {
            const value = document.getElementById("categorie").value;

            const champs = {
                "Visite": "champs-visite",
                "Spectacle": "champs-spectacle",
                "Restaurant": "champs-restaurant",
                "Activite": "champs-activite",
                "Parc d'attraction": "champs-parc"
            };

            for (const id of Object.values(champs)) {
                document.getElementById(id).classList.add("hidden");
            }

            if (champs[value]) {
                document.getElementById(champs[value]).classList.remove("hidden");
            }
        }
        </script>
        </div>
        
        <div class="formInline">
            <div class="field">
                <label for="type">Type *</label>
                <input name="type" type="text" placeholder="Type d'offre" required>
            </div>

            <div class="field">
                <label for="promotion">Promotion *</label>
                <input name="promotion" type="text" placeholder="Promotion" required>
            </div>
        </div>

        
    </section>

    <section class="formSectionContainer">

        <div class="h3-section">
            <h3>Adresse de votre offre</h3>
            <hr>
        </div>

        <div class="field">
            <label for="rue">Rue</label>
            <input name="rue" type="text" placeholder="Rue Lepic">
        </div>

        <div class="field">
            <label for="numéro_rue">Numéro</label>
            <input name="numéro_rue" type="text" placeholder="15">
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
            <label for="tel">Téléphone *</label>
            <input name="tel" type="text" placeholder="00 00 00 00 00">
        </div>

        <div class="field">
            <label for="web">Site web</label>
            <input name="web" type="text" placeholder="www.site.fr">
        </div>

        <div class="field">
            <label for="resume">Résumé *</label>
            <textarea name="resume" id="resume"  type="text" placeholder="Résumé court qui sera affiché dans la version miniature de votre offre" required></textarea>
        </div>

        <div class="field">
            <label for="detail">Description détaillée *</label>
            <textarea name="detail" class="bigField" type="text" placeholder="Description détaillée qui sera affichée sur la page de votre offre." ></textarea>
        </div>

        <div class="field">
            <label for="photo"> Photo de profil </label>
            <input type="file" class="bigField" name="photo" accept="image/png, image/jpeg" required></input>
        </div>
    </section>
</form>

<div class="buttonContainer">
    <button class="button-black">Prévisualiser</button>
    <button class="button-blue">Publier l'offre<button>
</div>