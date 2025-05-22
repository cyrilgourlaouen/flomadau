<link rel="stylesheet" type="text/css" href="../../public/css/back.css">
<?php
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
                <input name="categorie" type="text" placeholder="Catégorie">
            </div>
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

        <div class="formInline">
            <div>
                <table class="formGrid">
                    <tr>
                        <td>
                            <label>Lundi</label>
                            <label for="lundi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="lundi_debut">
                            <label for="lundi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="lundi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mardi</label>
                            <label for="mardi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="mardi_debut">
                            <label for="mardi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="mardi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Mercredi</label>
                            <label for="mercredi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="mercredi_debut">
                            <label for="mercredi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="mercredi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Jeudi</label>
                            <label for="jeudi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="jeudi_debut">
                            <label for="jeudi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="jeudi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Vendredi</label>
                            <label for="vendredi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="vendredi_debut">
                            <label for="vendredi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="vendredi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Samedi</label>
                            <label for="samedi_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="samedi_debut">
                            <label for="samedi_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="samedi_fin">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Dimanche</label>
                            <label for="dimanche_debut" class="debutHoraire">Début :</label>
                            <input type="text" name="dimanche_debut">
                            <label for="dimanche_fin" class="finHoraire">Fin :</label>
                            <input type="text" name="dimanche_fin">
                        </td>
                    </tr>
                </table>
            </div>
            <!-- Add price grid here -->
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
                <label for="ville">Ville</label>
                <input name="ville" type="text" placeholder="Paris">
            </div>

            <div class="field">
                <label for="code_postal">Code Postal</label>
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
            <label for="tel">Téléphone</label>
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
            <label for="detail">Description détaillée</label>
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