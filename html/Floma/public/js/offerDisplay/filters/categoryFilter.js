export function filterByCategory(offers, selectedCategory) {
  if (!selectedCategory) return offers;
  return offers.filter((offer) => offer.categorie === selectedCategory);
}
