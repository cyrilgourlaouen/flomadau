btnModifier = document.getElementById('btn-modifier');

btnModifier.addEventListener('click', function() {
  //on affiche les elements cachés
  hide = document.getElementsByClassName('cache');
  for(let i=0; i<hide.length; i++){
    hide[i].classlist.remove('hide');
  }

  //on active les inputs
  inputs = document.getElementsByClassName('not-active');
  for(let j=0; j<inputs.length; j++){
    
  }
});