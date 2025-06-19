export function filterByDate(offers, dateRange) {
    if (!dateRange) return offers;

    const { startDate, endDate } = dateRange;
    
    return offers.filter((offer) => {
        if (!offer.date_creation) return false;
        
        const offerDate = new Date(offer.date_creation);
        
        if (startDate && offerDate < startDate) return false;
        if (endDate && offerDate > endDate) return false;
        
        return true;
    });
}