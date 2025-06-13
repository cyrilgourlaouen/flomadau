<?php include 'black_button.php'; ?>
<div class="formContainer">
    <div class="formSectionContainer">
        <div class="h3-section">
            <h3>Informations générales</h3>
            <hr>
        </div>
        <form method="post" action="?path=/pro/signup/submit">
            <div class="formInline">
                <div class="field">
                    <label for="prenom">Prénom</label><br>
                    <input type="text" id="prenom" name="prenom" placeholder="Pierre" required>
                </div>
                <div class="field">
                    <label for="nom">Nom</label><br>
                    <input type="text" id="nom" name="nom" placeholder="Durand" required>
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="num">Téléphone</label><br>
                    <input type="text" id="num" name="num" placeholder="XX XX XX XX XX" required>
                </div>
                <div class="field">
                    <label for="mail">Email</label><br>
                    <input type="text" id="mail" name="mail" placeholder="exemple@gmail.com" required>
                </div>
            </div>
            <div class="separation"></div>
            <div class="formInline">
                <div class="field">
                    <label for="denomination">Dénomination</label><br>
                    <input type="text" id="denomination" name="denomination" placeholder="Café des Deux Moulins"
                        required>
                </div>
                <div class="field">
                    <label for="siren">SIREN</label><br>
                    <input type="text" id="siren" name="siren" placeholder="XXX XXX XXX" required>
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="mdp">Mot de passe</label><br>
                    <input type="password" id="mdp" name="mdp" required>
                    <div class="error-message"></div>
                </div>
                <div class="field">
                    <label for="conf_mdp">Confirmation du mot de passe</label><br>
                    <input type="password" id="conf_mdp" name="conf_mdp" required>
                </div>
            </div>
            <div class="separation"></div>
            <div class="h3-section">
                <h3>Adresse</h3>
                <hr>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="rue">Rue</label><br>
                    <input type="text" id="rue" name="rue" placeholder="Rue Lepic" required>
                </div>
                <div class="field">
                    <label for="numero">Numéro</label><br>
                    <input type="text" id="numero" name="numero" placeholder="15" required>
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="ville">Ville</label><br>
                    <input type="text" id="ville" name="ville" placeholder="Paris" required>
                </div>
                <div class="field">
                    <label for="code_postal">Code postal</label><br>
                    <input type="text" id="code_postal" name="code_postal" placeholder="75018" required>
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="departement">Département</label><br>
                    <select id="departement" name="departement" required>
                        <option value="">-- Sélectionnez --</option>
                        <option value="04">04 - Alpes-De-Haute-Provence</option>
                        <option value="05">05 - Hautes-Alpes</option>
                        <option value="06">06 - Alpes-Maritimes</option>
                        <option value="13">13 - Bouches-du-Rhône</option>
                        <option value="83">83 - Var</option>
                        <option value="84">84 - Vaucluse</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="buttonContainer">
        <div class="button">
            <?php echo black_button('Suivant'); ?>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.formContainer form');
        const btn = document.querySelector('.buttonContainer .button button');
