const featured = document.getElementById("featured");
const highlighted = document.getElementById("highlighted");
const priceDisplay = document.getElementById("price");

const PRIX_A_LA_UNE = 16.68;
const PRIX_EN_RELIEF = 8.34;

function updatePrice() {
    let total = 0;
    if (featured.checked) total += PRIX_A_LA_UNE;
    if (highlighted.checked) total += PRIX_EN_RELIEF;

    priceDisplay.textContent = `Prix total : ${total.toFixed(2)} €`;
}

featured.addEventListener("change", updatePrice);
highlighted.addEventListener("change", updatePrice);