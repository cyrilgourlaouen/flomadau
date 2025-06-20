export function setupFilterUI(filterManager, displayManager) {
  // Accessibilité globale
  window.filterManager = filterManager;

  // --- VARIABLES GLOBALES ---
  // Texte
  const searchInput = document.getElementById("offer-search-input");

  // Catégorie desktop
  const categoryDropdownButton = document.querySelector(
    "#desktop-categorie-button"
  );
  const categoryDropdownOptions = document.querySelector(
    "#desktop-categorie-options"
  );
  const desktopCategoryOptions = document.querySelectorAll(
    "#desktop-categorie-options .desktop-filter-option"
  );
  const selectedCategoryLabel = document.getElementById(
    "selected-category-label"
  );

  // Catégorie mobile/modal
  const modalCategoryOptions = document.querySelectorAll(
    ".filter-modal-category-option"
  );

  // Prix modal/mobile
  const minPriceInput = document.getElementById("min-price");
  const maxPriceInput = document.getElementById("max-price");
  const priceInputOptions = document.querySelector(
    ".filter-modal-price-options"
  );
  const priceRangeOptions = document.querySelector(
    ".filter-modal-price-range-options"
  );
  const priceRangeOptionItems = document.querySelectorAll(
    ".filter-modal-price-range-option"
  );

  // Prix desktop
  const priceDropdownButton = document.querySelector(
    "#offer-price-desktop-button"
  );
  const priceDropdownOptions = document.querySelector("#desktop-price-options");
  const selectedPriceLabel = document.getElementById("selected-price-label");
  const minDesktopPriceInput = document.getElementById("min-price-desktop");
  const maxDesktopPriceInput = document.getElementById("max-price-desktop");

  // Gammes de prix desktop
  const desktopPriceRangeOptions = document.querySelector(
    "#desktop-price-range-options"
  );
  const desktopPriceRangeItems = document.querySelectorAll(
    "#desktop-price-range-options .desktop-price-range-option"
  );

  // Date modal/mobile
  const startDateInput = document.getElementById("start-date");
  const endDateInput = document.getElementById("end-date");

  // Date desktop
  const dateDropdownButton = document.querySelector(
    "#offer-date-desktop-button"
  );
  const dateDropdownOptions = document.querySelector("#desktop-date-options");
  const selectedDateLabel = document.getElementById("selected-date-label");
  const startDesktopDateInput = document.getElementById("desktop-start-date");
  const endDesktopDateInput = document.getElementById("desktop-end-date");

  // Note modal/mobile
  const noteStars = document.querySelectorAll(
    ".filter-modal-note-options img[data-star-value]"
  );

  // Note desktop
  const noteDropdownButton = document.querySelector("#desktop-note-button");
  const noteDropdownOptions = document.querySelector("#desktop-note-options");
  const selectedNoteLabel = document.getElementById("selected-note-label");
  const desktopNoteStars = document.querySelectorAll(
    "#desktop-note-options img[data-star-value]"
  );

  // Statut modal/mobile
  const modalStatusOptions = document.querySelectorAll(
    ".filter-modal-status-option"
  );

  // Statut desktop
  const statusDropdownButton = document.querySelector("#desktop-status-button");
  const statusDropdownOptions = document.querySelector(
    "#desktop-status-options"
  );
  const selectedStatusLabel = document.getElementById("selected-status-label");
  const desktopStatusOptions = document.querySelectorAll(
    "#desktop-status-options p"
  );

  // Tri
  const sortDropdownOptions = document.querySelector(
    "#offer-sort-desktop-options"
  );
  const sortDropdownButton = document.querySelector(
    "#offer-sort-desktop-button"
  );

  // --- FONCTIONS DE GESTION DES DROPDOWNS ---

  function closeAllDropdowns() {
    if (categoryDropdownOptions) {
      categoryDropdownOptions.style.display = "none";
    }
    if (priceDropdownOptions) {
      priceDropdownOptions.style.display = "none";
    }
    if (desktopPriceRangeOptions) {
      desktopPriceRangeOptions.style.display = "none";
    }
    if (dateDropdownOptions) {
      dateDropdownOptions.style.display = "none";
    }
    if (noteDropdownOptions) {
      noteDropdownOptions.style.display = "none";
    }
    if (statusDropdownOptions) {
      statusDropdownOptions.style.display = "none";
    }
    if (sortDropdownOptions) {
      sortDropdownOptions.style.display = "none";
    }
  }

  function closeAllDropdownsExcept(exceptElement) {
    if (categoryDropdownOptions && categoryDropdownOptions !== exceptElement) {
      categoryDropdownOptions.style.display = "none";
    }
    if (priceDropdownOptions && priceDropdownOptions !== exceptElement) {
      priceDropdownOptions.style.display = "none";
    }
    if (
      desktopPriceRangeOptions &&
      desktopPriceRangeOptions !== exceptElement
    ) {
      desktopPriceRangeOptions.style.display = "none";
    }
    if (dateDropdownOptions && dateDropdownOptions !== exceptElement) {
      dateDropdownOptions.style.display = "none";
    }
    if (noteDropdownOptions && noteDropdownOptions !== exceptElement) {
      noteDropdownOptions.style.display = "none";
    }
    if (statusDropdownOptions && statusDropdownOptions !== exceptElement) {
      statusDropdownOptions.style.display = "none";
    }
    if (sortDropdownOptions && sortDropdownOptions !== exceptElement) {
      sortDropdownOptions.style.display = "none";
    }
  }

  function toggleCategoryDropdown() {
    const isVisible =
      categoryDropdownOptions &&
      categoryDropdownOptions.style.display === "block";

    // Fermer tous les autres dropdowns sauf celui-ci
    closeAllDropdownsExcept(categoryDropdownOptions);

    // Toggle le dropdown de catégorie
    if (categoryDropdownOptions) {
      categoryDropdownOptions.style.display = isVisible ? "none" : "block";
    }
  }

  function togglePriceDropdown() {
    const currentCategory = filterManager.getFilter("category");

    if (currentCategory === "Restaurant") {
      // Pour Restaurant : afficher les gammes de prix
      const isVisible =
        desktopPriceRangeOptions &&
        desktopPriceRangeOptions.style.display === "block";

      // Fermer tous les autres dropdowns sauf celui-ci
      closeAllDropdownsExcept(desktopPriceRangeOptions);

      if (desktopPriceRangeOptions) {
        desktopPriceRangeOptions.style.display = isVisible ? "none" : "block";
      }
    } else {
      // Pour les autres catégories : afficher les inputs min/max
      const isVisible =
        priceDropdownOptions && priceDropdownOptions.style.display === "flex";

      // Fermer tous les autres dropdowns sauf celui-ci
      closeAllDropdownsExcept(priceDropdownOptions);

      if (priceDropdownOptions) {
        priceDropdownOptions.style.display = isVisible ? "none" : "flex";
      }
    }
  }

  function toggleDateDropdown() {
    const isVisible =
      dateDropdownOptions && dateDropdownOptions.style.display === "flex";

    // Fermer tous les autres dropdowns sauf celui-ci
    closeAllDropdownsExcept(dateDropdownOptions);

    if (dateDropdownOptions) {
      dateDropdownOptions.style.display = isVisible ? "none" : "flex";
    }
  }

  function toggleNoteDropdown() {
    const isVisible =
      noteDropdownOptions && noteDropdownOptions.style.display === "flex";

    // Fermer tous les autres dropdowns sauf celui-ci
    closeAllDropdownsExcept(noteDropdownOptions);

    if (noteDropdownOptions) {
      noteDropdownOptions.style.display = isVisible ? "none" : "flex";
    }
  }

  function toggleStatusDropdown() {
    const isVisible =
      statusDropdownOptions && statusDropdownOptions.style.display === "block";

    // Fermer tous les autres dropdowns sauf celui-ci
    closeAllDropdownsExcept(statusDropdownOptions);

    if (statusDropdownOptions) {
      statusDropdownOptions.style.display = isVisible ? "none" : "block";
    }
  }

  // --- FONCTIONS ---

  function debounce(fn, delay) {
    let timeoutId;
    return function (...args) {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
  }

  // Fonction pour gérer la sélection d'une gamme de prix (mobile et desktop)
  function handlePriceRangeSelection(rangeValue, isFromDesktop = false) {
    const currentFilter = filterManager.getFilter("price");
    const isCurrentlySelected = currentFilter === rangeValue;

    if (isCurrentlySelected) {
      // Désélectionner
      filterManager.setFilter("price", null);

      // Réinitialiser les sélections visuelles
      priceRangeOptionItems.forEach((option) => {
        option.classList.remove("selected-price-range");
      });
      desktopPriceRangeItems.forEach((option) => {
        option.classList.remove("selected-price-range-desktop");
      });

      if (selectedPriceLabel) selectedPriceLabel.textContent = "";
    } else {
      // Sélectionner
      filterManager.setFilter("price", rangeValue);

      // Synchroniser les sélections visuelles
      syncPriceRangeSelections(rangeValue);

      // Mettre à jour le label
      updatePriceRangeLabel(rangeValue);
    }

    // Fermer le dropdown desktop si la sélection vient du desktop
    if (isFromDesktop && desktopPriceRangeOptions) {
      desktopPriceRangeOptions.style.display = "none";
    }

    refreshDisplay();
  }

  // Synchroniser les sélections de gamme de prix entre mobile et desktop
  function syncPriceRangeSelections(rangeValue) {
    // Désélectionner tout d'abord
    priceRangeOptionItems.forEach((option) => {
      option.classList.remove("selected-price-range");
    });
    desktopPriceRangeItems.forEach((option) => {
      option.classList.remove("selected-price-range-desktop");
    });

    if (rangeValue) {
      // Sélectionner la bonne option mobile
      priceRangeOptionItems.forEach((option) => {
        if (option.getAttribute("data-price-range") === rangeValue) {
          option.classList.add("selected-price-range");
        }
      });

      // Sélectionner la bonne option desktop
      desktopPriceRangeItems.forEach((option) => {
        if (option.getAttribute("data-price-range") === rangeValue) {
          option.classList.add("selected-price-range-desktop");
        }
      });
    }
  }

  // Mettre à jour le label de prix pour les gammes
  function updatePriceRangeLabel(rangeValue) {
    if (!selectedPriceLabel) return;

    let rangeText = "";
    switch (rangeValue) {
      case "1":
        rangeText = ": < 25€";
        break;
      case "2":
        rangeText = ": 25-40€";
        break;
      case "3":
        rangeText = ": > 40€";
        break;
    }
    selectedPriceLabel.textContent = rangeText;
  }

  function updateSelectedPriceLabel(min, max) {
    const minValid = min !== undefined && min !== "" && !isNaN(Number(min));
    const maxValid = max !== undefined && max !== "" && !isNaN(Number(max));

    if (!minValid && !maxValid) {
      if (selectedPriceLabel) selectedPriceLabel.textContent = "";
    } else if (minValid && maxValid) {
      if (selectedPriceLabel)
        selectedPriceLabel.textContent = `: ${Number(min)} - ${Number(max)}`;
    } else if (minValid) {
      if (selectedPriceLabel)
        selectedPriceLabel.textContent = `: ${Number(min)} min`;
    } else if (maxValid) {
      if (selectedPriceLabel)
        selectedPriceLabel.textContent = `: ${Number(max)} max`;
    }

    // Synchroniser les inputs
    if (minDesktopPriceInput) {
      minDesktopPriceInput.value = minValid ? Number(min) : "";
    }
    if (maxDesktopPriceInput) {
      maxDesktopPriceInput.value = maxValid ? Number(max) : "";
    }
    if (minPriceInput) {
      minPriceInput.value = minValid ? Number(min) : "";
    }
    if (maxPriceInput) {
      maxPriceInput.value = maxValid ? Number(max) : "";
    }
  }

  function updateSelectedDateLabel(startDate, endDate) {
    const startValid = startDate && !isNaN(new Date(startDate));
    const endValid = endDate && !isNaN(new Date(endDate));

    if (!startValid && !endValid) {
      if (selectedDateLabel) selectedDateLabel.textContent = "";
    } else if (startValid && endValid) {
      const start = new Date(startDate).toLocaleDateString("fr-FR");
      const end = new Date(endDate).toLocaleDateString("fr-FR");
      if (selectedDateLabel)
        selectedDateLabel.textContent = `: ${start} - ${end}`;
    } else if (startValid) {
      const start = new Date(startDate).toLocaleDateString("fr-FR");
      if (selectedDateLabel) selectedDateLabel.textContent = `: < ${start}`;
    } else if (endValid) {
      const end = new Date(endDate).toLocaleDateString("fr-FR");
      if (selectedDateLabel) selectedDateLabel.textContent = `: > ${end}`;
    }

    // Synchroniser les inputs
    if (startDesktopDateInput) {
      startDesktopDateInput.value = startValid ? startDate : "";
    }
    if (endDesktopDateInput) {
      endDesktopDateInput.value = endValid ? endDate : "";
    }
    if (startDateInput) {
      startDateInput.value = startValid ? startDate : "";
    }
    if (endDateInput) {
      endDateInput.value = endValid ? endDate : "";
    }
  }

  function resetPriceFilter() {
    filterManager.setFilter("price", null);

    // Reset des inputs
    if (minPriceInput) minPriceInput.value = "";
    if (maxPriceInput) maxPriceInput.value = "";
    if (minDesktopPriceInput) minDesktopPriceInput.value = "";
    if (maxDesktopPriceInput) maxDesktopPriceInput.value = "";

    // Reset du label
    if (selectedPriceLabel) selectedPriceLabel.textContent = "";

    // Reset des gammes de prix sélectionnées (mobile et desktop)
    priceRangeOptionItems.forEach((option) => {
      option.classList.remove("selected-price-range");
    });
    desktopPriceRangeItems.forEach((option) => {
      option.classList.remove("selected-price-range-desktop");
    });

    // Reset des classes d'erreur
    [
      minPriceInput,
      maxPriceInput,
      minDesktopPriceInput,
      maxDesktopPriceInput,
    ].forEach((input) => {
      if (input?.parentElement) {
        input.parentElement.classList.remove(
          "filter-modal-price-icon-wrapper-error"
        );
      }
    });
  }

  function resetDateFilter() {
    filterManager.setFilter("date", null);

    // Reset des inputs
    if (startDateInput) startDateInput.value = "";
    if (endDateInput) endDateInput.value = "";
    if (startDesktopDateInput) startDesktopDateInput.value = "";
    if (endDesktopDateInput) endDesktopDateInput.value = "";

    // Reset du label
    if (selectedDateLabel) selectedDateLabel.textContent = "";

    // Reset des classes d'erreur
    if (startDateInput) startDateInput.classList.remove("date-error");
    if (endDateInput) endDateInput.classList.remove("date-error");
    if (startDesktopDateInput)
      startDesktopDateInput.classList.remove("date-error");
    if (endDesktopDateInput) endDesktopDateInput.classList.remove("date-error");
  }

  // Mettre à jour l'affichage des options de prix selon la catégorie
  function updatePriceFilterDisplay(category) {
    const isRestaurant = category === "Restaurant";

    // Mobile
    if (priceInputOptions && priceRangeOptions) {
      if (isRestaurant) {
        priceInputOptions.style.display = "none";
        priceRangeOptions.style.display = "flex";
      } else {
        priceInputOptions.style.display = "flex";
        priceRangeOptions.style.display = "none";
      }
    }

    // Desktop - Pas d'affichage automatique, juste préparation
    // Les dropdowns s'ouvriront via togglePriceDropdown() selon la catégorie
  }

  function validatePriceRange(min, max) {
    if (
      (min === undefined || min === "") &&
      (max === undefined || max === "")
    ) {
      return { valid: false, min: undefined, max: undefined, reason: "empty" };
    }
    if (
      (min !== undefined && min !== "" && isNaN(min)) ||
      (max !== undefined && max !== "" && isNaN(max))
    ) {
      return {
        valid: false,
        min: undefined,
        max: undefined,
        reason: "not_a_number",
      };
    }
    if (
      min !== undefined &&
      min !== "" &&
      max !== undefined &&
      max !== "" &&
      Number(max) < Number(min)
    ) {
      return {
        valid: false,
        min: undefined,
        max: undefined,
        reason: "max_lt_min",
      };
    }
    return {
      valid: true,
      min: min !== "" ? Number(min) : undefined,
      max: max !== "" ? Number(max) : undefined,
    };
  }

  function validateDateRange(startDate, endDate) {
    if (!startDate && !endDate) {
      return {
        valid: false,
        startDate: undefined,
        endDate: undefined,
        reason: "empty",
      };
    }

    const start = startDate ? new Date(startDate) : null;
    const end = endDate ? new Date(endDate) : null;

    if ((startDate && isNaN(start)) || (endDate && isNaN(end))) {
      return {
        valid: false,
        startDate: undefined,
        endDate: undefined,
        reason: "invalid_date",
      };
    }

    if (start && end && end < start) {
      return {
        valid: false,
        startDate: undefined,
        endDate: undefined,
        reason: "end_before_start",
      };
    }

    return {
      valid: true,
      startDate: start,
      endDate: end,
    };
  }

  function handleDesktopPriceChange() {
    const min = minDesktopPriceInput?.value || undefined;
    const max = maxDesktopPriceInput?.value || undefined;
    const validation = validatePriceRange(min, max);

    // Réinitialiser les gammes de prix sélectionnées car on utilise les inputs
    syncPriceRangeSelections(null);

    minDesktopPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );
    maxDesktopPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );

    if (!validation.valid && validation.reason !== "empty") {
      if (min !== undefined && min !== "" && isNaN(min))
        minDesktopPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      if (max !== undefined && max !== "" && isNaN(max))
        maxDesktopPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      if (validation.reason === "max_lt_min") {
        minDesktopPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
        maxDesktopPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      }
      // Si les prix ne sont pas valides, ne pas appliquer le filtre
      filterManager.setFilter("price", null);
      updateSelectedPriceLabel("", "");
      refreshDisplay();
      return;
    }

    // Si les deux champs sont vides, réinitialiser le filtre
    if (validation.reason === "empty") {
      filterManager.setFilter("price", null);
      updateSelectedPriceLabel("", "");
    } else {
      // Appliquer le filtre avec les valeurs valides
      filterManager.setFilter("price", {
        min: validation.min,
        max: validation.max,
      });
      updateSelectedPriceLabel(validation.min, validation.max);
    }

    refreshDisplay();
  }

  function handlePriceChange() {
    const min = minPriceInput?.value || undefined;
    const max = maxPriceInput?.value || undefined;
    const validation = validatePriceRange(min, max);

    // Réinitialiser les gammes de prix sélectionnées car on utilise les inputs
    syncPriceRangeSelections(null);

    minPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );
    maxPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );

    if (!validation.valid && validation.reason !== "empty") {
      if (min !== undefined && min !== "" && isNaN(min))
        minPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      if (max !== undefined && max !== "" && isNaN(max))
        maxPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      if (validation.reason === "max_lt_min") {
        minPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
        maxPriceInput?.parentElement.classList.add(
          "filter-modal-price-icon-wrapper-error"
        );
      }
      // Si les prix ne sont pas valides, ne pas appliquer le filtre
      filterManager.setFilter("price", null);
      updateSelectedPriceLabel("", "");
      refreshDisplay();
      return;
    }

    // Si les deux champs sont vides, réinitialiser le filtre
    if (validation.reason === "empty") {
      filterManager.setFilter("price", null);
      updateSelectedPriceLabel("", "");
    } else {
      // Appliquer le filtre avec les valeurs valides
      filterManager.setFilter("price", {
        min: validation.min,
        max: validation.max,
      });
      updateSelectedPriceLabel(validation.min, validation.max);
    }

    refreshDisplay();
  }

  function handleDateChange() {
    const startDate = startDateInput?.value || undefined;
    const endDate = endDateInput?.value || undefined;
    const validation = validateDateRange(startDate, endDate);

    // Reset des classes d'erreur
    if (startDateInput) startDateInput.classList.remove("date-error");
    if (endDateInput) endDateInput.classList.remove("date-error");

    if (!validation.valid) {
      if (validation.reason === "end_before_start") {
        if (startDateInput) startDateInput.classList.add("date-error");
        if (endDateInput) endDateInput.classList.add("date-error");
      }
      if (selectedDateLabel) selectedDateLabel.textContent = "";
      // Si les dates ne sont pas valides, on ignore le filtre (affiche toutes les offres)
      filterManager.setFilter("date", null);
      refreshDisplay();
      return;
    }

    if (validation.reason === "empty") {
      filterManager.setFilter("date", null);
      updateSelectedDateLabel(undefined, undefined);
    } else {
      filterManager.setFilter("date", {
        startDate: validation.startDate,
        endDate: validation.endDate,
      });
      updateSelectedDateLabel(startDate, endDate);
    }

    refreshDisplay();
  }

  function handleDesktopDateChange() {
    const startDate = startDesktopDateInput?.value || undefined;
    const endDate = endDesktopDateInput?.value || undefined;
    const validation = validateDateRange(startDate, endDate);

    // Reset des classes d'erreur
    if (startDesktopDateInput) startDesktopDateInput.classList.remove("date-error");
    if (endDesktopDateInput) endDesktopDateInput.classList.remove("date-error");

    if (!validation.valid) {
      if (validation.reason === "end_before_start") {
        if (startDesktopDateInput) startDesktopDateInput.classList.add("date-error");
        if (endDesktopDateInput) endDesktopDateInput.classList.add("date-error");
      }
      if (selectedDateLabel) selectedDateLabel.textContent = "";
      // Si les dates ne sont pas valides, on ignore le filtre (affiche toutes les offres)
      filterManager.setFilter("date", null);
      refreshDisplay();
      return;
    }

    if (validation.reason === "empty") {
      filterManager.setFilter("date", null);
      updateSelectedDateLabel(undefined, undefined);
    } else {
      filterManager.setFilter("date", {
        startDate: validation.startDate,
        endDate: validation.endDate,
      });
      updateSelectedDateLabel(startDate, endDate);
    }

    refreshDisplay();
  }

  // Fonction pour gérer la sélection des étoiles (mobile et desktop)
  function handleStarSelection(selectedValue, isFromDesktop = false) {
    const currentNote = filterManager.getFilter("note");

    // Si on clique sur la même note, on désélectionne
    if (currentNote === selectedValue) {
      filterManager.setFilter("note", null);
      updateStarDisplay(0);
      updateSelectedNoteLabel(null);
    } else {
      filterManager.setFilter("note", selectedValue);
      updateStarDisplay(selectedValue);
      updateSelectedNoteLabel(selectedValue);
    }

    // Fermer le dropdown desktop si la sélection vient du desktop
    if (isFromDesktop && noteDropdownOptions) {
      noteDropdownOptions.style.display = "none";
    }

    refreshDisplay();
  }

  // Fonction pour mettre à jour l'affichage des étoiles (mobile et desktop)
  function updateStarDisplay(selectedNote) {
    // Mettre à jour les étoiles mobiles
    noteStars.forEach((star, index) => {
      const starValue = index + 1;
      const starImg = star;

      if (selectedNote === 0) {
        // Aucune sélection - toutes les étoiles en outline
        starImg.src = "/assets/icons/star_outline_pink.svg";
      } else if (starValue <= Math.floor(selectedNote)) {
        // Étoiles pleines
        starImg.src = "/assets/icons/star_pink.svg";
      } else if (
        starValue === Math.ceil(selectedNote) &&
        selectedNote % 1 !== 0
      ) {
        // Demi-étoile
        starImg.src = "/assets/icons/star_half_pink.svg";
      } else {
        // Étoiles vides
        starImg.src = "/assets/icons/star_outline_pink.svg";
      }
    });

    // Mettre à jour les étoiles desktop
    desktopNoteStars.forEach((star, index) => {
      const starValue = index + 1;
      const starImg = star;

      if (selectedNote === 0) {
        // Aucune sélection - toutes les étoiles en outline
        starImg.src = "/assets/icons/star_outline_pink.svg";
      } else if (starValue <= Math.floor(selectedNote)) {
        // Étoiles pleines
        starImg.src = "/assets/icons/star_pink.svg";
      } else if (
        starValue === Math.ceil(selectedNote) &&
        selectedNote % 1 !== 0
      ) {
        // Demi-étoile
        starImg.src = "/assets/icons/star_half_pink.svg";
      } else {
        // Étoiles vides
        starImg.src = "/assets/icons/star_outline_pink.svg";
      }
    });
  }

  // Fonction pour gérer le survol des étoiles
  function handleStarHover(hoveredValue, isDesktop = false) {
    const starsToUpdate = isDesktop ? desktopNoteStars : noteStars;

    starsToUpdate.forEach((star, index) => {
      const starValue = index + 1;
      const starImg = star;

      if (starValue <= hoveredValue) {
        starImg.src = "/assets/icons/star_pink.svg";
      } else {
        starImg.src = "/assets/icons/star_outline_pink.svg";
      }
    });
  }

  // Fonction pour restaurer l'affichage après le survol
  function restoreStarDisplay() {
    const currentNote = filterManager.getFilter("note") || 0;
    updateStarDisplay(currentNote);
  }

  // Fonction pour mettre à jour le label de note
  function updateSelectedNoteLabel(noteValue) {
    if (!selectedNoteLabel) return;

    if (!noteValue || noteValue === 0) {
      selectedNoteLabel.textContent = "";
    } else {
      const starText = noteValue === 1 ? "étoile" : "étoiles";
      selectedNoteLabel.textContent = `: ≥ ${noteValue} ${starText}`;
    }
  }

  function handleStatusSelection(status, isFromDesktop = true) {
    const isCurrentlySelected = filterManager.getFilter("status") === status;

    filterManager.setFilter("status", isCurrentlySelected ? null : status);
    const selectedStatus = isCurrentlySelected ? null : status;

    // Synchroniser les sélections de statut entre desktop et mobile
    desktopStatusOptions.forEach((opt) => {
      opt.classList.remove("selected-status-desktop");
      if (
        !isCurrentlySelected &&
        opt.getAttribute("data-status-value") === status
      ) {
        opt.classList.add("selected-status-desktop");
      }
    });

    modalStatusOptions.forEach((opt) => {
      opt.classList.remove("selected-status");
      if (
        !isCurrentlySelected &&
        opt.getAttribute("data-status-value") === status
      ) {
        opt.classList.add("selected-status");
      }
    });

    // Mettre à jour le label
    if (selectedStatusLabel) {
      let statusText = "";
      if (!isCurrentlySelected && status) {
        statusText = status === "open" ? ": Ouvert" : ": Fermé";
      }
      selectedStatusLabel.textContent = statusText;
    }

    // Fermer le dropdown desktop si la sélection vient du desktop
    if (isFromDesktop && statusDropdownOptions) {
      statusDropdownOptions.style.display = "none";
    }

    refreshDisplay();
  }

  // --- FONCTION CATÉGORIE ---
  function handleCategorySelection(category, isFromDesktop = true) {
    const isCurrentlySelected =
      filterManager.getFilter("category") === category;
    const previousCategory = filterManager.getFilter("category");

    // RESET UNIQUEMENT lors du passage Restaurant ↔ autre catégorie
    if (
      !isCurrentlySelected &&
      previousCategory &&
      previousCategory !== category
    ) {
      const wasRestaurant = previousCategory === "Restaurant";
      const isRestaurant = category === "Restaurant";

      // Reset seulement si on change entre Restaurant et non-Restaurant
      if (wasRestaurant !== isRestaurant) {
        resetPriceFilter();

        // Fermer tous les dropdowns prix lors de ce type de transition
        closeAllDropdowns();
      }
    }

    // Reset si on désélectionne Restaurant pour aller vers "aucune catégorie"
    if (isCurrentlySelected && previousCategory === "Restaurant") {
      resetPriceFilter();
      closeAllDropdowns();
    }

    filterManager.setFilter("category", isCurrentlySelected ? null : category);
    const selectedCategory = isCurrentlySelected ? null : category;
    updatePriceFilterDisplay(selectedCategory);

    // Synchroniser les sélections de catégorie entre desktop et mobile
    desktopCategoryOptions.forEach((opt) => {
      opt.classList.remove("selected-category-desktop");
      if (!isCurrentlySelected && opt.dataset.category === category) {
        opt.classList.add("selected-category-desktop");
      }
    });

    modalCategoryOptions.forEach((opt) => {
      opt.classList.remove("selected-category");
      if (!isCurrentlySelected && opt.dataset.category === category) {
        opt.classList.add("selected-category");
      }
    });

    if (selectedCategoryLabel) {
      selectedCategoryLabel.textContent =
        !isCurrentlySelected && category ? `: ${category}` : "";
    }

    refreshDisplay();
  }

  // --- LISTENERS ---

  // Texte
  if (searchInput) {
    searchInput.addEventListener("input", (e) => {
      filterManager.setFilter("search", e.target.value);
      refreshDisplay();
    });
  }

  // Gammes de prix mobile
  if (priceRangeOptionItems && priceRangeOptionItems.length > 0) {
    priceRangeOptionItems.forEach((option) => {
      option.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const rangeValue = option.getAttribute("data-price-range");
        handlePriceRangeSelection(rangeValue, false);
      });
    });
  }

  // Gammes de prix desktop
  if (desktopPriceRangeItems && desktopPriceRangeItems.length > 0) {
    desktopPriceRangeItems.forEach((option) => {
      option.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const rangeValue = option.getAttribute("data-price-range");
        handlePriceRangeSelection(rangeValue, true);
      });
    });
  }

  // Catégorie desktop
  if (categoryDropdownButton) {
    categoryDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleCategoryDropdown();
    });
  }

  // Catégorie desktop options
  desktopCategoryOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const category = option.dataset.category;
      handleCategorySelection(category, true);
      closeAllDropdowns();
    });
  });

  // Catégorie mobile/modal options
  modalCategoryOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const category = option.dataset.category;
      handleCategorySelection(category, false);
    });
  });

  // Prix modal/mobile inputs
  const debouncedHandlePriceChange = debounce(handlePriceChange, 500);
  if (minPriceInput)
    minPriceInput.addEventListener("input", debouncedHandlePriceChange);
  if (maxPriceInput)
    maxPriceInput.addEventListener("input", debouncedHandlePriceChange);

  // Prix desktop inputs
  const debouncedHandleDesktopPriceChange = debounce(
    handleDesktopPriceChange,
    500
  );
  if (minDesktopPriceInput)
    minDesktopPriceInput.addEventListener(
      "input",
      debouncedHandleDesktopPriceChange
    );
  if (maxDesktopPriceInput)
    maxDesktopPriceInput.addEventListener(
      "input",
      debouncedHandleDesktopPriceChange
    );

  // Date modal/mobile inputs
  const debouncedHandleDateChange = debounce(handleDateChange, 500);
  if (startDateInput)
    startDateInput.addEventListener("input", debouncedHandleDateChange);
  if (endDateInput)
    endDateInput.addEventListener("input", debouncedHandleDateChange);

  // Date desktop inputs
  const debouncedHandleDesktopDateChange = debounce(
    handleDesktopDateChange,
    500
  );
  if (startDesktopDateInput)
    startDesktopDateInput.addEventListener(
      "input",
      debouncedHandleDesktopDateChange
    );
  if (endDesktopDateInput)
    endDesktopDateInput.addEventListener(
      "input",
      debouncedHandleDesktopDateChange
    );

  // Toggle du dropdown prix desktop
  if (priceDropdownButton) {
    priceDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      togglePriceDropdown();
    });
  }

  // Toggle du dropdown date desktop
  if (dateDropdownButton) {
    dateDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleDateDropdown();
    });
  }

  // Toggle du dropdown note desktop
  if (noteDropdownButton) {
    noteDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleNoteDropdown();
    });
  }

  // Statut desktop
  if (statusDropdownButton) {
    statusDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleStatusDropdown();
    });
  }

  // Statut desktop options
  desktopStatusOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const status = option.getAttribute("data-status-value");
      handleStatusSelection(status, true);
    });
  });

  // Statut mobile/modal options
  modalStatusOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const status = option.getAttribute("data-status-value");
      handleStatusSelection(status, false);
    });
  });

  // Gestion des étoiles pour le filtre de note (mobile)
  if (noteStars && noteStars.length > 0) {
    noteStars.forEach((star, index) => {
      const starValue = index + 1;

      // Gestion du clic
      star.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        handleStarSelection(starValue, false);
      });

      // Gestion du survol
      star.addEventListener("mouseenter", () => {
        handleStarHover(starValue, false);
      });

      // Restaurer l'affichage quand on quitte la zone des étoiles
      star.addEventListener("mouseleave", () => {
        restoreStarDisplay();
      });

      // Ajouter un style de curseur pointer
      star.style.cursor = "pointer";
    });
  }

  // Gestion des étoiles pour le filtre de note (desktop)
  if (desktopNoteStars && desktopNoteStars.length > 0) {
    desktopNoteStars.forEach((star, index) => {
      const starValue = index + 1;

      // Gestion du clic
      star.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        handleStarSelection(starValue, true);
      });

      // Gestion du survol
      star.addEventListener("mouseenter", () => {
        handleStarHover(starValue, true);
      });

      // Restaurer l'affichage quand on quitte la zone des étoiles
      star.addEventListener("mouseleave", () => {
        restoreStarDisplay();
      });

      // Ajouter un style de curseur pointer
      star.style.cursor = "pointer";
    });
  }

  // Fermer les dropdowns quand on clique ailleurs
  document.addEventListener("click", (e) => {
    // Dropdown catégorie
    if (
      categoryDropdownButton &&
      categoryDropdownOptions &&
      !categoryDropdownButton.contains(e.target) &&
      !categoryDropdownOptions.contains(e.target)
    ) {
      categoryDropdownOptions.style.display = "none";
    }

    // Dropdown prix
    if (
      priceDropdownButton &&
      priceDropdownOptions &&
      !priceDropdownButton.contains(e.target) &&
      !priceDropdownOptions.contains(e.target)
    ) {
      priceDropdownOptions.style.display = "none";
    }

    // Dropdown prix range
    if (
      priceDropdownButton &&
      desktopPriceRangeOptions &&
      !priceDropdownButton.contains(e.target) &&
      !desktopPriceRangeOptions.contains(e.target)
    ) {
      desktopPriceRangeOptions.style.display = "none";
    }

    // Dropdown date
    if (
      dateDropdownButton &&
      dateDropdownOptions &&
      !dateDropdownButton.contains(e.target) &&
      !dateDropdownOptions.contains(e.target)
    ) {
      dateDropdownOptions.style.display = "none";
    }

    // Dropdown note
    if (
      noteDropdownButton &&
      noteDropdownOptions &&
      !noteDropdownButton.contains(e.target) &&
      !noteDropdownOptions.contains(e.target)
    ) {
      noteDropdownOptions.style.display = "none";
    }

    // Dropdown statut
    if (
      statusDropdownButton &&
      statusDropdownOptions &&
      !statusDropdownButton.contains(e.target) &&
      !statusDropdownOptions.contains(e.target)
    ) {
      statusDropdownOptions.style.display = "none";
    }
    if (
      sortDropdownButton &&
      sortDropdownOptions &&
      !sortDropdownButton.contains(e.target) &&
      !sortDropdownOptions.contains(e.target)
    ) {
      sortDropdownOptions.style.display = "none";
    }
  });

  // --- RAFRAICHISSEMENT ---
  function refreshDisplay() {
    if (window.sortManager) {
      displayManager.refreshWithFiltersAndSort(
        filterManager,
        window.sortManager
      );
    } else {
      displayManager.refreshWithFiltersAndSort(filterManager, {
        sortOffers: (offers) => offers,
      });
    }
  }

  // --- INITIALISATION ---
  updatePriceFilterDisplay(null);

  // Initialiser tous les dropdowns comme fermés
  if (categoryDropdownOptions) {
    categoryDropdownOptions.style.display = "none";
  }
  if (priceDropdownOptions) {
    priceDropdownOptions.style.display = "none";
  }
  if (desktopPriceRangeOptions) {
    desktopPriceRangeOptions.style.display = "none";
  }
  if (dateDropdownOptions) {
    dateDropdownOptions.style.display = "none";
  }
  if (noteDropdownOptions) {
    noteDropdownOptions.style.display = "none";
  }
  if (statusDropdownOptions) {
    statusDropdownOptions.style.display = "none";
  }

  // Initialiser l'affichage des étoiles
  updateStarDisplay(0);
}
