document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('input_search');
    const offerCards = document.querySelectorAll('.offer-card');
    
    if (!searchInput || offerCards.length === 0) return;

    // Fonction de normalisation (réutilisée depuis searchFilter.js)
    function normalizeString(str) {
        return str
            ? str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .toLowerCase()
                .trim()
            : '';
    }

    // Fonction de recherche
    function filterOffers(query) {
        const normalizedQuery = normalizeString(query);
        
        offerCards.forEach(card => {
            if (!normalizedQuery) {
                // Si pas de recherche, afficher toutes les cartes
                card.style.display = '';
                return;
            }

            // Récupérer les données de la carte
            const title = card.querySelector('h3')?.textContent || '';
            const description = card.querySelector('p')?.textContent || '';
            const category = card.querySelector('.offer-card-category-prix-lieu p')?.textContent || '';
            const city = card.querySelector('.offer-card-city p')?.textContent || '';
            
            // Chercher dans tous les champs
            const searchFields = [title, description, category, city];
            const matches = searchFields.some(field => 
                normalizeString(field).includes(normalizedQuery)
            );

            // Afficher ou masquer la carte
            card.style.display = matches ? '' : 'none';
        });
    }

    // Fonction avec debounce pour éviter trop d'appels
    function debounce(func, delay) {
        let timeoutId;
        return function(...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }

    // Appliquer la recherche avec debounce
    const debouncedFilter = debounce(filterOffers, 300);
    
    searchInput.addEventListener('input', (e) => {
        debouncedFilter(e.target.value);
    });

    // Optionnel : gérer la soumission du formulaire
    const searchForm = searchInput.closest('form');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            filterOffers(searchInput.value);
        });
    }
});