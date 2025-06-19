export function filterByNote(offers, minNote) {
    if (!minNote || minNote <= 0) return offers;

    return offers.filter((offer) => {
        const note = offer.note_moyenne || 0;
        return note >= minNote;
    });
}