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