import { filterByCategory } from './categoryFilter.js';
import { filterBySearch } from './searchFilter.js';
// Autres imports...

export function setupFilterManager(initialOffers) {
    
    let filters = {
        search: '',
        category: null,
        // Autres filtres...
    };
    
    const applyFilters = (offers) => {
        let filtered = [...offers];
        
        // Filtre de recherche
        if (filters.search) {
            filtered = filterBySearch(filtered, filters.search);
        }
        
        // Filtre de catégorie
        if (filters.category) {
            filtered = filterByCategory(filtered, filters.category);
        }
        
        // Autres filtres...
        
        return filtered;
    };
    
    return {
        setFilter: (type, value) => {
            filters[type] = value;
        },
        getFilter: (type) => filters[type],
        applyFilters
    };
}