export function getOfferPrice(offer) {
  if (offer.categorie === "Restaurant" && offer.categoryData) {
    switch (offer.categoryData.gamme_de_prix) {
      case 1: return 25;
      case 2: return 40;
      case 3: return 41;
      default: return 0;
    }
  }
  if (offer.categorie !== "Restaurant" && offer.categoryData) {
    return offer.categoryData.prix_minimal || 0;
  }
  return 0;
}

export function sortOffers(offers, sortType) {
  const sorted = [...offers];
  if (sortType === "date") {
    sorted.sort((a, b) => new Date(b.date_publication) - new Date(a.date_publication));
  } else if (sortType === "asc") {
    sorted.sort((a, b) => getOfferPrice(a) - getOfferPrice(b));
  } else if (sortType === "desc") {
    sorted.sort((a, b) => getOfferPrice(b) - getOfferPrice(a));
  } else if (sortType === "note") {
    sorted.sort((a, b) => (b.note_moyenne || 0) - (a.note_moyenne || 0));
  }
  return sorted;
}