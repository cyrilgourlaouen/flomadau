let submitBtn = document.getElementById("BtnValider");
let updateBtn = document.getElementById("UpdateBtn");

let password = document.getElementById("CheckPassword");

/* Ancien mot de passe */
let submitPasswordInput = document.getElementById("submitPasswordBtn");

/* Nouveau mot de passe */
let newPassword = document.getElementById("newPassword");
let confirmPassword = document.getElementById("confirmPassword");

let message = document.getElementById("message");




updateBtn.onclick = displayText;
submitPasswordInput.onclick = checkPasswordMatch;
password.onclick = accesNewPassword;

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

function accesNewPassword(){
    console.log("1 fdp victor")
    const test = "dorian"
    if(password === test){
        console.log("2 fdp victor");
    }
}
