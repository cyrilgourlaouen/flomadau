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
  
document.addEventListener("DOMContentLoaded", function () {
		const logBtn = document.getElementById("logBtn");
		const logMenu = document.getElementById("logMenu");

		logBtn.addEventListener("click", function (e) {
			e.preventDefault();
			logMenu.classList.toggle("hidden");
		});

		document.addEventListener("click", function (e) {
			if (!logBtn.contains(e.target) && !logMenu.contains(e.target)) {
				logMenu.classList.add("hidden");
			}
		});
	});