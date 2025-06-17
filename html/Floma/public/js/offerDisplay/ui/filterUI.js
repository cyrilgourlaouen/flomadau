export function setupFilterUI(filterManager, displayManager) {
    // Accessibilité globale
    window.filterManager = filterManager;
    
    // --- FILTRE PAR TEXTE ---
    const searchInput = document.getElementById('offer-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            filterManager.setFilter('search', e.target.value);
            refreshDisplay();
        });
    }
    
    // --- FILTRE PAR CATÉGORIE (DESKTOP) ---
    const categoryDropdownButton = document.querySelector('#desktop-categorie-button');
    const categoryDropdownOptions = document.querySelector('#desktop-categorie-options');
    const desktopCategoryOptions = document.querySelectorAll('#desktop-categorie-options .desktop-filter-option');
    const selectedCategoryLabel = document.getElementById('selected-category-label');
    
    // Toggle du dropdown
    if (categoryDropdownButton && categoryDropdownOptions) {
        categoryDropdownOptions.style.display = 'none';
        
        categoryDropdownButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            categoryDropdownOptions.style.display = categoryDropdownOptions.style.display === 'none' ? 'block' : 'none';
        });
        
        document.addEventListener('click', (e) => {
            if (categoryDropdownOptions.style.display !== 'none' && 
                !categoryDropdownButton.contains(e.target) && 
                !categoryDropdownOptions.contains(e.target)) {
                categoryDropdownOptions.style.display = 'none';
            }
        });
    }
    
    // --- FILTRE PAR CATÉGORIE (MOBILE/MODAL) ---
    const modalCategoryOptions = document.querySelectorAll('.filter-modal-category-option');
    
    // Fonction pour gérer la sélection d'une catégorie et synchroniser desktop/mobile
    function handleCategorySelection(category, isFromDesktop = true) {
        // Toggle la sélection
        const isCurrentlySelected = filterManager.getFilter('category') === category;
        
        // Mise à jour du filtre
        filterManager.setFilter('category', isCurrentlySelected ? null : category);
        
        // Mise à jour de l'UI Desktop
        desktopCategoryOptions.forEach(opt => {
            opt.classList.remove('selected-category-desktop');
            if (!isCurrentlySelected && opt.dataset.category === category) {
                opt.classList.add('selected-category-desktop');
            }
        });
        
        // Mise à jour du label desktop
        if (selectedCategoryLabel) {
            selectedCategoryLabel.textContent = !isCurrentlySelected && category ? `: ${category}` : '';
        }
        
        // Mise à jour de l'UI Mobile/Modal
        modalCategoryOptions.forEach(opt => {
            opt.classList.remove('selected-category');
            if (!isCurrentlySelected && opt.dataset.category === category) {
                opt.classList.add('selected-category');
            }
        });
        
        // Rafraîchir l'affichage
        refreshDisplay();
    }
    
    // Attacher les événements aux catégories desktop
    desktopCategoryOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const category = option.dataset.category;
            handleCategorySelection(category, true);
            
            // Fermer le dropdown
            if (categoryDropdownOptions) {
                categoryDropdownOptions.style.display = 'none';
            }
        });
    });
    
    // Attacher les événements aux catégories mobile/modal
    modalCategoryOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const category = option.dataset.category;
            handleCategorySelection(category, false);
        });
    });
    
    function refreshDisplay() {
        if (window.sortManager) {
            displayManager.refreshWithFiltersAndSort(filterManager, window.sortManager);
        } else {
            displayManager.refreshWithFiltersAndSort(filterManager, {sortOffers: (offers) => offers});
        }
    }
}