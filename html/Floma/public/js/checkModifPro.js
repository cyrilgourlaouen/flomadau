btnModifier = document.getElementById('btn-modifier');

btnModifier.addEventListener('click', function() {
  //on affiche les elements cachés
  hide = document.getElementsByClassName('cache');
  for(let i=0; i<hide.length; i++){
    hide[i].classlist.remove('hide');
  }
});