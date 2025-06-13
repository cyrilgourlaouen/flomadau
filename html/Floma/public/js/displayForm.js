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
    }
    
    if (champs[value]) {
        document.getElementById(champs[value]).classList.remove("hidden");
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
    }

    if (champs[value]) {
        document.getElementById(champs[value]).classList.remove("hidden");
    }
}

const guideCheckbox = document.getElementById('guideCheckbox');
const selectGuides = document.getElementById('selectGuides');

guideCheckbox.addEventListener('change', () => {
    selectGuides.classList.toggle('hidden', !guideCheckbox.checked);
});
