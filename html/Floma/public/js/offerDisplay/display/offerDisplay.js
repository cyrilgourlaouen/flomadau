export function setupOfferDisplay(initialOffers) {
  const noOffersMessage = document.querySelector('.no-offers-message');
  const offerList = document.querySelector('.offer-list');
  
  const refreshDisplay = (offers) => {
    // Masquer tous les éléments d'offre existants
    const allOfferCards = document.querySelectorAll('.offer-card');
    allOfferCards.forEach(card => {
      card.style.display = 'none';
    });

    // Afficher les offres correspondantes
    offers.forEach(offer => {
      const offerCard = document.querySelector(`[data-offer-id="${offer.id}"]`);
      if (offerCard) {
        offerCard.style.display = 'flex';
      }
    });

    // Gérer l'affichage du message "aucune offre" et de la liste
    if (offers.length === 0) {
      noOffersMessage.style.display = 'block';
      offerList.style.display = 'none';
    } else {
      noOffersMessage.style.display = 'none';
      offerList.style.display = 'grid';
    }
  };

  const refreshWithFiltersAndSort = (filterManager, sortManager) => {
    // Appliquer les filtres
    let filteredOffers = filterManager.applyFilters(initialOffers);
    
    // Appliquer le tri
    if (sortManager && sortManager.sortOffers) {
      filteredOffers = sortManager.sortOffers(filteredOffers);
    }
    
    // Rafraîchir l'affichage
    refreshDisplay(filteredOffers);
  };

  // Affichage initial
  refreshDisplay(initialOffers);

  return {
    refreshDisplay,
    refreshWithFiltersAndSort
  };
}