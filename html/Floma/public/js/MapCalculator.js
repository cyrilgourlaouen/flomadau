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

async function displayCityMap(containerId, city) {
    try {
        const coords = await getCoordonnees(city);

        const mapInstance = L.map(containerId).setView([coords.lat, coords.lon], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(mapInstance);

        L.marker([coords.lat, coords.lon])
            .addTo(mapInstance)
            .bindPopup(`Ville : ${city}`)
            .openPopup();
    } catch (error) {
        console.error("Erreur :", error);
        alert("Erreur : " + error.message);
    }
}

window.addEventListener("DOMContentLoaded", () => {
    const mapDiv = document.getElementById("map");
    const mapTabDiv = document.getElementById("mapTab");

    const city = mapDiv?.getAttribute("city") || "Paris";
    const cityTab = mapTabDiv?.getAttribute("city") || "Lyon";

    if (mapDiv) displayCityMap("map", city);
    if (mapTabDiv) displayCityMap("mapTab", cityTab);
});
