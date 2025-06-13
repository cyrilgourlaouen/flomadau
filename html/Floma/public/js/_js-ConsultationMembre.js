let submitBtn = document.getElementById("BtnValider");
let updateBtn = document.getElementById("UpdateBtn");


let password = document.getElementById("CheckPassword");


/* Ancien mot de passe */
let submitPasswordInput = document.getElementById("submitPasswordBtn");
let txtPassword = document.getElementById("inputPassword");


/* Nouveau mot de passe */
let newPassword = document.getElementById("newPassword");
let confirmPassword = document.getElementById("confirmPassword");

let message = document.getElementById("message");

updateBtn.onclick = displayText;
submitPasswordInput.onclick = checkPasswordMatch;

function displayText() {
    submitBtn.classList.remove("hidden");
    updateBtn.classList.add("hidden");
    let champs = document.querySelectorAll('.input');
    champs.forEach(champ => champ.disabled = false);
}

function checkPasswordMatch() {
    if(newPassword !== confirmPassword) {
        message.textContent = "Les mots de passe ne correspondent pas";
    } else {
        message.textContent = "";
    }
}



