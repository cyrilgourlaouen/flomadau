document.addEventListener("DOMContentLoaded", () => {
  const offerSection = document.querySelector(".offer-section");
  const offersData = JSON.parse(offerSection.dataset.offers);
  const input = document.getElementById("offer-search-input");
  const offerCards = document.querySelectorAll(".offer-card");

  let searchTimeout;

  function normalizeString(str) {
    return str
      .normalize("NFD")
      .replace(/[\u0300-\u036f]/g, "")
      .toLowerCase()
      .trim();
  }

  input.addEventListener("input", () => {
    const query = normalizeString(input.value);

    clearTimeout(searchTimeout);

    if (query === "") {
      offerCards.forEach((card) => (card.style.display = ""));
      return;
    }

    searchTimeout = setTimeout(() => {
      offersData.forEach((offer, index) => {
        const title = normalizeString(offer.titre);
        const resume = normalizeString(offer.resume);
        const ville = normalizeString(offer.ville);
        const category = normalizeString(offer.categorie);
        const raison_sociale = normalizeString(offer.professionnelData.raison_sociale);

        const matchesAny =
          title.includes(query) ||
          resume.includes(query) ||
          ville.includes(query) ||
          raison_sociale.includes(query) ||
          category.includes(query);

        if (matchesAny) {
          offerCards[index].style.display = "";
        } else {
          offerCards[index].style.display = "none";
        }
      });
    }, 500);
  });
});
