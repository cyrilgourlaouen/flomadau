 const btnAjouter = document.getElementById("btn_ajouter");
  const modal = document.getElementById("avisModal");
  const closeModal = document.getElementById("closeModal");

  btnAjouter.addEventListener("click", () => {
    modal.style.display = "flex";
  });

  closeModal.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });