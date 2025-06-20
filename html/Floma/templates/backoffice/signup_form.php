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
                    <div>
                        <div>
                            <label for="entreprise_privee">Entreprise privée</label>
                            <input type="radio" id="entreprise_privee" name="type_entreprise" value="privee" style="width: 119px;" required>
                        </div>
                        <div>
                            <label for="entreprise_publique">Entreprise publique</label>
                            <input type="radio" id="entreprise_publique" name="type_entreprise" value="publique" style="width: 70px;" required>
                        </div>
                    </div>
                    <div class="error-message"></div>
                </div>
            </div>
            <div class="formInline">
                <div class="field">
                    <label for="denomination">Dénomination</label><br>
                    <input type="text" id="denomination" name="denomination" placeholder="Café des Deux Moulins"
                        required>
                </div>
                <div class="field" id="siren-field" style="display: none;">
                    <label for="siren">SIREN</label><br>
                    <input type="text" id="siren" name="siren" placeholder="XXX XXX XXX">
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
            <div id="bank-card-section" style="display: none;">
                <div class="separation"></div>
                <div class="h3-section">
                    <h3>Carte bancaire (Optionnel)</h3>
                    <hr>
                </div>
                <div class="formInline">
                    <div class="field">
                        <label for="card-number">Numéro de carte</label>
                        <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="field">
                        <label for="expiration-date">Date expiration (MM/AAAA)</label>
                        <input type="text" id="expiration-date" name="expiration-date" placeholder="12/2025">
                    </div>
                </div>
                <div class="formInline">
                    <div class="field">
                        <label for="cvv" style="margin-top:10px">Cryptogramme</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123">
                    </div>
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.formContainer form');
    const btn = document.querySelector('.buttonContainer .button button');
    const sirenField = document.getElementById('siren-field');
    const sirenInput = document.getElementById('siren');
    const bankCardSection = document.getElementById('bank-card-section');
    const bankCardInputs = bankCardSection.querySelectorAll('input');

    // Function to remove all error messages from a field container
    function removeErrorMessages(fieldContainer) {
        const errorMessages = fieldContainer.querySelectorAll('.error-message');
        errorMessages.forEach(error => {
            if (error.textContent.trim() !== '') {
                error.textContent = '';
            }
        });
    }

    // Function to add error message to a field container
    function addErrorMessage(fieldContainer, message) {
        // Remove existing errors first
        removeErrorMessages(fieldContainer);
        
        // Find or create error message container
        let errorContainer = fieldContainer.querySelector('.error-message');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'error-message';
            fieldContainer.appendChild(errorContainer);
        }
        
        errorContainer.textContent = message;
    }

    // Function to get field container for any field type
    function getFieldContainer(fieldId) {
        if (fieldId === 'type_entreprise') {
            return document.querySelector('input[name="type_entreprise"]').closest('.field');
        } else {
            return document.getElementById(fieldId).closest('.field');
        }
    }

    // Function to check if SIREN field should be visible
    function isSirenRequired() {
        const checkedRadio = document.querySelector('input[name="type_entreprise"]:checked');
        return checkedRadio && checkedRadio.value === 'privee';
    }

    // Function to check if bank card fields should be validated
    function isBankCardVisible() {
        return bankCardSection.style.display !== 'none' && isSirenRequired();
    }

    // Show/hide SIREN field and bank card section based on company type selection
    function togglePrivateCompanyFields() {
        if (isSirenRequired()) {
            // Show SIREN field
            sirenField.style.display = 'block';
            sirenInput.required = true;
            
            // Show bank card section
            bankCardSection.style.display = 'block';
        } else {
            // Hide SIREN field
            sirenField.style.display = 'none';
            sirenInput.required = false;
            sirenInput.value = ''; // Clear value when hidden
            removeErrorMessages(sirenField);
            
            // Hide bank card section
            bankCardSection.style.display = 'none';
            // Clear bank card values when hidden
            bankCardInputs.forEach(input => {
                input.value = '';
                removeErrorMessages(input.closest('.field'));
            });
        }
    }

    // Add event listeners to radio buttons for company type
    const radioButtons = document.querySelectorAll('input[name="type_entreprise"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', togglePrivateCompanyFields);
    });

    // Validation rules
    const rules = [{
            field: 'prenom',
            valid: val => val !== '',
            message: 'Veuillez entrer un prénom.'
        },
        {
            field: 'nom',
            valid: val => val !== '',
            message: 'Veuillez entrer un nom.'
        },
        {
            field: 'num',
            valid: val => /^(?:(?:\+33|0033)\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/.test(val),
            message: 'Veuillez entrer un numéro valide.'
        },
        {
            field: 'mail',
            valid: val => /^\S+@\S+\.\S+$/.test(val),
            message: 'Veuillez entrer une adresse email valide.'
        },
        {
            field: 'type_entreprise',
            valid: val => val !== '',
            message: 'Veuillez sélectionner un type d\'entreprise.'
        },
        {
            field: 'denomination',
            valid: val => val !== '',
            message: 'Veuillez entrer la dénomination.'
        },
        {
            field: 'siren',
            valid: val => {
                // Only validate SIREN if it's required (entreprise privée selected)
                if (!isSirenRequired()) return true;
                return /^\d{3}( \d{3}){2}$/.test(val);
            },
            message: 'Veuillez entrer un SIREN valide.',
            conditional: true // Mark as conditional field
        },
        {
            field: 'mdp',
            valid: val => val.length >= 6,
            message: 'Le mot de passe est trop court.'
        },
        {
            field: 'conf_mdp',
            valid: val => val === document.getElementById('mdp').value,
            message: 'Les mots de passe ne correspondent pas.'
        },
        {
            field: 'rue',
            valid: val => val !== '',
            message: 'Veuillez entrer la rue.'
        },
        {
            field: 'numero',
            valid: val => /^\d+$/.test(val),
            message: 'Veuillez entrer un numéro valide.'
        },
        {
            field: 'ville',
            valid: val => val !== '',
            message: 'Veuillez entrer la ville.'
        },
        {
            field: 'code_postal',
            valid: val => /^\d{5}$/.test(val),
            message: 'Veuillez entrer un code postal valide.'
        },
        {
            field: 'departement',
            valid: val => val !== '',
            message: 'Veuillez sélectionner un département.'
        },
        {
            field: 'card-number',
            valid: val => {
                // Only validate if bank card section is visible
                if (!isBankCardVisible()) return true;
                // Allow empty value since it's optional
                if (val === '') return true;
                // Remove spaces and check if it's 16 digits
                const cleanNumber = val.replace(/\s/g, '');
                return /^\d{16}$/.test(cleanNumber);
            },
            message: 'Veuillez entrer un numéro de carte valide.',
            conditional: true
        },
        {
            field: 'expiration-date',
            valid: val => {
                // Only validate if bank card section is visible
                if (!isBankCardVisible()) return true;
                // Allow empty value since it's optional
                if (val === '') return true;
                // Check MM/YYYY format
                if (!/^(0[1-9]|1[0-2])\/\d{4}$/.test(val)) return false;
                // Check if date is not in the past
                const [month, year] = val.split('/').map(Number);
                const now = new Date();
                const currentMonth = now.getMonth() + 1;
                const currentYear = now.getFullYear();
                return year > currentYear || (year === currentYear && month >= currentMonth);
            },
            message: 'Veuillez entrer une date d\'expiration valide (MM/AAAA) et future.',
            conditional: true
        },
        {
            field: 'cvv',
            valid: val => {
                // Only validate if bank card section is visible
                if (!isBankCardVisible()) return true;
                // Allow empty value since it's optional
                if (val === '') return true;
                // Check if it's 3 or 4 digits
                return /^\d{3,4}$/.test(val);
            },
            message: 'Veuillez entrer un cryptogramme valide (3 ou 4 chiffres).',
            conditional: true
        }
    ];

    // Function to validate a single field
    function validateField(fieldId) {
        const rule = rules.find(r => r.field === fieldId);

        // Skip validation for conditional fields that aren't currently required
        if (rule.conditional) {
            if (fieldId === 'siren' && !isSirenRequired()) {
                return true;
            }
            if (['card-number', 'expiration-date', 'cvv'].includes(fieldId) && !isBankCardVisible()) {
                return true;
            }
        }

        let value;
        const fieldContainer = getFieldContainer(fieldId);

        // Handle radio buttons for company type
        if (fieldId === 'type_entreprise') {
            const checkedRadio = document.querySelector('input[name="type_entreprise"]:checked');
            value = checkedRadio ? checkedRadio.value : '';
        } else {
            const field = document.getElementById(fieldId);
            value = field.value.trim();
        }

        // Remove existing error messages
        removeErrorMessages(fieldContainer);

        // Check if valid
        if (!rule.valid(value)) {
            addErrorMessage(fieldContainer, rule.message);
            return false;
        }
        return true;
    }

    // Add event listeners to all fields
    rules.forEach(rule => {
        if (rule.field === 'type_entreprise') {
            // Add listeners to radio buttons
            const radioButtons = document.querySelectorAll('input[name="type_entreprise"]');
            radioButtons.forEach(radio => {
                radio.addEventListener('change', () => {
                    validateField('type_entreprise');
                    togglePrivateCompanyFields(); // Update SIREN field and bank card section visibility
                });
            });
        } else {
            const field = document.getElementById(rule.field);
            if (field) { // Check if field exists
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

                // Add input formatting for card number (add spaces every 4 digits)
                if (rule.field === 'card-number') {
                    field.addEventListener('input', (e) => {
                        let value = e.target.value.replace(/\s/g, '').replace(/\D/g, '');
                        let formattedValue = value.replace(/(.{4})/g, '$1 ').trim();
                        if (formattedValue.length <= 19) { // 16 digits + 3 spaces
                            e.target.value = formattedValue;
                        }
                    });
                }

                // Add input formatting for expiration date (MM/YYYY)
                if (rule.field === 'expiration-date') {
                    field.addEventListener('input', (e) => {
                        let value = e.target.value.replace(/\D/g, '');
                        if (value.length >= 2) {
                            value = value.substring(0, 2) + '/' + value.substring(2, 6);
                        }
                        e.target.value = value;
                    });
                }

                // Add input formatting for CVV (numbers only)
                if (rule.field === 'cvv') {
                    field.addEventListener('input', (e) => {
                        e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
                    });
                }
            }
        }
    });

    // Submit button handler
    btn.addEventListener('click', function(event) {
        event.preventDefault();
        let isValid = true;

        // Validate all fields (conditional validation handled in validateField)
        rules.forEach(rule => {
            if (!validateField(rule.field)) {
                isValid = false;
            }
        });

        // If basic validation passes, check email and phone uniqueness
        if (isValid) {
            const emailField = document.getElementById('mail');
            const phoneField = document.getElementById('num');
            const emailValue = emailField.value.trim();
            const phoneValue = phoneField.value.trim();
            const emailFieldContainer = getFieldContainer('mail');
            const phoneFieldContainer = getFieldContainer('num');

            // Remove any existing error messages for email and phone
            removeErrorMessages(emailFieldContainer);
            removeErrorMessages(phoneFieldContainer);

            // Use fetch to check email and phone uniqueness
            fetch('?path=/pro/signup/verify', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `mail=${encodeURIComponent(emailValue)}&num=${encodeURIComponent(phoneValue)}`
                })
                .then(response => {
                    return response.json()
                })
                .then(data => {
                    if (data.status === 'error') {
                        // Handle multiple possible errors
                        if (data.errors) {
                            // New format with multiple errors
                            if (data.errors.email) {
                                addErrorMessage(emailFieldContainer, data.errors.email);
                            }
                            if (data.errors.telephone) {
                                addErrorMessage(phoneFieldContainer, data.errors.telephone);
                            }
                        } else if (data.message) {
                            // Fallback for single message format
                            addErrorMessage(emailFieldContainer, data.message);
                        }
                    } else {
                        // No errors, submit the form
                        form.submit();
                    }
                })
                .catch(error => {
                    console.error('Error checking email and phone:', error);
                    // Show a generic error message
                    addErrorMessage(emailFieldContainer, 'Erreur de vérification. Veuillez réessayer.');
                });
        }
    });

    // Initialize SIREN field and bank card section visibility on page load
    togglePrivateCompanyFields();
});
</script>
