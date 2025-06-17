btnUpdate = document.getElementById('btn-update');
btnDeletePp = document.getElementById('btn-delete-pp');
btnCancelPp = document.getElementById('btn-cancel-pp');
btnCancel = document.getElementById('btn-cancel');
btnDeleteCard = document.getElementById('btn-delete-credit-card');
btnCancelCard = document.getElementById('btn-cancel-credit-card');
form = document.getElementById('form-pro');

/*Clic sur modifier*/

btnUpdate.addEventListener('click', function() {
  //on affiche les elements cachés
  hide = document.querySelectorAll('.hidden');;
  for(let i=0; i<hide.length; i++){
    hide[i].classList.remove('hidden');
    hide[i].classList.add('not-hidden');
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