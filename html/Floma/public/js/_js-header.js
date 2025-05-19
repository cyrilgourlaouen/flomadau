let sidenav = document.getElementById("mySidenav");
let openBtn = document.getElementById("BtnOpen");
let closeBtn = document.getElementById("BtnClose");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

window.addEventListener("resize" , closeMenu);

function openNav() {
  sidenav.classList.remove("hidden");
}

function closeNav() {
  sidenav.classList.add("hidden");
}

function closeMenu() {
  let width = window.innerWidth ;

  if(width > 460){
    sidenav.classList.add("hidden");
  }
}
  
