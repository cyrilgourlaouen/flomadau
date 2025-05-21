<main id="inscription_main"> 
    <div id="form_main">
        <a href=""><img src="../../../public/assets/icons/logo_complet_bleu.svg" alt="Logo de PACT en bleu" id="logo"></a>
        <h1> Créer un compte </h1>
        <hr id="transition_bar">
        <form method="post" enctype="multipart/form-data" action="inscription_membre.php" id="inscription_membre">
            <div class="groupe">
                <div>
                    <label for="prenom"> Prénom* </label>
                    <input name="prenom" id="prenom" type="text" placeholder="Pierre" required></input>
                </div>
                
                <div>
                    <label for="nom"> Nom* </label>
                    <input name="nom" id="nom" type="text" placeholder="Durant" required></input>
                </div>
            </div>

            <div class="groupe">
                <div>
                    <label for="pseudo"> Pseudonyme* </label>
                    <input name="pseudo" id="pseudo" type="text" placeholder="Le voyageur" required></input>
                    <span class="error-msg" id="error-pseudo"></span>
                </div>
                
                <div>
                    <label for="tel"> Numéro de téléphone* </label>
                    <input name="tel" id="tel" type="text" placeholder="00 00 00 00 00" required></input>
                    <span class="error-msg" id="error-tel"></span>
                </div>
            </div>
            
            <div class="solo">
                <label for="email"> Adresse e-mail* </label>
                <input name="email" id="email" type="text" placeholder="pierre.durant@gmail.com" required></input>
                <span class="error-msg" id="error-email"></span>
            </div>
            </html>   
            <div class="solo">
                <label for="photo"> Photo de profil* </label>
                <input type="file" id="photo" name="photo" accept="image/png, image/jpeg"></input>
                <!-- Drag and drop window of the picture -->
            </div>

            <div class="groupe">
                <div>
                    <label for="city"> Ville* </label>
                    <input name="city" id="city" type="text" placeholder="Trifouillis-les-bigorneaux" required></input>
                    <span class="error-msg" id="error-city"></span>
                </div>
                
                <div>
                    <label for="zip_code"> Code postal* </label>
                    <input name="zip_code" id="zip_code" type="text" placeholder="04200" required></input>
                    <span class="error-msg" id="error-zip"></span>
                </div>
            </div>

            <div class="solo">
                <label for="name_street"> Nom de rue* </label>
                <input name="name_street" id="name_street" type="text" placeholder="rue Charles de Gaulle" required></input>
                <span class="error-msg" id="error-name-street"></span>
            </div>

            <div class="groupe">
                <div>
                    <label for="num_street"> Numéro de rue* </label>
                    <input name="num_street" id="num_street" type="text" placeholder="3" required></input>
                    <span class="error-msg" id="error-num-steet"></span>
                </div>
                
                <div>
                    <label for="adress_comp"> Complément d'adresse </label>
                    <input name="adress_comp" id="adress_comp" type="text" placeholder="Appart 2" required></input>
                    <span class="error-msg" id="error-adress-comp"></span>
                </div>
            </div>
            
            <div class="groupe">
                <div>
                    <label for="password"> Mot de passe* </label>
                    <ul id="liste_mobile">
                        <li> 12 caractère minimum </li> 
                        <li> Majuscules </li> 
                        <li> Minuscules </li> 
                        <li> Chiffres </li> 
                        <li> Caractères spéciaux </li> 
                    </ul>
                    <input name="password" type="password" id="password"> </input>
                    <span class="error-msg" id="error-password-mobile"></span>
                </div>

                <div>
                    <label for="conf_password"> Confirmation du mot de passe* </label>
                    <input name="conf_password" type="password" id="conf_password"> </input>
                    <span class="error-msg" id="error-password-conf"></span>
                </div>
            </div>
            <ul id="liste_tablette">
                <li> 12 caractère minimum </li> 
                <li> Majuscules </li> 
                <li> Minuscules </li> 
                <li> Chiffres </li> 
                <li> Caractères spéciaux </li> 
            </ul>
            <span class="error-msg" id="error-password-tablette"></span>
        </form>

        <h4>Si vous avez déjà un compte <a href="index.php">connectez-vous</a></h3>
        <button type="submit" form="inscription_membre" value="Submit" id="signup_button"> <h3>S'inscrire</h3> </button>
    </div>
    <figure id="background_image_block">
        <img src="../../../public/assets/images/bg_inscription.png" alt="Vue de haut sur une plage de la côte d'azur" id="background_image">
    </figure>
</main>
<script src="error-message.js"></script>