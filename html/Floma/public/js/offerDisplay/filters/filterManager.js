import { filterByCategory } from './categoryFilter.js';
import { filterBySearch } from './searchFilter.js';
import { filterByPrice } from './priceFilter.js';
import { filterByDate } from './dateFilter.js';
import { filterByNote } from './noteFilter.js';
import { filterByStatus } from './statusFilter.js';

export function setupFilterManager(initialOffers) {
  let filters = {
    search: '',
    category: null,
    price: null,
    date: null,
    note: null,
    status: null,
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
      if (filters.category === 'Restaurant') {
        filtered = filtered.filter((offer) => {
          if (!offer.categoryData || !offer.categoryData.gamme_de_prix) {
            return false;
          }

          const offerRange = String(offer.categoryData.gamme_de_prix);
          const filterRange = String(filters.price);

          return offerRange === filterRange;
        });
      } else {
        filtered = filterByPrice(filtered, filters.price);
      }
    }

    // Filtre de date
    if (filters.date) {
      filtered = filterByDate(filtered, filters.date);
    }

    // Filtre de note
    if (filters.note) {
      filtered = filterByNote(filtered, filters.note);
    }

    // Filtre de statut
    if (filters.status) {
      filtered = filterByStatus(filtered, filters.status);
    }

    return filtered;
  };

  return {
    setFilter: (type, value) => {
      filters[type] = value;
    },
    getFilter: (type) => filters[type],
    applyFilters,
  };
}