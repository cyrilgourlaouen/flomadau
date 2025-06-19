/*GESTION DES BOUTONS*/

const btnUpdate = document.getElementById('btn-update');
const btnDeletePp = document.getElementById('btn-delete-pp');
const btnCancelPp = document.getElementById('btn-cancel-pp');
const btnCancel = document.getElementById('btn-cancel');
const btnDeleteCard = document.getElementById('btn-delete-credit-card');
const btnCancelCard = document.getElementById('btn-cancel-credit-card');
const btnSubmit = document.getElementById('btn-submit');
const form = document.getElementById('form-pro');

/*Clic sur modifier*/

btnUpdate.addEventListener('click', function() {

  //on affiche les elements cachés
  let hide = document.querySelectorAll('.hidden');;
  for(let i=0; i<hide.length; i++){
    hide[i].classList.remove('hidden');
    hide[i].classList.add('not-hidden');
  }

  //on active les inputs
  let inputs = document.querySelectorAll('.not-active');;
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = false;
    inputs[j].classList.remove('not-active');
    inputs[j].classList.add('active');
  }

  //Si img par défaut on propose l'input file
  const photoProfil = document.getElementById('photo-profil');

  if(photoProfil.src.includes('pp_compte_defaut')){
    document.getElementById('check-pp').classList.add('hidden');
    document.getElementById('new-pp').classList.remove('hidden-pp');
    btnDeletePp.classList.add('hidden');
  }

  btnUpdate.classList.add('hidden');
});


/*Clic sur le btn annuler du formulaire*/

btnCancel.addEventListener('click', function() {
  form.reset();

  let notHide = document.querySelectorAll('.not-hidden');;
  for(let i=0; i<notHide.length; i++){
    notHide[i].classList.remove('not-hidden');
    notHide[i].classList.add('hidden');
  }

  let inputs = document.querySelectorAll('.active');;
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = true;
    inputs[j].classList.add('not-active');
  }

  if(document.getElementById('check-pp').classList.contains('hidden')){
    cancelPp();
    btnDeletePp.classList.add('hidden');
  }

  if(document.getElementById('check-card') !== null){
    if(document.getElementById('check-card').classList.contains('hidden')){
      cancelCreditCard();
      if(btnDeleteCard !== null){
        btnDeleteCard.classList.add('hidden');
      }
    }
  }

  let spansErreur = document.querySelectorAll('.erreur');

    spansErreur.forEach(span => {
        span.textContent = '';
    });

  btnUpdate.classList.remove('hidden');
});

/*Clic sur le btn supprimer de la photo de profil*/
btnDeletePp.addEventListener('click', function() {
  //Pour savoir si la pp a été supprimée ou inchangée
  document.getElementById('delete-picture').value = '1';
});

/*Suppression de la photo de profil + annulation de la suppression*/
btnDeletePp.addEventListener('click', function(){
  document.getElementById('check-pp').classList.add('hidden');
  //Hidden différent pour l'afficher que si on clique sur supprimer
  document.getElementById('new-pp').classList.remove('hidden-pp');
  btnDeletePp.classList.add('hidden');
  btnCancelPp.classList.remove('hidden-pp');
});


btnCancelPp.addEventListener('click', cancelPp);
  
function cancelPp(){
  document.getElementById('check-pp').classList.remove('hidden');
  //Hidden différent pour l'afficher que si on clique sur supprimer
  document.getElementById('new-pp').classList.add('hidden-pp');
  btnCancelPp.classList.add('hidden-pp');
  btnDeletePp.classList.remove('hidden');
}

if(btnDeleteCard !== null){
  /*Suppression de la carte bancaire + annulation de la suppression*/
  btnDeleteCard.addEventListener('click', function(){
    document.getElementById('check-card').classList.add('hidden');
    //Hidden différent pour l'afficher que si on clique sur supprimer
    document.getElementById('new-credit-card').classList.remove('hidden-credit-card');
    btnDeleteCard.classList.add('hidden');
    btnCancelCard.classList.remove('hidden-credit-card')
  });
}

if(btnCancelCard !== null){
  btnCancelCard.addEventListener('click', cancelCreditCard);
}

function cancelCreditCard(){
  document.getElementById('check-card').classList.remove('hidden');
  //Hidden différent pour l'afficher que si on clique sur supprimer
  document.getElementById('new-credit-card').classList.add('hidden-credit-card');
  btnCancelCard.classList.add('hidden-credit-card');
  btnDeleteCard.classList.remove('hidden');
}

/*GESTION DES INPUT EN TEMPS REEL*/

