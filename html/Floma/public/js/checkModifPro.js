btnModifier = document.getElementById('btn-modifier');

btnModifier.addEventListener('click', function() {
  //on affiche les elements cachés
  hide = document.getElementsByClassName('cache');
  for(let i=0; i<hide.length; i++){
    hide[i].classList.remove('cache');
    console.log(hide[i]);
  }

  //on active les inputs
  inputs = document.getElementsByClassName('not-active');
  for(let j=0; j<inputs.length; j++){
    inputs[j].disabled = false;
  }

  btnModifier.classList.add('cache');
});