var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("BtnOpen");
var closeBtn = document.getElementById("BtnClose");

openBtn.onclick = openNav;
closeBtn.onclick = closeNav;

function openNav() {
  sidenav.classList.remove("hidden");
}

function closeNav() {
  sidenav.classList.add("hidden");
}
