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

  // Prix desktop
  const priceDropdownButton = document.querySelector(
    "#offer-price-desktop-button"
  );
  const priceDropdownOptions = document.querySelector("#desktop-price-options");
  const selectedPriceLabel = document.getElementById("selected-price-label");
  const minDesktopPriceInput = document.getElementById("min-price-desktop");
  const maxDesktopPriceInput = document.getElementById("max-price-desktop");

  // --- FONCTIONS ---

  function debounce(fn, delay) {
    let timeoutId;
    return function (...args) {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => fn.apply(this, args), delay);
    };
  }

  function updateSelectedPriceLabel(min, max) {
    const minValid = min !== undefined && min !== "" && !isNaN(Number(min));
    const maxValid = max !== undefined && max !== "" && !isNaN(Number(max));

    // Si aucun champ n'est valide, ou si une erreur de validation est détectée, on vide le label
    if (!minValid && !maxValid) {
      selectedPriceLabel.textContent = "";
    } else if (minValid && maxValid) {
      selectedPriceLabel.textContent = `: ${Number(min)} - ${Number(max)}`;
    } else if (minValid) {
      selectedPriceLabel.textContent = `: ${Number(min)} min`;
    } else if (maxValid) {
      selectedPriceLabel.textContent = `: ${Number(max)} max`;
    }

    // Synchronise les inputs desktop
    if (minDesktopPriceInput) {
      minDesktopPriceInput.value =
        min !== undefined && min !== "" && !isNaN(Number(min))
          ? Number(min)
          : "";
    }
    if (maxDesktopPriceInput) {
      maxDesktopPriceInput.value =
        max !== undefined && max !== "" && !isNaN(Number(max))
          ? Number(max)
          : "";
    }

    // Synchronise les inputs mobile
    if (minPriceInput) {
      minPriceInput.value =
        min !== undefined && min !== "" && !isNaN(Number(min))
          ? Number(min)
          : "";
    }
    if (maxPriceInput) {
      maxPriceInput.value =
        max !== undefined && max !== "" && !isNaN(Number(max))
          ? Number(max)
          : "";
    }
  }

  function resetPriceFilter() {
    // Reset du filtre
    filterManager.setFilter("price", null);

    // Reset des inputs
    if (minPriceInput) minPriceInput.value = "";
    if (maxPriceInput) maxPriceInput.value = "";
    if (minDesktopPriceInput) minDesktopPriceInput.value = "";
    if (maxDesktopPriceInput) maxDesktopPriceInput.value = "";

    // Reset du label
    if (selectedPriceLabel) selectedPriceLabel.textContent = "";

    // Reset des classes d'erreur
    if (minPriceInput?.parentElement)
      minPriceInput.parentElement.classList.remove(
        "filter-modal-price-icon-wrapper-error"
      );
    if (maxPriceInput?.parentElement)
      maxPriceInput.parentElement.classList.remove(
        "filter-modal-price-icon-wrapper-error"
      );
    if (minDesktopPriceInput?.parentElement)
      minDesktopPriceInput.parentElement.classList.remove(
        "filter-modal-price-icon-wrapper-error"
      );
    if (maxDesktopPriceInput?.parentElement)
      maxDesktopPriceInput.parentElement.classList.remove(
        "filter-modal-price-icon-wrapper-error"
      );
  }

  function updatePriceFilterDisplay(category) {
    const isRestaurant = category === "Restaurant";

    if (priceInputOptions && priceRangeOptions) {
      if (isRestaurant) {
        // Afficher les gammes de prix, masquer les inputs min/max
        priceInputOptions.style.display = "none";
        priceRangeOptions.style.display = "flex";
      } else {
        // Afficher les inputs min/max, masquer les gammes de prix
        priceInputOptions.style.display = "flex";
        priceRangeOptions.style.display = "none";
      }
    }
  }

  function validatePriceRange(min, max) {
    // Si aucun des deux n'est défini, pas de filtre
    if (
      (min === undefined || min === "") &&
      (max === undefined || max === "")
    ) {
      return { valid: false, min: undefined, max: undefined, reason: "empty" };
    }
    // Si min ou max n'est pas un nombre valide
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
    // Si max < min, filtre invalide
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
    // Sinon, filtre valide
    return {
      valid: true,
      min: min !== "" ? Number(min) : undefined,
      max: max !== "" ? Number(max) : undefined,
    };
  }

  function handleDesktopPriceChange() {
    const min = minDesktopPriceInput?.value || undefined;
    const max = maxDesktopPriceInput?.value || undefined;

    const validation = validatePriceRange(min, max);

    // Réinitialise les classes d'erreur
    minDesktopPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );
    maxDesktopPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );

    // ...existing code...

    if (!validation.valid) {
      // Marque les champs invalides
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

      // Vide SEULEMENT le label prix en cas d'erreur
      if (selectedPriceLabel) selectedPriceLabel.textContent = "";
      // Ne touche pas aux champs ni au filtre
      return;
    }

    filterManager.setFilter("price", {
      min: validation.min,
      max: validation.max,
    });
    updateSelectedPriceLabel(validation.min, validation.max);
    refreshDisplay();
  }

  function handlePriceChange() {
    const min = minPriceInput?.value || undefined;
    const max = maxPriceInput?.value || undefined;

    const validation = validatePriceRange(min, max);

    // Réinitialise les classes d'erreur
    minPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );
    maxPriceInput?.parentElement.classList.remove(
      "filter-modal-price-icon-wrapper-error"
    );

    if (!validation.valid) {
      // Marque les champs invalides
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

      // Vide SEULEMENT le label prix en cas d'erreur
      if (selectedPriceLabel) selectedPriceLabel.textContent = "";
      // Ne touche pas aux champs ni au filtre
      return;
    }

    filterManager.setFilter("price", {
      min: validation.min,
      max: validation.max,
    });
    updateSelectedPriceLabel(validation.min, validation.max);
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

  // Catégorie desktop
  if (categoryDropdownButton && categoryDropdownOptions) {
    categoryDropdownOptions.style.display = "none";

    categoryDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      categoryDropdownOptions.style.display =
        categoryDropdownOptions.style.display === "none" ? "block" : "none";
    });

    document.addEventListener("click", (e) => {
      if (
        categoryDropdownOptions.style.display !== "none" &&
        !categoryDropdownButton.contains(e.target) &&
        !categoryDropdownOptions.contains(e.target)
      ) {
        categoryDropdownOptions.style.display = "none";
      }
    });
  }

  // Catégorie desktop options
  desktopCategoryOptions.forEach((option) => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      const category = option.dataset.category;
      handleCategorySelection(category, true);

      if (categoryDropdownOptions) {
        categoryDropdownOptions.style.display = "none";
      }
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

  // Prix modal/mobile
  const debouncedHandlePriceChange = debounce(handlePriceChange, 500);
  if (minPriceInput)
    minPriceInput.addEventListener("input", debouncedHandlePriceChange);
  if (maxPriceInput)
    maxPriceInput.addEventListener("input", debouncedHandlePriceChange);

  // Prix desktop
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

  // Toggle du dropdown prix desktop
  if (priceDropdownButton && priceDropdownOptions) {
    priceDropdownOptions.style.display = "none";

    priceDropdownButton.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      priceDropdownOptions.style.display =
        priceDropdownOptions.style.display === "none" ? "flex" : "none";
    });

    document.addEventListener("click", (e) => {
      if (
        priceDropdownOptions.style.display !== "none" &&
        !priceDropdownButton.contains(e.target) &&
        !priceDropdownOptions.contains(e.target)
      ) {
        priceDropdownOptions.style.display = "none";
      }
    });
  }

  // --- FONCTION CATÉGORIE ---
  function handleCategorySelection(category, isFromDesktop = true) {
    const isCurrentlySelected =
      filterManager.getFilter("category") === category;
    const previousCategory = filterManager.getFilter("category");

    // Reset le filtre prix seulement lors du passage Restaurant ↔ autre catégorie
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
      }
    }

    // Si on désélectionne Restaurant pour aller vers "aucune catégorie", reset aussi
    if (isCurrentlySelected && previousCategory === "Restaurant") {
      resetPriceFilter();
    }

    filterManager.setFilter("category", isCurrentlySelected ? null : category);

    // Mettre à jour l'affichage des options de prix selon la catégorie
    const selectedCategory = isCurrentlySelected ? null : category;
    updatePriceFilterDisplay(selectedCategory);

    desktopCategoryOptions.forEach((opt) => {
      opt.classList.remove("selected-category-desktop");
      if (!isCurrentlySelected && opt.dataset.category === category) {
        opt.classList.add("selected-category-desktop");
      }
    });

    if (selectedCategoryLabel) {
      selectedCategoryLabel.textContent =
        !isCurrentlySelected && category ? `: ${category}` : "";
    }

    modalCategoryOptions.forEach((opt) => {
      opt.classList.remove("selected-category");
      if (!isCurrentlySelected && opt.dataset.category === category) {
        opt.classList.add("selected-category");
      }
    });

    refreshDisplay();
  }

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
  // Initialiser l'affichage des options de prix selon la catégorie par défaut
  updatePriceFilterDisplay(null);
}