<<<<<<< HEAD
        
        // Validation rules
        const rules = [
            { field: 'prenom', valid: val => val !== '', message: 'Veuillez entrer un prénom.' },
            { field: 'nom', valid: val => val !== '', message: 'Veuillez entrer un nom.' },
            { field: 'num', valid: val => /^(?:(?:\+33|0033)\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/.test(val), message: 'Veuillez entrer un numéro valide.' },
            { field: 'mail', valid: val => /^\S+@\S+\.\S+$/.test(val), message: 'Veuillez entrer une adresse email valide.' },
            { field: 'denomination', valid: val => val !== '', message: 'Veuillez entrer la dénomination.' },
            { field: 'siren', valid: val => /^\d{3}( \d{3}){2}$/.test(val), message: 'Veuillez entrer un SIREN valide.' },
            { field: 'mdp', valid: val => val.length >= 6, message: 'Le mot de passe est trop court.' },
            { field: 'conf_mdp', valid: val => val === document.getElementById('mdp').value, message: 'Les mots de passe ne correspondent pas.' },
            { field: 'rue', valid: val => val !== '', message: 'Veuillez entrer la rue.' },
            { field: 'numero', valid: val => val !== '', message: 'Veuillez entrer le numéro.' },
            { field: 'ville', valid: val => val !== '', message: 'Veuillez entrer la ville.' },
            { field: 'code_postal', valid: val => /^\d{5}$/.test(val), message: 'Veuillez entrer un code postal valide.' },
            { field: 'departement', valid: val => val !== '', message: 'Veuillez sélectionner un département.' }
        ];
        
        // Function to validate a single field
        function validateField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value.trim();
            const rule = rules.find(r => r.field === fieldId);
            
            // Remove existing error message
            const existingError = field.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }
            
            // Check if valid
            if (!rule.valid(value)) {
                const errorEl = document.createElement('div');
                errorEl.className = 'error-message';
                errorEl.innerText = rule.message;
                field.parentNode.appendChild(errorEl);
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
            if (rule.field === 'conf_mdp') {
                document.getElementById('mdp').addEventListener('input', () => {
                    if (field.value) {
                        validateField('conf_mdp');
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
            
=======
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            let isValid = true;
            // Remove previous error messages
            document.querySelectorAll('.error-message').forEach(el => el.remove());

            // Retrieve values
            const values = {
                prenom: document.getElementById('prenom').value.trim(),
                nom: document.getElementById('nom').value.trim(),
                num: document.getElementById('num').value.trim(),
                mail: document.getElementById('mail').value.trim(),
                denomination: document.getElementById('denomination').value.trim(),
                siren: document.getElementById('siren').value.trim(),
                mdp: document.getElementById('mdp').value,
                conf_mdp: document.getElementById('conf_mdp').value,
                rue: document.getElementById('rue').value.trim(),
                numero: document.getElementById('numero').value.trim(),
                ville: document.getElementById('ville').value.trim(),
                code_postal: document.getElementById('code_postal').value.trim(),
                departement: document.getElementById('departement').value
            };

            // Validation rules
            const rules = [
                { field: 'prenom', valid: val => val !== '', message: 'Veuillez entrer un prénom.' },
                { field: 'nom', valid: val => val !== '', message: 'Veuillez entrer un nom.' },
                { field: 'num', valid: val => /^(?:(?:\+33|0033)\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/.test(val), message: 'Veuillez entrer un numéro valide.' },
                { field: 'mail', valid: val => /^\S+@\S+\.\S+$/.test(val), message: 'Veuillez entrer une adresse email valide.' },
                { field: 'denomination', valid: val => val !== '', message: 'Veuillez entrer la dénomination.' },
                { field: 'siren', valid: val => /^\d{3}( \d{3}){2}$/.test(val), message: 'Veuillez entrer un SIREN valide.' },
                { field: 'mdp', valid: val => val.length >= 6, message: 'Le mot de passe est trop court.' },
                { field: 'conf_mdp', valid: val => val === values.mdp, message: 'Les mots de passe ne correspondent pas.' },
                { field: 'rue', valid: val => val !== '', message: 'Veuillez entrer la rue.' },
                { field: 'numero', valid: val => val !== '', message: 'Veuillez entrer le numéro.' },
                { field: 'ville', valid: val => val !== '', message: 'Veuillez entrer la ville.' },
                { field: 'code_postal', valid: val => /^\d{5}$/.test(val), message: 'Veuillez entrer un code postal valide.' },
                { field: 'departement', valid: val => val !== '', message: 'Veuillez sélectionner un département.' }
            ];

            // Apply validation
            rules.forEach(rule => {
                const val = values[rule.field];
                if (!rule.valid(val)) {
                    isValid = false;
                    const inputEl = document.getElementById(rule.field);
                    const errorEl = document.createElement('div');
                    errorEl.className = 'error-message';
                    errorEl.innerText = rule.message;
                    inputEl.parentNode.appendChild(errorEl);
                }
            });

>>>>>>> 493fbae3c13db40e04cf2768d01458cd057800f2
            // If all valid, submit form
            if (isValid) {
                form.submit();
            }
        });
    });
</script>
