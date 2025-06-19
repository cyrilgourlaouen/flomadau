function ajouterLangue() {
  const input = document.getElementById("newLang");
  const langue = input.value.trim();
  const select = document.getElementById("guideOptions");

  if (langue === "") return;

  // Vérifie si la langue existe déjà
  for (let option of select.options) {
    if (option.value.toLowerCase() === langue.toLowerCase()) {
      alert("Cette langue existe déjà !");
      return;
    }
  }

  // Crée une nouvelle option
  const option = document.createElement("option");
  option.value = langue;
  option.text = langue;
  select.appendChild(option);
  input.value = "";
}

function supprimerLangues() {
  const select = document.getElementById("guideOptions");
  const selectedOptions = Array.from(select.selectedOptions);
  selectedOptions.forEach((option) => option.remove());
}

document
  .getElementById("btn-supprimer-carte")
  ?.addEventListener("click", function () {
    if (!confirm("Confirmer la suppression de la carte ?")) return;

    fetch("delete_carte_restaurant.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        restaurantId: json_encode($dataRestaurant["id"] ?? null),
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Image supprimée avec succès !");
          // Cache le preview + bouton
          const container = document.getElementById("carte-restaurant-preview");
          if (container) container.style.display = "none";
          // Clear le champ file
          document.getElementById("url_carte_restaurant").value = "";
        } else {
          alert(
            "Erreur lors de la suppression : " +
              (data.message || "Erreur inconnue")
          );
        }
      })
      .catch((err) => alert("Erreur AJAX : " + err.message));
  });

function addGuide() {
  const select = document.getElementById("guideOptions");
  const selectedList = document.getElementById("selectedGuides");

  const selectedOption = select.options[select.selectedIndex];
  if (!selectedOption) return;

  // Ajouter dans la liste sélectionnée
  const newOption = document.createElement("option");
  newOption.value = selectedOption.value;
  newOption.textContent = selectedOption.textContent;
  newOption.selected = true;
  selectedList.appendChild(newOption);

  // Retirer de la liste des disponibles
  select.remove(select.selectedIndex);
}

function removeGuide() {
  const selectedList = document.getElementById("selectedGuides");
  const guideOptions = document.getElementById("guideOptions");

  const selectedOptions = Array.from(selectedList.selectedOptions);
  selectedOptions.forEach((option) => {
    // Créer une nouvelle option dans guideOptions
    const restoredOption = document.createElement("option");
    restoredOption.value = option.value;
    restoredOption.textContent = option.textContent;
    guideOptions.appendChild(restoredOption);

    // Retirer de selectedGuides
    selectedList.removeChild(option);
  });
}
