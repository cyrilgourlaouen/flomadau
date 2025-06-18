export function setupSortUI(sortManager, displayManager) {
    // Accessibilité globale
    window.sortManager = sortManager;
    
    // --- CONFIGURATION DESKTOP ---
    const sortDesktopButton = document.querySelector('#offer-sort-desktop-button');
    const sortDesktopOptions = document.querySelector('#offer-sort-desktop-options');
    const sortDesktopOptionItems = document.querySelectorAll('#offer-sort-desktop-options p');
    const selectedSortDesktopLabel = document.getElementById('selected-sort-desktop-label');
    
    // --- CONFIGURATION MOBILE ---
    const sortMobileButton = document.querySelector('#offer-sort-mobile-button');
    const sortMobileOptions = document.querySelector('#offer-sort-mobile-options');
    const sortMobileOptionItems = document.querySelectorAll('#offer-sort-mobile-options p');
    const selectedSortMobileLabel = document.getElementById('selected-sort-mobile-label');
    
    // Fonction pour gérer la sélection d'un type de tri (synchronise desktop et mobile)
    function handleSortSelection(sortType, source) {
        // Mise à jour du gestionnaire de tri
        sortManager.setSortType(sortType);
        
        // Mise à jour de l'UI Desktop - AVEC MASQUAGE DE L'OPTION SÉLECTIONNÉE
        sortDesktopOptionItems.forEach(opt => {
            const optionSortType = opt.id || opt.getAttribute('data-sort-type');
            
            // Masquer l'option sélectionnée et afficher les autres
            if (optionSortType === sortType) {
                opt.style.display = 'none';  // Masquer l'option sélectionnée
            } else {
                opt.style.display = '';      // Afficher les autres options
            }
            
            // Mettre à jour la classe pour le style
            opt.classList.toggle('selected-sort', optionSortType === sortType);
        });
        
        // Mise à jour du label desktop
        if (selectedSortDesktopLabel) {
            const selectedOption = Array.from(sortDesktopOptionItems).find(opt => 
                (opt.id || opt.getAttribute('data-sort-type')) === sortType
            );
            if (selectedOption) {
                selectedSortDesktopLabel.textContent = selectedOption.textContent;
            }
        }
        
        // Mise à jour de l'UI Mobile - AVEC MASQUAGE DE L'OPTION SÉLECTIONNÉE
        sortMobileOptionItems.forEach(opt => {
            const optionSortType = opt.id || opt.getAttribute('data-sort-type');
            
            // Masquer l'option sélectionnée et afficher les autres
            if (optionSortType === sortType) {
                opt.style.display = 'none';  // Masquer l'option sélectionnée
            } else {
                opt.style.display = '';      // Afficher les autres options
            }
            
            // Mettre à jour la classe pour le style
            opt.classList.toggle('selected-sort', optionSortType === sortType);
        });
        
        // Mise à jour du label mobile
        if (selectedSortMobileLabel) {
            const selectedOption = Array.from(sortMobileOptionItems).find(opt => 
                (opt.id || opt.getAttribute('data-sort-type')) === sortType
            );
            if (selectedOption) {
                selectedSortMobileLabel.textContent = selectedOption.textContent;
            }
        }
        
        // Fermer les dropdowns après sélection
        if (source === 'desktop' && sortDesktopOptions) {
            sortDesktopOptions.style.display = 'none';
        } else if (source === 'mobile' && sortMobileOptions) {
            sortMobileOptions.style.display = 'none';
        }
        
        // Rafraîchir l'affichage
        refreshDisplay();
    }
    
    // Configuration du dropdown desktop
    if (sortDesktopButton && sortDesktopOptions) {
        sortDesktopOptions.style.display = 'none';
        
        sortDesktopButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            sortDesktopOptions.style.display = sortDesktopOptions.style.display === 'none' ? 'block' : 'none';
        });
        
        // Fermeture du dropdown si clic ailleurs
        document.addEventListener('click', (e) => {
            if (sortDesktopOptions.style.display !== 'none' && 
                !sortDesktopButton.contains(e.target) && 
                !sortDesktopOptions.contains(e.target)) {
                sortDesktopOptions.style.display = 'none';
            }
        });
    }
    
    // Gestion des options de tri desktop
    sortDesktopOptionItems.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const sortType = option.id || option.getAttribute('data-sort-type');
            handleSortSelection(sortType, 'desktop');
        });
    });
    
    // Configuration du dropdown mobile
    if (sortMobileButton && sortMobileOptions) {
        sortMobileOptions.style.display = 'none';
        
        sortMobileButton.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            sortMobileOptions.style.display = sortMobileOptions.style.display === 'none' ? 'block' : 'none';
        });
        
        // Fermeture du dropdown si clic ailleurs
        document.addEventListener('click', (e) => {
            if (sortMobileOptions.style.display !== 'none' && 
                !sortMobileButton.contains(e.target) && 
                !sortMobileOptions.contains(e.target)) {
                sortMobileOptions.style.display = 'none';
            }
        });
    }
    
    // Gestion des options de tri mobile
    sortMobileOptionItems.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            const sortType = option.id || option.getAttribute('data-sort-type');
            handleSortSelection(sortType, 'mobile');
        });
    });
    
    function refreshDisplay() {
        if (window.filterManager) {
            displayManager.refreshWithFiltersAndSort(window.filterManager, sortManager);
        } else {
            displayManager.refreshWithFiltersAndSort({applyFilters: (offers) => offers}, sortManager);
        }
    }
    
    // Initialisation - utiliser le tri par défaut
    const defaultSortType = sortManager.getCurrentSort() || 'date';
    handleSortSelection(defaultSortType, 'init');
}

