export function filterByStatus(offers, status) {
  if (!status) return offers;

  const now = new Date();
  const currentDay = getDayName(now.getDay());
  const currentTime = now.toTimeString().slice(0, 5); // Format HH:MM

  return offers.filter((offer) => {
    const isCurrentlyOpen = isOfferOpen(offer, currentDay, currentTime);
    
    if (status === 'open') {
      return isCurrentlyOpen;
    } else if (status === 'close') {
      return !isCurrentlyOpen;
    }
    
    return true;
  });
}

function getDayName(dayIndex) {
  const days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
  return days[dayIndex];
}

function isOfferOpen(offer, currentDay, currentTime) {
  if (!offer.calendar || !Array.isArray(offer.calendar)) {
    return false;
  }

  // Vérifier s'il y a des créneaux pour aujourd'hui
  const todaySchedules = offer.calendar.filter(schedule => 
    schedule.nom_jour === currentDay
  );

  if (todaySchedules.length === 0) {
    return false; // Pas d'horaires pour aujourd'hui = fermé
  }

  // Vérifier si l'heure actuelle est dans un des créneaux
  return todaySchedules.some(schedule => {
    const startTime = schedule.horaire_debut;
    const endTime = schedule.horaire_fin;
    
    return currentTime >= startTime && currentTime <= endTime;
  });
}