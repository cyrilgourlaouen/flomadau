const stars = document.querySelectorAll('#star-container img');
const noteInput = document.getElementById('note-input');
let selectedNote = 0;

stars.forEach(star => {
  star.addEventListener('click', () => {
    selectedNote = parseInt(star.dataset.starValue);

    stars.forEach(s => {
      const val = parseInt(s.dataset.starValue);
      s.src = val <= selectedNote
        ? "/assets/icons/star_pink.svg"           
        : "/assets/icons/star_outline_pink.svg";  
    });
    noteInput.value = selectedNote;
  });
});
