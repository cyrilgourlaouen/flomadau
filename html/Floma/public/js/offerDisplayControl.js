import { setupFilterManager } from './offerDisplay/filters/filterManager.js';
import { setupSortManager } from './offerDisplay/sort/sortManager.js';
import { setupFilterUI } from './offerDisplay/ui/filterUI.js';
import { setupSortUI } from './offerDisplay/ui/sortUI.js';
import { setupOfferDisplay } from './offerDisplay/display/offerDisplay.js';
import { setupModalUI } from './offerDisplay/ui/modalUI.js';

document.addEventListener('DOMContentLoaded', () => {
  // Récupération des données
  const offerSection = document.querySelector('.offer-section');
  const offersData = JSON.parse(offerSection.dataset.offers);

  // Initialisation du gestionnaire d'affichage
  const displayManager = setupOfferDisplay(offersData);

  // Initialisation du gestionnaire de filtres
  const filterManager = setupFilterManager(offersData);

  // Initialisation du gestionnaire de tri
  const sortManager = setupSortManager();

  // Configuration des UI
  setupFilterUI(filterManager, displayManager);
  setupSortUI(sortManager, displayManager);
  setupModalUI();

  // Affichage initial
  displayManager.refreshDisplay(offersData);
});
