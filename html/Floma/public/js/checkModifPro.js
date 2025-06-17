/*GESTION DES BOUTONS*/

let btnUpdate = document.getElementById('btn-update');
let btnDeletePp = document.getElementById('btn-delete-pp');
let btnCancelPp = document.getElementById('btn-cancel-pp');
let btnCancel = document.getElementById('btn-cancel');
let btnDeleteCard = document.getElementById('btn-delete-credit-card');
let btnCancelCard = document.getElementById('btn-cancel-credit-card');
let form = document.getElementById('form-pro');

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
    if (!/^0[1-9]\d{8}$/.test(valeur)) return "Format de téléphone invalide";
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
    if (!/^\d{9}$/.test(valeur)) return "Le numéro SIREN doit être composé de 9 chiffres";
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
    return null;
  },

  'code-postal': function(valeur) {
    if (!valeur) return "Le code postal est requis";
    if (!/^\d{5}$/.test(valeur)) return "Le code postal doit être composé de 5 chiffres";
    return null;
  },

  'card-number': function(valeur) {
    const numeroSansEspaces = valeur.replace(/\s/g, '');
    if (!/^\d{13,19}$/.test(numeroSansEspaces)) return "Numéro de carte invalide";
    return null;
  },

  'expiration-date': function(valeur) {
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
    if (!/^\d{3,4}$/.test(valeur)) return "Le CCV doit avoir 3 ou 4 chiffres";
    return null;
  }
};

form.addEventListener('input', function(event) {
  const champ = event.target;
  const nomDuChamp = champ.name;

  if (validateurs[nomDuChamp]) {
      const messageErreur = validateurs[nomDuChamp](champ.value);
      const spanErreur = document.getElementById('erreur-' + nomDuChamp);

      if (spanErreur) {
        spanErreur.textContent = messageErreur || '';
      }
  }

  //on active les inputs
  inputs = document.getElementsByClassName('not-active');
  for(let j=0; j<inputs.length; j++){
    
  }

  //on active les inputs
  inputs = document.querySelectorAll('.not-active');;
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = false;
    inputs[j].classList.remove('not-active');
    inputs[j].classList.add('active');
  }

  btnUpdate.classList.add('hidden');
});


/*Clic sur le btn annuler du formulaire*/

btnCancel.addEventListener('click', function() {
  form.reset();

  notHide = document.querySelectorAll('.not-hidden');;
  for(let i=0; i<notHide.length; i++){
    notHide[i].classList.remove('not-hidden');
    notHide[i].classList.add('hidden');
  }

  inputs = document.querySelectorAll('.active');;
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = true;
    inputs[j].classList.add('not-active');
  }

  if(document.getElementById('check-pp').classList.contains('hidden')){
    cancelPp();
    btnDeletePp.classList.add('hidden');
  }

  if(document.getElementById('check-card').classList.contains('hidden')){
    cancelCreditCard();
    btnDeleteCard.classList.add('hidden');
  }

  btnUpdate.classList.remove('hidden');
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


/*Suppression de la carte bancaire + annulation de la suppression*/
btnDeleteCard.addEventListener('click', function(){
  document.getElementById('check-card').classList.add('hidden');
  //Hidden différent pour l'afficher que si on clique sur supprimer
  document.getElementById('new-credit-card').classList.remove('hidden-credit-card');
  btnDeleteCard.classList.add('hidden');
  btnCancelCard.classList.remove('hidden-credit-card')
});


btnCancelCard.addEventListener('click', cancelCreditCard);

function cancelCreditCard(){
  document.getElementById('check-card').classList.remove('hidden');
  //Hidden différent pour l'afficher que si on clique sur supprimer
  document.getElementById('new-credit-card').classList.add('hidden-credit-card');
  btnCancelCard.classList.add('hidden-credit-card');
  btnDeleteCard.classList.remove('hidden');
}