import { sortOffers } from './offerSort.js';

document.addEventListener("DOMContentLoaded", () => {
  const offerSection = document.querySelector(".offer-section");
  const offersData = JSON.parse(offerSection.dataset.offers);
  const input = document.getElementById("offer-search-input");
  const offerList = document.querySelector(".offer-list");
  const offerCards = document.querySelectorAll(".offer-card");

  // Tri mobile
  const sortMobileBtn = document.getElementById("offer-sort-mobile-button");
  const sortMobileOptions = document.getElementById("offer-sort-mobile-options");
  const selectedSortMobileLabel = document.getElementById("selected-sort-mobile-label");

  // Tri desktop
  const sortDesktopBtn = document.getElementById("offer-sort-desktop-button");
  const sortDesktopOptions = document.getElementById("offer-sort-desktop-options");
  const selectedSortDesktopLabel = document.getElementById("selected-sort-desktop-label");

  let currentSort = "date"; // Par défaut : Date d'ajout
  let searchTimeout;

  // Utilitaire pour normaliser les chaînes
  const normalizeString = (str) =>
    str
      ? str
          .normalize("NFD")
          .replace(/[\u0300-\u036f]/g, "")
          .toLowerCase()
          .trim()
      : "";

  // Filtre selon la recherche
  function filterOffers(query) {
    return offersData.filter((offer) => {
      const fields = [
        offer.titre,
        offer.resume,
        offer.ville,
        offer.categorie,
        offer.professionnelData?.raison_sociale,
      ];
      return fields.some((field) => normalizeString(field).includes(query));
    });
  }

  // Affiche les offres triées et filtrées
  function displayOffers(offers) {
    offerCards.forEach((card) => (card.style.display = "none"));
    offers.forEach((offer) => {
      const idx = offersData.findIndex((o) => o.id === offer.id);
      if (idx !== -1 && offerCards[idx]) {
        offerCards[idx].style.display = "";
        offerList.appendChild(offerCards[idx]);
      }
    });
  }

  // Applique recherche + tri
  function applyFiltersAndSort() {
    const query = normalizeString(input.value);
    let filtered = query ? filterOffers(query) : [...offersData];
    let sorted = sortOffers(filtered, currentSort);
    displayOffers(sorted);
  }

  // Met à jour le label et masque l'option sélectionnée (mobile)
  function updateSortMobileUI() {
    if (!sortMobileOptions) return;
    sortMobileOptions.querySelectorAll("p").forEach((option) => {
      if (option.id === currentSort) {
        option.classList.add("selected-sort");
        option.style.display = "none";
        selectedSortMobileLabel.textContent = option.textContent;
      } else {
        option.classList.remove("selected-sort");
        option.style.display = "";
      }
    });
  }

  // Met à jour le label et masque l'option sélectionnée (desktop)
  function updateSortDesktopUI() {
    if (!sortDesktopOptions) return;
    sortDesktopOptions.querySelectorAll("p").forEach((option) => {
      if (option.id === currentSort) {
        option.classList.add("selected-sort");
        option.style.display = "none";
        selectedSortDesktopLabel.textContent = option.textContent;
      } else {
        option.classList.remove("selected-sort");
        option.style.display = "";
      }
    });
  }

  // Recherche
  input.addEventListener("input", () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(applyFiltersAndSort, 300);
  });

  // Gestion du tri mobile
  if (sortMobileBtn && sortMobileOptions) {
    sortMobileOptions.style.display = "none";

    sortMobileBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      sortMobileOptions.style.display =
        sortMobileOptions.style.display === "block" ? "none" : "block";
    });

    sortMobileOptions.querySelectorAll("p").forEach((option) => {
      option.addEventListener("click", (e) => {
        e.stopPropagation();
        currentSort = option.id;
        updateSortMobileUI();
        updateSortDesktopUI();
        sortMobileOptions.style.display = "none";
        applyFiltersAndSort();
      });
    });

    // Ferme le menu si on clique à l'extérieur
    document.addEventListener("click", (e) => {
      if (
        sortMobileOptions.style.display === "block" &&
        !sortMobileOptions.contains(e.target) &&
        e.target !== sortMobileBtn
      ) {
        sortMobileOptions.style.display = "none";
      }
    });

    // Initialisation UI tri mobile
    updateSortMobileUI();
  }

  // Gestion du tri desktop
  if (sortDesktopBtn && sortDesktopOptions) {
    sortDesktopOptions.style.display = "none";

    sortDesktopBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      sortDesktopOptions.style.display =
        sortDesktopOptions.style.display === "block" ? "none" : "block";
    });

    sortDesktopOptions.querySelectorAll("p").forEach((option) => {
      option.addEventListener("click", (e) => {
        e.stopPropagation();
        currentSort = option.id;
        updateSortDesktopUI();
        updateSortMobileUI();
        sortDesktopOptions.style.display = "none";
        applyFiltersAndSort();
      });
    });

    // Ferme le menu si on clique à l'extérieur
    document.addEventListener("click", (e) => {
      if (
        sortDesktopOptions.style.display === "block" &&
        !sortDesktopOptions.contains(e.target) &&
        e.target !== sortDesktopBtn
      ) {
        sortDesktopOptions.style.display = "none";
      }
    });

    // Initialisation UI tri desktop
    updateSortDesktopUI();
  }

  // Initialisation
  applyFiltersAndSort();
});