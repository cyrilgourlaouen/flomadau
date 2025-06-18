import { sortOffers } from './sortFunctions.js';

export function setupSortManager() {
    let currentSort = 'date'; // Valeur par défaut
    
    return {
        setSortType: (type) => {
            currentSort = type;
        },
        getCurrentSort: () => currentSort,
        sortOffers: (offers) => sortOffers(offers, currentSort)
    };
}