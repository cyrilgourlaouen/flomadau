let map;

async function getCoordonnees(city) {
const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city)}`;
const response = await fetch(url);
const data = await response.json();
if (data.length === 0) throw new Error("city introuvable");
return {
    lat: parseFloat(data[0].lat),
    lon: parseFloat(data[0].lon)
};
}

async function displayCityMap(city) {
try {
    const coords = await getCoordonnees(city);

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
  const city = mapDiv.getAttribute("city") || "Paris";
  displayCityMap(city);
});
