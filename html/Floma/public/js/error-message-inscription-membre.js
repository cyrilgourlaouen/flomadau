document.getElementById('inscription_membre').addEventListener('submit', async function (event) {
    event.preventDefault();
    let isValid = true;
    console.log("verification");
    // Reset messages d'erreur
    const errorFields = [
        'pseudo', 'tel', 'email', 'city', 'zip',
        'name-street', 'num-street', 'adress-comp',
        'password', 'password-conf'
    ];
    errorFields.forEach(field => {
        const errorEl = document.getElementById(`error-${field}`);
        if (errorEl) errorEl.textContent = "";
    });

    const pseudo = document.getElementById('pseudo').value.trim();
    const tel = document.getElementById('tel').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const password_conf = document.getElementById('conf_password').value.trim();
    console.log(pseudo);

    // Vérification back-end
    const formData = new FormData();
    if (pseudo) formData.append('pseudo', pseudo);
    if (tel) formData.append('tel', tel);
    if (email) formData.append('email', email);

    let result = {};
    try {
        const response = await fetch('?path=/inscription/membre/verification', {
            method: 'POST',
            body: formData
        });
        result = await response.json();
    } catch (error) {
        console.error('Erreur lors de la vérification :', error);
        // Tu peux aussi afficher une erreur générique à l'utilisateur ici.
        isValid = false;
    }

    // // Erreurs côté serveur
    // if (result.statusPseudo === true) {
    //     isValid = false;
    //     document.getElementById('error-pseudo').textContent = "Pseudo déjà existant";
    // }

    // if (tel.length !== 10 || result.statusTel === true) {
    //     isValid = false;
    //     document.getElementById('error-tel').textContent = "Numéro de téléphone non valide ou déjà existant";
    // }

    // if (!email.includes('@') || result.statusEmail === true) {
    //     isValid = false;
    //     document.getElementById('error-email').textContent = "Adresse e-mail non valide ou déjà existante";
    // }

    // Mot de passe trop faible
    const passwordValid = (
        password.length >= 12 &&
        /[a-z]/.test(password) &&
        /[A-Z]/.test(password) &&
        /[0-9]/.test(password) &&
        /[$&+,:;=?@#|'<>.^*()%!-]/.test(password) &&
        !/\s/.test(password)
    );
    if (!passwordValid) {
        isValid = false;
        document.getElementById('error-password').textContent = "Mot de passe ne remplissant pas toutes les conditions";
    }

    // Confirmation du mot de passe
    if (password_conf !== password) {
        isValid = false;
        document.getElementById('error-password-conf').textContent = "Les mots de passe ne correspondent pas";
    }

    // Si tout est bon, on soumet le formulaire
    if (isValid) {
        event.target.submit();
    }
});
