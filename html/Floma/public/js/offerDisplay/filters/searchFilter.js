export function filterBySearch(offers, query) {
  const normalizeString = (str) =>
    str
      ? str
          .normalize('NFD')
          .replace(/[\u0300-\u036f]/g, '')
          .toLowerCase()
          .trim()
      : '';

  const normalizedQuery = normalizeString(query);

  return offers.filter((offer) => {
    const fields = [
      offer.titre,
      offer.resume,
      offer.ville,
      offer.categorie,
      offer.professionnelData?.raison_sociale,
    ];
    return fields.some((field) =>
      normalizeString(field).includes(normalizedQuery)
    );
  });
}
