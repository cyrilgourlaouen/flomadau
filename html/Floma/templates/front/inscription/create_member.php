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
                    <input name="zip_code" id="zip_code" type="text" placeholder="04200" required></input>
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
    <!-- <script src="/js/error-message-inscription-membre.js"></script> -->
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
                { field: 'pseudo', valid: val => val !== '', message: 'Veuillez entrer un pseudo.' },
                { field: 'password', valid: val => /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$&+,:;=?@#|'<>.^*()%!-])[A-Za-z\d!@#$%^&*()_+\-=\[\]{}]{12,}$/.test(val), message: 'Au moins une condition n\'est pas respectée'},
                { field: 'conf_password', valid: val => val === document.getElementById('password').value, message: 'Les mots de passe ne correspondent pas.' },
                { field: 'name_street', valid: val => val !== '', message: 'Veuillez entrer la rue.' },
                { field: 'num_street', valid: val => val !== '', message: 'Veuillez entrer le numéro.' },
                { field: 'city', valid: val => val !== '', message: 'Veuillez entrer la ville.' },
                { field: 'zip_code', valid: val => /^\d{5}$/.test(val), message: 'Veuillez entrer un code postal valide.' },
            ];
            
            // Function to validate a single field
            function validateField(fieldId) {
                const field = document.getElementById(fieldId);
                const value = field.value.trim();
                const rule = rules.find(r => r.field === fieldId);

                let errorElement = document.getElementById(`error-${fieldId}`);

                if (!rule.valid(value)) {
                    // S'il y a déjà une balise <span id="error-...">
                    if (!errorElement) {
                        // Si elle n'existe pas, on la crée
                        errorElement = document.createElement('span');
                        errorElement.className = 'error-msg';
                        errorElement.id = `error-${fieldId}`;
                        field.parentNode.appendChild(errorElement);
                    }
                    errorElement.innerText = rule.message;
                    return false;
                } else {
                    // Si valide, vider le message
                    if (errorElement) {
                        errorElement.innerText = '';
                    }
                    return true;
                }
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

                const pseudo = document.getElementById('pseudo').value.trim();
                const tel = document.getElementById('tel').value.trim();
                const email = document.getElementById('email').value.trim();

                // Use fetch to check email, but wait for the response
                fetch('?path=/inscription/membre/verification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({
                        email: email,
                        tel: tel,
                        pseudo: pseudo
                    })
                })
                    .then(response => {
                        return response.json()
                    }
                    )
                    .then(data => {
                        if (data.statusEmail === 'error') {
                            const errorEl = document.getElementById('error-email');
                            errorEl.innerText = data.messageEmail;
                        }
                        if (data.statusTel === 'error') { 
                            const errorEl = document.getElementById('error-tel');
                            errorEl.innerText = data.messageTel;
                        }
                        if (data.statusPseudo === 'error') {
                            const errorEl = document.getElementById('error-pseudo');
                            errorEl.innerText = data.messagePseudo;
                        } else {
                            if (isValid){
                                form.submit();
                            }                        
                        }
                    })
                    .catch(error => {
                        console.error('Error checking datas in db:', error);
                        // Show a generic error message
                        const errorElEmail = document.getElementById('error-email');
                        const errorElTel = document.getElementById('error-tel');
                        const errorElPseudo = document.getElementById('error-pseudo');
                        errorElEmail.innerText = 'Erreur de vérification de l\'email. Veuillez réessayer.';
                        errorElTel.innerText = 'Erreur de vérification du numéro de téléphone. Veuillez réessayer.';
                        errorElPseudo.innerText = 'Erreur de vérification du pseudo. Veuillez réessayer.';
                        isValid = false;
                    });
            });
        });
    </script>
</div>