//Validateur pour chaque input
const validateurs = {
  
  nom: function(valeur) {
    if (!valeur) return "Le nom est requis";
    if (!/^[A-Za-zÀ-ÖØ-öø-ÿ-' ]+$/.test(valeur)) return "Le nom contient des caractères non valides";
    return null;
  },

  prenom: function(valeur) {
    if (!valeur) return "Le prénom est requis";
    if (!/^[A-Za-zÀ-ÖØ-öø-ÿ-' ]+$/.test(valeur)) return "Le prénom contient des caractères non valides";
    return null;
  },

  telephone: function(valeur) {
    if (!valeur) return "Le téléphone est requis";
    if (!/^0[1-9]\d{8}$/.test(valeur.replaceAll(' ', ''))) return "Format de téléphone invalide";
    return null;
  },

  email: function(valeur) {
    if (!valeur) return "L'email est requis";
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valeur)) return "L'adresse email n'est pas valide";
    return null;
  },

  denomination: function(valeur) {
    if (!valeur) return "La dénomination sociale est requise";
    return null;
  },

  siren: function(valeur) {
    if (!valeur) return "Le numéro SIREN est requis";
    if (!/^\d{9}$/.test(valeur.replaceAll(' ', ''))) return "Le numéro SIREN doit être composé de 9 chiffres";
    return null;
  },

  rue: function(valeur) {
    if (!valeur) return "Le nom de rue est requis";
    return null;
  },

  ville: function(valeur) {
    if (!valeur) return "La ville est requise";
    return null;
  },

  numero: function(valeur) {
    if (!valeur) return "Le numéro de rue est requis";
    if (!/\d/.test(valeur)) return "Le numéro de rue doit contenir au moins un chiffre";
    if (valeur.length > 10) return "Le code postal doit être composé de moins de 10 chiffres";
    return null;
  },

  'code-postal': function(valeur) {
    if (!valeur) return "Le code postal est requis";
    if (!/^\d{5}$/.test(valeur.replaceAll(' ', ''))) return "Le code postal doit être composé de 5 chiffres";
    return null;
  },

  'card-number': function(valeur) {
    if (!valeur) return null; 
    if (!/^\d{13,19}$/.test(valeur.replaceAll(' ', ''))) return "Numéro de carte invalide";
    return null;
  },

  'expiration-date': function(valeur) {
    if (!valeur) return null; 

    /^(0[1-9]|1[0-2])\/(\d{4})$/
    if (!/^(0[1-9]|1[0-2])\/(\d{4})$/.test(valeur)) return "Le format n'est pas valide";

    const [annee, mois] = valeur.split('-').map(Number);

    const dateActuelle = new Date();
    const anneeActuelle = dateActuelle.getFullYear();
    const moisActuel = dateActuelle.getMonth() + 1;

    if (annee < anneeActuelle || (annee === anneeActuelle && mois < moisActuel)) {
        return "Cette carte est expirée";
    }

    return null;
  },

  cvv: function(valeur) {
    if (!valeur) return null; 
    if (!/^\d{3,4}$/.test(valeur)) return "Le CCV doit avoir 3 ou 4 chiffres";
    return null;
  }
};

//Validateur pour les champs qui contiennent les mots de passe
function validerChampsMotDePasse() {
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-password');
    const oldPassword = document.getElementById('old-password');

    const erreurOldPassword = document.getElementById('erreur-old-password');
    const erreurNewPassword = document.getElementById('erreur-new-password');
    const erreurConfirmPassword = document.getElementById('erreur-confirm-password');

    erreurOldPassword.textContent = '';
    erreurNewPassword.textContent = '';
    erreurConfirmPassword.textContent = '';

    if (oldPassword.value === '') {
      erreurOldPassword.textContent = "L'ancien mot de passe doit être saisi";
    }

    if (newPassword.value === '') {
      erreurNewPassword.textContent = "Le nouveau mot de passe doit être saisi";
    }

    if (confirmPassword.value === '') {
      erreurConfirmPassword.textContent = "La confirmation du mot de passe doit être saisie";
    }

    if (newPassword.value !== '' && confirmPassword.value !== '' && newPassword.value !== confirmPassword.value) {
      erreurConfirmPassword.textContent = "Les mots de passe ne correspondent pas";
    }
}


//Validateur pour vérifier que tous les champs cb sont remplis en même temps
function validerChampsCarte() {
  const numCarte = document.getElementById('card-number');
  const dateExpiration = document.getElementById('expiration-date');
  const cvv = document.getElementById('cvv');

  const erreurNumCarte = document.getElementById('erreur-card-number');
  const erreurDateExpiration = document.getElementById('erreur-expiration-date');
  const erreurCvv = document.getElementById('erreur-cvv');
  
  if (numCarte.value === '') {
    erreurNumCarte.textContent = "Le numéro de carte doit être saisi";
  }

  if (dateExpiration.value === '') {
    erreurDateExpiration.textContent = "La date d'expiration doit être saisie";
  }

  if (cvv.value === '') {
    erreurCvv.textContent = "le code de sécurité doit être saisi";
  }
}


//EventListener qui surveille les input sur les champs du formulaire
form.addEventListener('input', function(event) {
  const champ = event.target;
  const nomDuChamp = champ.name;

  if (nomDuChamp === 'card-number' || nomDuChamp === 'expiration-date' || nomDuChamp === 'cvv'){
    validerChampsCarte();
  }

  if (nomDuChamp === 'old-password' || nomDuChamp === 'new-password' || nomDuChamp === 'confirm-password') {
    validerChampsMotDePasse();
  } else if (validateurs[nomDuChamp]) {

    const messageErreur = validateurs[nomDuChamp](champ.value);
    const spanErreur = document.getElementById('erreur-' + nomDuChamp);

    if (spanErreur) {
      spanErreur.textContent = messageErreur || '';
    }
  }

  //On désactive la soumission si il y a des erreurs
  const spansErreur = document.querySelectorAll('.erreur');
  
  let formulaireEstValide = true;

  spansErreur.forEach(function(span) {
    if (span.textContent.trim() !== '') {
      formulaireEstValide = false;
    }
  });

  if(!formulaireEstValide){
    btnSubmit.disabled = true;
  }else{
    btnSubmit.disabled = false;
  }
});

/*form.addEventListener('submit', function(event) {
    event.preventDefault();

    fetch('?path=/pro/update/account', {
        method: 'POST',
        body: new FormData(form)
    })
    .then(reponse => reponse.json())
    .then(data => {
        console.log("Données reçues :", data);
    })
    .catch(error => {
        console.error('Erreur Fetch :', error);
    });
});*/