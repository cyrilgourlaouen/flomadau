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

function afficherTag(value)
{
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
        document.getElementById(champs[value]).disabled = false;
    }
}

const guideCheckbox = document.getElementById('guideCheckbox');
const selectGuides = document.getElementById('selectGuides');

guideCheckbox.addEventListener('change', () => {
    selectGuides.classList.toggle('hidden', !guideCheckbox.checked);
});

const jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
const container = document.getElementById('horaire-container');

jours.forEach(jour => {
  const jourId = jour.toLowerCase();
  const row = document.createElement('div');
  row.innerHTML = `
    <div><label>${jour}<p class="dayLabel"><input type="checkbox" onchange="toggleJour('${jourId}', this.checked)" checked> Ouvert</p></div>
    <div id="${jourId}-slots" class="slots">
      ${createSlotHTML(jourId, 0)}
    </div>
    <button type="button" class="btn-creation" onclick="ajouterCreneau('${jourId}')">+ Ajouter un créneau</button>`;
  if (jour != 'Dimanche') {
      row.innerHTML += `<hr>`;
  }
  container.appendChild(row);
});

function createSlotHTML(jourId, index) {
  return `
    <div class="slot">
      <input type="time" name="${jourId}_ouverture[]" id="${jourId}_ouverture_${index}">
      <input type="time" name="${jourId}_fermeture[]" id="${jourId}_fermeture_${index}">
      <button type="button" class="btn_close" onclick="this.parentNode.remove()"><img src="./assets/icons/close_red.svg"></button>
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
  container.parentElement.querySelector('button').disabled = !isChecked;
  [...container.querySelectorAll('input, button')].forEach(el => el.disabled = !isChecked);
}
