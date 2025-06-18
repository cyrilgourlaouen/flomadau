export function setupOfferDisplay(allOffers) {
    const offerList = document.querySelector('.offer-list');
    
    const getOfferCards = () => document.querySelectorAll('.offer-card');
    
    const displayOffers = (offers) => {
        const offerCards = getOfferCards();
        offerCards.forEach((card) => (card.style.display = "none"));

        offers.forEach((offer) => {
            const offerCard = Array.from(offerCards).find(
                card => card.dataset.offerId == offer.id
            );

            if (offerCard) {
                offerCard.style.display = "";
                offerList.appendChild(offerCard);
            }
        });
    };
    
    return {
        refreshDisplay: (offers) => {
            displayOffers(offers);
        },
        refreshWithFiltersAndSort: (filterManager, sortManager) => {
            const filteredOffers = filterManager.applyFilters(allOffers);
            const sortedOffers = sortManager.sortOffers(filteredOffers);
            displayOffers(sortedOffers);
        }
    };
}