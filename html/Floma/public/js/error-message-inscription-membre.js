document.getElementById('inscription_membre').addEventListener('submit',function(event) {

    let isValid = true;

    //Reset de chaques messages d'erreur
    document.getElementById('error-pseudo').textContent = "";
    document.getElementById('error-tel').textContent = "";
    document.getElementById('error-email').textContent = "";
    document.getElementById('error-city').textContent = "";
    document.getElementById('error-zip').textContent = "";
    document.getElementById('error-name-street').textContent = "";
    document.getElementById('error-num-street').textContent = "";
    document.getElementById('error-adress-comp').textContent = "";
    document.getElementById('error-password').textContent = "";
    document.getElementById('error-password-conf').textContent = "";


    const pseudo = document.getElementById('pseudo').value.trim();
    const tel = document.getElementById('tel').value.trim();
    const email = document.getElementById('email').value.trim();

    const formData = new FormData();
    formData.append('pseudo', pseudo);
    formData.append('tel', tel);
    formData.append('email', email);

    const response = /*await*/ fetch('/src/InscriptionController.php/', {
        method: 'POST',
        body: formData
    });

    const result = /*await*/ response.json();

    //Pseudo existe déjà en BDD
    if (result.gettingPseudo !== undefined) {
        isValid = false;
        document.getElementById('error-pseudo').textContent = "Pseudo déjà existant";
    }

    //Numéro de téléphone existe déjà en BDD ou invalide
    if (tel.length !== 10 && result.gettingTel !== undefined) {
        isValid = false;
        document.getElementById('error-tel').textContent = "Numéro de téléphone non valide ou déjà existant";
    }

    // Adresse e-mail invalide ou déjà existant
    if (result.gettingEmail !== undefined) {
        isValid = false;
        document.getElementById('error-email').textContent = "Adresse e-mail non valide ou déjà existant";
    }

    // *Pour la version mobile uniquement* Mot de passe ne remplissant pas toutes les conditions (ex: Caractère spécial, minimum de 12 caractères etc...)
    const password = document.getElementById('password').value.trim();
    if (password.length < 12 && !password.match(/[a-z]/) && !password.match(/[A-Z]/) && !password.match(/[0-9]/) && !password.match(/[[$&+,:;=?@#|'<>.-^*()%!]]/) && password.includes(" ")) {
        isValid = false;
        document.getElementById('error-password').textContent = "Mot de passe ne remplissant pas toutes les conditions";
    }

    // Le mot de passe dans le champ confirmation est différent de celui du champ principale
    const password_conf = document.getElementById('conf_password').value.trim();
    if (password_conf !== password) {
        isValid = false;
        document.getElementById('error-password-conf').textContent = "Les mots de passe ne correspondent pas";
    }

    if (isValid === false) {
        event.preventDefault();
    }
});