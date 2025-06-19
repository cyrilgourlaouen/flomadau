import { getOfferPrice } from '../sort/sortFunctions.js';

export function filterByPrice(offers, priceRange) {
  if (!priceRange) return offers;

  const { min, max } = priceRange;

  return offers.filter((offer) => {
    const prix = getOfferPrice(offer);

    if (min !== undefined && prix < min) return false;
    if (max !== undefined && prix > max) return false;
    return true;
  });
}
