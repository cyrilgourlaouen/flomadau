let submitBtn = document.getElementById("BtnValider");
let updateBtn = document.getElementById("UpdateBtn");
let cancelBtn = document.getElementById("BtnCancel");

let message = document.getElementById("message");

updateBtn.onclick = displayText;
cancelBtn.onclick = hiddenText;
submitPasswordInput.onclick = checkPasswordMatch;

function displayText() {
    submitBtn.classList.remove("hidden");
    cancelBtn.classList.remove("hidden");
    updateBtn.classList.add("hidden");
    let champs = document.querySelectorAll('.input');
    champs.forEach(champ => champ.disabled = false);
}

function hiddenText() {
    submitBtn.classList.add("hidden");
    cancelBtn.classList.add("hidden");
    updateBtn.classList.remove("hidden");
    let champs = document.querySelectorAll('.input');
    champs.forEach(champ => champ.disabled = true);
}




