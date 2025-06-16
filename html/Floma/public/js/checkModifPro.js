btnModifier = document.getElementById('btn-modifier');

btnModifier.addEventListener('click', function() {
  //on affiche les elements cachés
  hide = document.querySelectorAll('.hidden');;
  console.log(hide);
  for(let i=0; i<hide.length; i++){
    hide[i].classList.remove('hidden')
  }

  //on active les inputs
  inputs = document.querySelectorAll('.not-active');;
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = false;
    inputs[j].classList.remove('not-active');
  }

  btnModifier.classList.add('hidden');
});