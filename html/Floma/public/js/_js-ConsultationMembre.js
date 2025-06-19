let submitBtn = document.getElementById("BtnValider");
let updateBtn = document.getElementById("UpdateBtn");
let cancelBtn = document.getElementById("BtnCancel");
const emailInput = document.getElementById('emailInput');
const emailMessage = document.getElementById('emailMessage');
let timeout = null;
const urlParams = new URLSearchParams(window.location.search);
const state = urlParams.get('state');

updateBtn.onclick = displayText;

function displayText() {
    submitBtn.classList.remove("hidden");
    cancelBtn.classList.remove("hidden");
    updateBtn.classList.add("hidden");   
    emailMessage.textContent = '';
    emailMessage.style.color = '';
    let champs = document.querySelectorAll('.input');
    champs.forEach(champ => champ.disabled = false);
}

document.querySelectorAll('.input').forEach(input => {
    input.setAttribute('data-original', input.value);
});

cancelBtn.addEventListener('click', () => {
    const champs = document.querySelectorAll('.input');
    let modifie = false;

    champs.forEach(champ => {
        if (champ.value !== champ.getAttribute('data-original')) {
            modifie = true;
        }
    });

    if (modifie) {
        if (confirm("Des modifications non enregistrées seront perdues. Voulez-vous continuer ?")) {
            champs.forEach(champ => {
                champ.value = champ.getAttribute('data-original');
            });
            hiddenText();
        }
    } else {
        hiddenText();
    }
});

submitBtn.addEventListener('click', () => {
    if (state === 'success') {
        alert("Modification effectuée avec succès !");
        window.history.replaceState(null, '', window.location.pathname);
    } else if (state === 'failure') {
        alert("Erreur lors de la modification.");
        window.history.replaceState(null, '', window.location.pathname);
    }
})

function hiddenText() {
    submitBtn.classList.add("hidden");
    cancelBtn.classList.add("hidden");
    updateBtn.classList.remove("hidden");
    let champs = document.querySelectorAll('.input');
    champs.forEach(champ => champ.disabled = true);
    emailMessage.textContent = '';
    emailMessage.style.color = '';

}

document.getElementById('checkPasswordBtn').addEventListener('click', () => {
    const password = document.getElementById('inputPassword').value;
    const message = document.getElementById('message');

    fetch('?path=/check/password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'password=' + encodeURIComponent(password)
    })
    .then(response => response.json())
    .then(isValid => {
        if (isValid === true) {
            message.textContent = "Mot de passe correct.";
            message.style.color = "green";

            document.getElementById('newPassword').disabled = false;
            document.getElementById('confirmPassword').disabled = false;
            document.getElementById('submitPasswordBtn').disabled = false;
        } else {
            message.textContent = "Mot de passe incorrect.";
            message.style.color = "red";

            document.getElementById('newPassword').disabled = true;
            document.getElementById('confirmPassword').disabled = true;
            document.getElementById('submitPasswordBtn').disabled = true;
        }
    })
    .catch(error => {
        console.error('Erreur de vérification :', error);
        message.textContent = "Erreur technique.";
        message.style.color = "orange";
    });
});

document.getElementById('submitPasswordBtn').addEventListener('click', (e) => {
    e.preventDefault();

    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    const message = document.getElementById('messageNewPassword');

    fetch('?path=/update/password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'new_password=' + encodeURIComponent(newPassword) +
              '&confirm_password=' + encodeURIComponent(confirmPassword)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Mot de passe modifié avec succès.');
            location.reload();
        } else {
            message.textContent = data.error;
            message.style.color = 'red';
        }
    })
    .catch(error => {
        message.textContent = 'Erreur technique.';
        message.style.color = 'orange';
        console.error('Erreur JS :', error);
    });
});

document.getElementById('BtnCancelPassword').addEventListener('click', () => {
    document.getElementById('inputPassword').value = '';
    document.getElementById('newPassword').value = '';
    document.getElementById('confirmPassword').value = '';

    document.getElementById('message').textContent = '';
    document.getElementById('messageNewPassword').textContent = '';

    document.getElementById('newPassword').disabled = true;
    document.getElementById('confirmPassword').disabled = true;
    document.getElementById('submitPasswordBtn').disabled = true;
});

emailInput.addEventListener('input', () => {
    const email = emailInput.value.trim();

    clearTimeout(timeout);
    timeout = setTimeout(() => {
        if (email === '') {
            emailMessage.textContent = '';
            emailMessage.style.color = '';
            return;
        }

        fetch('?path=/check/email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'email=' + encodeURIComponent(email)
        })
        .then(response => response.json())
        .then(result => {
            if (!result.success) {
                emailMessage.textContent = result.error || "Erreur lors de la vérification.";
                emailMessage.style.color = "orange";
            } else if (result.available === false) {
                emailMessage.textContent = "Cet email est déjà utilisé.";
                emailMessage.style.color = "red";
            } else {
                emailMessage.textContent = "Email disponible.";
                emailMessage.style.color = "green";
            }
        })
        .catch(error => {
            console.error('Erreur de vérification email :', error);
            emailMessage.textContent = "Erreur technique.";
            emailMessage.style.color = "orange";
        });
    }, 300);
});

