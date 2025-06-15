document.addEventListener('DOMContentLoaded', () => {
    const sortButton = document.getElementById('offer-search-sort-mobile-button');
    const sortDropdown = document.querySelector('.offer-search-sort-mobile div');
    const selectedLabel = document.getElementById('selected-sort-label');
    const sortOptions = document.querySelectorAll('.offer-search-sort-mobile div p');
    
    // Initialise le texte par défaut (l'option sélectionnée)
    const defaultSelected = document.querySelector('.selected-sort');
    if (defaultSelected) {
        selectedLabel.textContent = defaultSelected.textContent;
        defaultSelected.style.display = 'none'; // Cache l'option sélectionnée
    }
    
    // Cache le dropdown par défaut
    sortDropdown.style.display = 'none';
    
    // Toggle dropdown au clic sur le bouton
    sortButton.addEventListener('click', (e) => {
        e.preventDefault();
        
        if (sortDropdown.style.display === 'none') {
            sortDropdown.style.display = 'flex';
        } else {
            sortDropdown.style.display = 'none';
        }
    });
    
    // Sélection d'une option
    sortOptions.forEach(option => {
        option.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Affiche toutes les options
            sortOptions.forEach(opt => {
                opt.classList.remove('selected-sort');
                opt.style.display = ''; // Affiche toutes les options
            });
            
            // Ajoute la classe 'selected-sort' à l'option cliquée
            option.classList.add('selected-sort');
            option.style.display = 'none'; // Cache l'option sélectionnée
            
            // Met à jour le texte du span
            selectedLabel.textContent = option.textContent;
            
            // Ferme le dropdown
            sortDropdown.style.display = 'none';
            
            // Applique le tri (optionnel)
            applySorting(option.id);
        });
    });
    
    // Ferme le dropdown si on clique ailleurs
    document.addEventListener('click', (e) => {
        if (!sortButton.contains(e.target) && !sortDropdown.contains(e.target)) {
            sortDropdown.style.display = 'none';
        }
    });
    
    // Fonction pour appliquer le tri (à personnaliser)
    function applySorting(sortType) {
        console.log('Tri appliqué:', sortType);
        // Ici tu peux ajouter ta logique de tri
    }
});