document.addEventListener('DOMContentLoaded', () => {
  afficherChamps();

  const guideCheckbox = document.getElementById('guideCheckbox');
  const selectGuides = document.getElementById('selectGuides');
  guideCheckbox.addEventListener('change', () => {
    selectGuides.classList.toggle('hidden', !guideCheckbox.checked);
  });

  chargerHoraires(horaireData);
});

function afficherChamps() {
  const value = document.getElementById("categorie").value;
  const champs = {
    "Visite": "champs-visite",
    "Spectacle": "champs-spectacle",
    "Restaurant": "champs-restaurant",
    "Activite": "champs-activite",
    "Parc d'attraction": "champs-parc"
  };

  for (const id of Object.values(champs)) {
    document.getElementById(id).classList.add("hidden");
    document.getElementById(id).disabled = true;
  }

  if (champs[value]) {
    document.getElementById(champs[value]).classList.remove("hidden");
    document.getElementById(champs[value]).disabled = false;
  }
  afficherTag(value);
}

function afficherTag(value) {
  const champs = {
    "Visite": "isNotRestauration",
    "Spectacle": "isNotRestauration",
    "Restaurant": "isRestauration",
    "Activite": "isNotRestauration",
    "Parc d'attraction": "isNotRestauration"
  };

  for (const id of Object.values(champs)) {
    document.getElementById(id).classList.add("hidden");
    document.getElementById(id).disabled = true;
  }

  if (champs[value]) {
    document.getElementById(champs[value]).classList.remove("hidden");
  }
}

const jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

function chargerHoraires(horaireData) {
  const container = document.getElementById('horaire-container');
  container.innerHTML = ''; 

  jours.forEach(jour => {
    const jourId = jour.toLowerCase().replace(/\s/g, '-');
    const creneaux = horaireData[jour] || [];
    const ouvert = creneaux.length > 0;

    let slotsHTML = '';
    if (ouvert) {
      creneaux.forEach((creneau, index) => {
        slotsHTML += createSlotHTML(jourId, index, creneau.ouverture, creneau.fermeture);
      });
    } else {
      slotsHTML = createSlotHTML(jourId, 0, '', '');
    }

    const row = document.createElement('div');
    row.innerHTML = `
      <div class="horaire">
        <label>${jour}</label>
        <p class="dayLabel">
          <input type="checkbox" onchange="toggleJour('${jourId}', this.checked)" ${ouvert ? 'checked' : ''} disabled> Ouvert
        </p>
      </div>
      <div id="${jourId}-slots" class="slots" style="${ouvert ? '' : 'display:none;'}">
        ${slotsHTML}
      </div>
      <button type="button" class="btn-creation" onclick="ajouterCreneau('${jourId}')" ${ouvert ? '' : 'disabled'}>+ Ajouter un créneau</button>
      ${jour !== 'Dimanche' ? '<hr>' : ''}
    `;

    container.appendChild(row);
  });
}

function createSlotHTML(jourId, index, debut = '', fin = '') {
  return `
    <div class="slot">
      <input type="time" name="${jourId}_ouverture[]" id="${jourId}_ouverture_${index}" value="${debut}">
      <input type="time" name="${jourId}_fermeture[]" id="${jourId}_fermeture_${index}" value="${fin}">
      <button type="button" class="btn_close" onclick="this.parentNode.remove()">
        <img src="./assets/icons/close_red.svg" alt="Supprimer créneau">
      </button>
    </div>
  `;
}

function ajouterCreneau(jourId) {
  const slots = document.getElementById(`${jourId}-slots`);
  const index = slots.children.length;
  slots.insertAdjacentHTML('beforeend', createSlotHTML(jourId, index));
}

function toggleJour(jourId, isChecked) {
  const container = document.getElementById(`${jourId}-slots`);
  container.style.display = isChecked ? '' : 'none';
  container.parentElement.querySelector('button').disabled = !isChecked;
  [...container.querySelectorAll('input, button')].forEach(el => el.disabled = !isChecked);
}
