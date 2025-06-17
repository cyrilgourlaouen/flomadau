export function setupModalUI() {
    // Configuration générique pour les modales
    function setupModal(modalSelector, openBtnSelector, closeBtnSelector, options = {}) {
        const modal = document.querySelector(modalSelector);
        const openBtn = document.querySelector(openBtnSelector);
        const closeBtn = document.querySelector(closeBtnSelector);
        
        if (!modal) {
            console.error(`Modal not found: ${modalSelector}`);
            return;
        }
        
        if (openBtn) {
            openBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                
                if (options.onOpen) {
                    options.onOpen(modal);
                }
            });
        }
        
        if (closeBtn) {
            closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                modal.style.display = 'none';
                document.body.style.overflow = '';
                
                if (options.onClose) {
                    options.onClose(modal);
                }
            });
        }
        
        // Fermeture si clic à l'extérieur (optionnel)
        if (options.closeOnOutsideClick !== false) {
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                    
                    if (options.onClose) {
                        options.onClose(modal);
                    }
                }
            });
        }
        
        // Fermeture automatique sur grand écran (optionnel)
        if (options.closeOnLargeScreen !== false) {
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 65 * 16) { // 65rem * 16px
                    if (modal.style.display === 'flex') {
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                        
                        if (options.onClose) {
                            options.onClose(modal);
                        }
                    }
                }
            });
        }
        
        return {
            open: () => {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                if (options.onOpen) options.onOpen(modal);
            },
            close: () => {
                modal.style.display = 'none';
                document.body.style.overflow = '';
                if (options.onClose) options.onClose(modal);
            }
        };
    }
    
    // Configuration de la modale de filtres
    const filterModal = setupModal(
        '.filter-modal', 
        '#offer-search-filter-button', 
        '#filter-close-icon',
        {
            // Options spécifiques si nécessaire
            onOpen: (modal) => {},
            onClose: (modal) => {}
        }
    );
    
    // Exposer les contrôleurs de modales pour une utilisation externe
    window.modals = {
        filterModal
        // Autres modales à ajouter ici
    };
}