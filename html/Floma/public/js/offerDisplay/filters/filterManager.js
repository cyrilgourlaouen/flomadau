import { filterByCategory } from './categoryFilter.js';
import { filterBySearch } from './searchFilter.js';
import { filterByPrice } from './priceFilter.js';

export function setupFilterManager(initialOffers) {
    
    let filters = {
        search: '',
        category: null,
        price: null,
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
        
        // Filtre de prix
        if (filters.price) {
            filtered = filterByPrice(filtered, filters.price);
        }
        
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