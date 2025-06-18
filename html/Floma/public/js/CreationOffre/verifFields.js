document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.formContainer');
    const btn = document.querySelector('.buttonContainer .button-black');

    const jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

    function validateFile(input, allowedTypes, maxSize) {
        if (!input || input.files.length === 0) return false;

        for (let i = 0; i < input.files.length; i++) {
            const file = input.files[i];
            const ext = file.name.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(ext) || file.size > maxSize) {
                return false;
            }
        }
    return true; 
    }

    const rules = [
        { field: 'offer_name', valid: val => val !== '', message: "Veuillez entrer un nom d'offre" },
        { field: 'conditions_accesibilite', valid: val => val !== '', message: "Veuillez renseigner une ou plusieurs conditions d'accessibilitées" },
        { field: 'nom_rue', valid: val => val !== '', message: 'Veuillez entrer la rue.' },
        { field: 'numero_rue', valid: val => val !== '', message: 'Veuillez entrer un numero de rue.' },
        { field: 'ville', valid: val => val !== '', message: 'Veuillez entrer une ville.' },
        { field: 'telephone', valid: val => /^(?:(?:\+33|0033)\s?|0)[1-9](?:[\s.-]?\d{2}){4}$/.test(val), message: 'Veuillez entrer un numéro valide.' },
        {
            field: 'resume',
            valid: val => val.trim() !== '' && val.trim().length <= 155,
            message: 'Veuillez entrer un résumé (155 caractères maximum).'
        },
        {
            field: 'description_detaillee',
            valid: val => val.trim() !== '' && val.trim().length <= 500,
            message: 'Veuillez entrer un résumé (500 caractères maximum).'
        },
        {
            field: 'photo_offre', valid: () => {
                const fileInput = document.getElementById('photo_offre');
                if (!fileInput || fileInput.files.length === 0) return false;
                return validateFile(fileInput, ['svg', 'pdf', 'jpg', 'jpeg'], 100000);
            }, message: 'Veuillez sélectionner un ou plusieurs fichier(s) SVG, PDF, JPG ou JPEG de moins de 100 Ko.'
        },
        {
            field: 'horaires',
            valid: () => {
                return jours.every(jour => {
                    const jourId = jour.toLowerCase();
                    const container = document.querySelector(`#${jourId}-slots`);
                    const checkbox = container?.parentElement?.querySelector('input[type="checkbox"]');

                    if (!checkbox || !checkbox.checked) return true;

                    const slots = [...container.querySelectorAll('.slot')];
                    if (slots.length === 0) return false;

                    const horaires = slots.map(slot => {
                        const ouverture = slot.querySelector(`[name="${jourId}_ouverture[]"]`)?.value.trim();
                        const fermeture = slot.querySelector(`[name="${jourId}_fermeture[]"]`)?.value.trim();
                        if (!ouverture || !fermeture || ouverture >= fermeture) return null;
                        return { debut: ouverture, fin: fermeture };
                    }).filter(slot => slot !== null);

                    if (horaires.length === 0) return false; 

                    horaires.sort((a, b) => a.debut.localeCompare(b.debut));

                    for (let i = 1; i < horaires.length; i++) {
                        const prev = horaires[i - 1];
                        const curr = horaires[i];
                        if (curr.debut < prev.fin) {
                        return false;
                        }
                    }
                        return true; 
                });
            },

            message: 'Tous les jours ouverts doivent avoir des créneaux valides, sans chevauchements (ex : 07:00 → 12:00 puis 12:30 → 14:00).'
        },
        { field: 'code_postal', valid: val => /^\d{5}$/.test(val), message: 'Veuillez entrer un code postal valide.' },
        {
            field: 'guideOptions', valid: () => {
                const select = document.getElementById('guideOptions');
                if (!select) return false;
                return Array.from(select.options).some(option => option.selected);
            }, message: 'Veuillez sélectionner au moins un guide.'
        },
        {
            field: 'gamme_de_prix',
            valid: () => {
                const select = document.getElementById('gamme_de_prix');
                return select && select.value !== '';
            },
            message: 'Veuillez sélectionner une gamme de prix.'
        },
        {
            field: 'restaurant', valid: () => {
                const select = document.getElementById('restaurant');
                if (!select) return false;
                return Array.from(select.options).some(option => option.selected);
            }, message: 'Veuillez sélectionner au moins un tag de restaurant.'
        },
        {
            field: 'categoryAll', valid: () => {
                const select = document.getElementById('categoryAll');
                if (!select) return false;
                return Array.from(select.options).some(option => option.selected);
            }, message: 'Veuillez sélectionner au moins un tag de catégorie.'
        },
        {
            field: 'categorie', 
            valid: () => {
                const select = document.getElementById('categorie');
                if (!select) return false;
                return select.value !== "";
            }, 
            message: 'Veuillez sélectionner une catégorie.'
        },
        { field: 'denomination', valid: val => val !== '', message: 'Veuillez entrer la dénomination.' },
        { field: 'departement', valid: val => val !== '', message: 'Veuillez sélectionner un département.' },
        { field: 'prix_minimal_visite', valid: val => val !== '' && !isNaN(val) && Number(val) > 0, message: 'Veuillez entrer un prix minimal valide.' },
        { field: 'duree_show', valid: val => val.trim() !== '', message: 'Veuillez entrer la durée du spectacle.' },
        { field: 'duree_visite', valid: val => val.trim() !== '', message: 'Veuillez entrer la durée de la visite.' },
        { field: 'prix_minimal_show', valid: val => val !== '' && !isNaN(val) && Number(val) > 0, message: 'Veuillez entrer un prix minimal valide pour le spectacle.' },
        { field: 'capacite', valid: val => val !== '' && Number.isInteger(Number(val)) && Number(val) > 0, message: 'Veuillez entrer une capacité valide .' },
        { field: 'gamme_de_prix', valid: val => val !== '', message: 'Veuillez sélectionner une gamme de prix.' },
        {
            field: 'url_carte_restaurant',
            valid: () => {
                const fileInput = document.getElementById('url_carte_restaurant');
                if (!fileInput || fileInput.files.length === 0) return false;
                return validateFile(fileInput, ['svg', 'pdf', 'jpg', 'jpeg'], 100000);
            },
            message: 'Veuillez sélectionner une carte au format SVG, PDF, JPG ou JPEG (moins de 100 Ko).'
        },
        { field: 'duree_activity', valid: val => val.trim() !== '', message: "Veuillez entrer la durée de l'activité." },
        { field: 'age_requis_activity', valid: val => val !== '' && Number.isInteger(Number(val)) && Number(val) >= 0, message: "Veuillez entrer un âge requis valide (nombre entier >= 0)." },
        { field: 'prestations_incluses', valid: val => val.trim() !== '', message: "Veuillez renseigner les prestations incluses." },
        { field: 'prestations_non_incluses', valid: val => val.trim() !== '', message: "Veuillez renseigner les prestations non incluses." },
        { field: 'prix_minimal_activity', valid: val => val !== '' && !isNaN(val) && Number(val) > 0, message: 'Veuillez entrer un prix minimal valide pour l’activité.' },
        { field: 'nombre_attractions', valid: val => val !== '' && Number.isInteger(Number(val)) && Number(val) > 0, message: 'Veuillez entrer un nombre d’attractions valide .' },
        { field: 'prix_minimal_amusement', valid: val => val !== '' && !isNaN(val) && Number(val) > 0, message: 'Veuillez entrer un prix minimal valide pour le parc.' },
        { field: 'age_requis_amusement', valid: val => val !== '' && Number.isInteger(Number(val)) && Number(val) >= 0, message: 'Veuillez entrer un âge requis valide .' },
        { field: 'url_carte_parc', valid: () => { const input = document.querySelector('input[name="url_carte_parc"]'); return input && input.files.length > 0; }, message: "Veuillez sélectionner une carte du parc d'attraction." },
        {
            field: 'url_carte_parc',
            valid: () => {
                const fileInput = document.getElementById('url_carte_parc');
                if (!fileInput || fileInput.files.length === 0) return false;
                return validateFile(fileInput, ['svg', 'pdf', 'jpg', 'jpeg'], 100000);
            },
            message: "Veuillez sélectionner une carte au format SVG, PDF, JPG ou JPEG (moins de 100 Ko)."
        },
        {
            field: 'types_repas',
            valid: () => {
                const container = document.querySelector('#champs-restaurant');
                if (!container || container.classList.contains('hidden')) return true;

                const checkboxes = document.querySelectorAll('input[name="types_repas[]"]');
                return [...checkboxes].some(cb => cb.checked);
            },
            message: 'Veuillez sélectionner au moins un type de repas.'
        }
    ];

    function isVisible(element) {
        return element && !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
    }

    function validateField(fieldId) {
        const rule = rules.find(r => r.field === fieldId);
        if (!rule) return true;

        const field = document.getElementById(fieldId);
        if (!field || !isVisible(field)) return true;
        let value = '';

        if (fieldId === 'types_repas') {
            const container = document.getElementById('types_repas');
            if (!container || !isVisible(container)) return true;

            const existingError = container.querySelector('.error-message');
            if (existingError) existingError.remove();

            if (!rule.valid()) {
                const errorEl = document.createElement('div');
                errorEl.className = 'error-message';
                errorEl.innerText = rule.message;
                container.appendChild(errorEl);
                return false;
            }
            return true;
        }
        if (fieldId === 'horaires') {
            const container = document.getElementById('horaire-container');
            if (!container) return true;

            const existingError = container.querySelector('.error-message');
            if (existingError) existingError.remove();

            const isValid = rules.find(r => r.field === 'horaires').valid();

            if (!isValid) {
                const errorEl = document.createElement('div');
                errorEl.className = 'error-message';
                errorEl.innerText = rules.find(r => r.field === 'horaires').message;
                container.appendChild(errorEl);
            }
            return isValid;
        }

        if (fieldId === 'photo_offre') {
            const label = document.querySelector('label[for="file"]'); 
            if (!label) return true;

            const existingError = label.nextElementSibling;
            if (existingError?.classList.contains('error-message')) existingError.remove();

            if (!rule.valid()) {
                const errorEl = document.createElement('div');
                errorEl.className = 'error-message';
                errorEl.innerText = rule.message;
                label.insertAdjacentElement('afterend', errorEl); 
                return false;
            }
            return true;
        }

        if (field) {
            if (field.type === 'checkbox' || field.type === 'radio') {
                value = field.checked;
            } else if (field.type === 'file') {
                value = field.files;
            } else {
                value = field.value.trim();
            }
        }

        if (
            rule.field === 'photo_offre' || rule.field === 'horaires' ||
            ['guideOptions', 'gamme_de_prix', 'restaurant', 'categoryAll'].includes(rule.field)
        ) {
            value = null;
        }

        const parent = field?.parentNode || document.querySelector(`#${fieldId}`)?.closest('.input-container');
        const existingError = parent?.querySelector('.error-message');
        if (existingError) existingError.remove();

        if (!rule.valid(value)) {
            const errorEl = document.createElement('div');
            errorEl.className = 'error-message';
            errorEl.innerText = rule.message;
            parent?.appendChild(errorEl);
            return false;
        }
        return true;
    }

    btn.addEventListener('click', function (event) {
        event.preventDefault();
        let isValid = true;

        rules.forEach(rule => {
            if (!validateField(rule.field)) {
                isValid = false;
            }
        });

        if (isValid) {
            form.submit();
        }

    });
});
