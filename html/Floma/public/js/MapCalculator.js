let map; // variable globale pour la carte

async function getCoordonnees(ville) {
const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(ville)}`;
const response = await fetch(url);
const data = await response.json();
if (data.length === 0) throw new Error("Ville introuvable");
return {
    lat: parseFloat(data[0].lat),
    lon: parseFloat(data[0].lon)
};
}

async function afficherCarteVille(ville) {
try {
    const coords = await getCoordonnees(ville);

    if (map) {
    map.remove();
    }

    map = L.map('map').setView([coords.lat, coords.lon], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([coords.lat, coords.lon])
    .addTo(map)
    .bindPopup(`Ville : ${ville}`)
    .openPopup();
} catch (error) {
    console.error("Erreur :", error);
    alert("Erreur : " + error.message);
}
}

window.addEventListener("DOMContentLoaded", () => {
  const mapDiv = document.getElementById("map");
  const ville = mapDiv.getAttribute("city") || "Paris";
  afficherCarteVille(ville);
});
