<div id="inscription_main">
    <div id="form_main">
        <a href="?path=/"><img src="/assets/icons/logo_complet_bleu.svg" alt="Logo de PACT en bleu" id="logo"></a>
        <h1> Créer un compte </h1>
        <hr id="transition_bar">
        <form method="post" enctype="multipart/form-data" action="?path=/inscription/membre/sign-up" id="inscription_membre">
            <div class="groupe">
                <div>
                    <label for="prenom"> Prénom </label>
                    <input name="prenom" id="prenom" type="text" placeholder="Pierre" required></input>
                </div>
                
                <div>
                    <label for="nom"> Nom </label>
                    <input name="nom" id="nom" type="text" placeholder="Durant" required></input>
                </div>
            </div>

            <div class="groupe">
                <div>
                    <label for="pseudo"> Pseudonyme </label>
                    <input name="pseudo" id="pseudo" type="text" placeholder="Le voyageur" required></input>
                    <span class="error-msg" id="error-pseudo"></span>
                </div>
                
                <div>
                    <label for="tel"> Numéro de téléphone </label>
                    <input name="tel" id="tel" type="text" placeholder="00 00 00 00 00" required></input>
                    <span class="error-msg" id="error-tel"></span>
                </div>
            </div>
            
            <div class="solo">
                <label for="email"> Adresse e-mail </label>
                <input name="email" id="email" type="text" placeholder="pierre.durant@gmail.com" required></input>
                <span class="error-msg" id="error-email"></span>
            </div>
            </html>   
            <div class="solo">
                <label for="photo"> Photo de profil </label>
                <input type="file" id="photo" name="photo" accept="image/png, image/jpeg image/webp" size="2097152"></input>
            </div>

            <div class="groupe">
                <div>
                    <label for="city"> Ville </label>
                    <input name="city" id="city" type="text" placeholder="Trifouillis-les-bigorneaux" required></input>
                    <span class="error-msg" id="error-city"></span>
                </div>
                
                <div>
                    <label for="zip_code"> Code postal </label>
                    <input name="zip_code" id="zip_code" type="number" placeholder="04200" required></input>
                    <span class="error-msg" id="error-zip"></span>
                </div>
            </div>

            <div class="solo">
                <label for="name_street"> Nom de rue </label>
                <input name="name_street" id="name_street" type="text" placeholder="rue Charles de Gaulle" required></input>
                <span class="error-msg" id="error-name-street"></span>
            </div>

            <div class="groupe">
                <div>
                    <label for="num_street"> Numéro de rue </label>
                    <input name="num_street" id="num_street" type="number" placeholder="3" required></input>
                    <span class="error-msg" id="error-num-street"></span>
                </div>
                
                <div>
                    <label for="adress_comp"> Complément d'adresse </label>
                    <input name="adress_comp" id="adress_comp" type="text" placeholder="Appart 2"></input>
                    <span class="error-msg" id="error-adress-comp"></span>
                </div>
            </div>
            <div class="align-row">
                <div class="groupe">
                    <div>
                        <label for="password"> Mot de passe </label>
                        <ul id="liste_mobile">
                            <li> 12 caractère minimum </li> 
                            <li> Majuscules </li> 
                            <li> Minuscules </li> 
                            <li> Chiffres </li> 
                            <li> Caractères spéciaux </li> 
                        </ul>
                        <input name="password" type="password" id="password" required> </input>
                        <span class="error-msg" id="error-password"></span>
                    </div>

                    <div>
                        <label for="conf_password"> Confirmation du mot de passe </label>
                        <input name="conf_password" type="password" id="conf_password" required> </input>
                        <span class="error-msg" id="error-password-conf"></span>
                    </div>
                </div>
            </div>
            <ul id="liste_tablette">
                <li> 12 caractère minimum </li> 
                <li> Majuscules </li> 
                <li> Minuscules </li> 
                <li> Chiffres </li>
                <li> Caractères spéciaux </li> 
            </ul>
        </form>

        <h4>Si vous avez déjà un compte <a href="?path=/">connectez-vous</a></h3>
        <button type="submit" form="inscription_membre" value="Submit" id="signup_button"> <h3>S'inscrire</h3> </button>
    </div>
    <figure id="background_image_block">
        <img src="/assets/images/bg_inscription.png" alt="Vue de haut sur une plage de la côte d'azur" id="background_image">
    </figure>
    <script src="/js/error-message-inscription-membre.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('#inscription_membre');
            const btn = document.querySelector('#signup_button');
            
            // Validation rules
            const rules = [
                { field: 'prenom', valid: val => val !== '', message: 'Veuillez entrer un prénom.' },
                { field: 'nom', valid: val => val !== '', message: 'Veuillez entrer un nom.' },
                { field: 'tel', valid: val => /^(?:(?:\+33|0033)\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/.test(val), message: 'Veuillez entrer un numéro valide.' },
                { field: 'email', valid: val => /^\S+@\S+\.\S+$/.test(val), message: 'Veuillez entrer une adresse email valide.' },
                { field: 'pseudo', valid: val => val !== '', message: 'Veuillez entrer le pseudo.' },
                { field: 'password', valid: val => val.length >= 6, message: 'Le mot de passe est trop court.' },
                { field: 'conf_password', valid: val => val === document.getElementById('password').value, message: 'Les mots de passe ne correspondent pas.' },
                { field: 'name_street', valid: val => val !== '', message: 'Veuillez entrer la rue.' },
                { field: 'num_street', valid: val => val !== '', message: 'Veuillez entrer le numéro.' },
                { field: 'city', valid: val => val !== '', message: 'Veuillez entrer la ville.' },
                { field: 'zip_code', valid: val => /^\d{5}$/.test(val), message: 'Veuillez entrer un code postal valide.' },
            ];
            
            // Function to validate a single field
            function validateField(fieldId) {
                const field = document.getElementById(fieldId);
                console.log(field);
                const value = field.value.trim();
                const rule = rules.find(r => r.field === fieldId);
                
                // Remove existing error message
                const existingError = field.parentNode.querySelector('.error-msg');
                if (existingError && existingError.id !== null) {
                    existingError.innerText = "";
                }
                if (existingError !== null) {
                    existingError.remove();
                }

                // Check if valid
                if (!rule.valid(value)) {
                    if (field.parentNode.childElementCount > 0){
                        const errorEl = document.getElementsByClassName('error-msg');
                        errorEl.innerText = rule.message;
                    }
                    else{
                        const errorEl = document.createElement('div');
                        errorEl.className = 'error-msg';
                        errorEl.innerText = rule.message;
                        field.parentNode.appendChild(errorEl);
                    }
                    return false;
                }
                return true;
            }
            
            // Add blur event listeners to all fields
            rules.forEach(rule => {
                const field = document.getElementById(rule.field);
                field.addEventListener('blur', () => {
                    validateField(rule.field);
                });
                
                // For confirmation password, also validate when password changes
                if (rule.field === 'conf_password') {
                    document.getElementById('password').addEventListener('input', () => {
                        if (field.value) {
                            validateField('conf_password');
                        }
                    });
                }
            });
            
            // Submit button handler
            btn.addEventListener('click', function (event) {
                event.preventDefault();
                let isValid = true;
                
                // Validate all fields
                rules.forEach(rule => {
                    if (!validateField(rule.field)) {
                        isValid = false;
                    }
                });
                
                // If all valid, submit form
                if (isValid) {
                    form.submit();
                }
            });
        });
    </script>
</div>
