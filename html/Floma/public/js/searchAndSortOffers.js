document.addEventListener('DOMContentLoaded', () => {
    const offerSection = document.querySelector(".offer-section");
    const offersData = JSON.parse(offerSection.dataset.offers);
    const input = document.getElementById("offer-search-input");
    const offerList = document.querySelector(".offer-list"); // Conteneur des cartes
    
    const sortButton = document.getElementById('offer-sort-mobile-button');
    const sortDropdown = document.getElementById('offer-sort-mobile-options');
    const selectedLabel = document.getElementById('selected-sort-label');
    const sortOptions = document.querySelectorAll('#offer-sort-mobile-options p');
    
    let searchTimeout;
    let currentQuery = '';
    let currentSortType = 'asc';
    let filteredOffers = [...offersData];
    
    init();
    
    function init() {
        const defaultSelected = document.querySelector('.selected-sort');
        if (defaultSelected) {
            selectedLabel.textContent = defaultSelected.textContent;
            defaultSelected.style.display = 'none';
            currentSortType = defaultSelected.id;
        }
        
        sortDropdown.style.display = 'none';
        
        applyFiltersAndSort();
    }
    
    function normalizeString(str) {
        return str
            .normalize("NFD")
            .replace(/[\u0300-\u036f]/g, "")
            .toLowerCase()
            .trim();
    }
    
    /**
     * Extrait le prix d'une offre pour le tri
     */
    function getPriceForSort(offer) {
        if (!offer.categoryData) {
            return 0;
        }
        
        // Pour la restauration, utiliser gamme_de_prix
        if (offer.categorie === 'Restauration') {
            return offer.categoryData.gamme_de_prix || 0;
        }
        
        // Pour les autres catégories, utiliser prix_minimal
        return parseFloat(offer.categoryData.prix_minimal) || 0;
    }
    
    function filterOffers(query) {
        if (query === "") {
            return [...offersData];
        }
        
        return offersData.filter((offer) => {
            const title = normalizeString(offer.titre);
            const resume = normalizeString(offer.resume);
            const ville = normalizeString(offer.ville);
            const category = normalizeString(offer.categorie);
            const raison_sociale = normalizeString(offer.professionnelData.raison_sociale);
            
            return title.includes(query) ||
                   resume.includes(query) ||
                   ville.includes(query) ||
                   raison_sociale.includes(query) ||
                   category.includes(query);
        });
    }
    
    function sortOffers(offers, sortType) {
        const sorted = [...offers];
        
        switch(sortType) {
            case 'asc':
                // Tri par prix croissant
                return sorted.sort((a, b) => {
                    const priceA = getPriceForSort(a);
                    const priceB = getPriceForSort(b);
                    return priceA - priceB;
                });

            case 'desc':
                // Tri par prix décroissant
                return sorted.sort((a, b) => {
                    const priceA = getPriceForSort(a);
                    const priceB = getPriceForSort(b);
                    return priceB - priceA;
                });
                
            case 'note':
                return sorted.sort((a, b) => {
                    const noteA = parseFloat(a.note_moyenne) || 0;
                    const noteB = parseFloat(b.note_moyenne) || 0;
                    return noteB - noteA; // Tri décroissant par note
                });
                
            default:
                return sorted;
        }
    }
    
    function applyFiltersAndSort() {
        filteredOffers = filterOffers(currentQuery);
        const sortedOffers = sortOffers(filteredOffers, currentSortType);
        displayOffers(sortedOffers);
    }
    
    function displayOffers(offers) {
        // Récupère toutes les cartes actuelles
        const offerCards = document.querySelectorAll(".offer-card");
        
        // Cache toutes les cartes d'abord
        offerCards.forEach(card => card.style.display = 'none');
        
        // Réorganise les cartes dans le bon ordre
        offers.forEach((offer, index) => {
            // Trouve la carte correspondant à cette offre
            const originalIndex = offersData.findIndex(o => o.id === offer.id);
            if (originalIndex !== -1 && offerCards[originalIndex]) {
                const card = offerCards[originalIndex];
                card.style.display = '';
                
                // Réordonne physiquement les éléments dans le DOM
                offerList.appendChild(card);
            }
        });
    }
    
    input.addEventListener("input", () => {
        currentQuery = normalizeString(input.value);
        
        clearTimeout(searchTimeout);
        
        searchTimeout = setTimeout(() => {
            applyFiltersAndSort();
        }, 300);
    });
    
    sortButton.addEventListener('click', (e) => {
        e.preventDefault();
        
        if (sortDropdown.style.display === 'none') {
            sortDropdown.style.display = 'flex';
        } else {
            sortDropdown.style.display = 'none';
        }
    });
    
    sortOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Retire la classe selected-sort de toutes les options
            sortOptions.forEach(opt => {
                opt.classList.remove('selected-sort');
                opt.style.display = '';
            });
            
            // Ajoute la classe à l'option cliquée
            option.classList.add('selected-sort');
            option.style.display = 'none';
            
            // Met à jour le label
            selectedLabel.textContent = option.textContent;
            
            // Met à jour le type de tri
            currentSortType = option.id;
            
            // Ferme le dropdown
            sortDropdown.style.display = 'none';
            
            // Applique le nouveau tri
            applyFiltersAndSort();
        });
    });
    
    document.addEventListener('click', (e) => {
        if (!sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
            sortDropdown.style.display = 'none';
        }
    });
});