<header>
	<div class="top_header">
		<a href="#" id="BtnOpen" class="btnBurger"><img src="/assets/icons/menu-burger-white.svg" alt="menu burger"></a>
		<img class="logo" src="/assets/images/logo_entier_white.svg" alt="logo">
		<div class="menu_nav">
			<a href="#" class="PostOffer">
				<h2>Publier une offre</h2>
			</a>
			<a href="#" class="search"><img src="/assets/icons/search_white.svg" alt="loupe" class="ImgSearch"></a>
			<a href="#" class="logIn"><img src="/assets/icons/logIn.svg" alt="logIn" class="ImgLogIn"></a>
		</div>
	</div>

	<div id="mySidenav" class="sidenav hidden">
		<div class="menu">
			<a id="BtnClose" href="#" class="close"><img src="/assets/icons/Flèche.svg" alt="flèche"></a>
			<h1>Menu</h1>
			<a href="#">
				<img src="/assets/icons/discover.svg" alt="discover">
				<h1>Découvrez nos offres</h1>
			</a>
			<a href="#">
				<img src="/assets/icons/diamond.svg" alt="diamond">
				<h1>Sélection du moment</h1>
			</a>
			<a href="#">
				<img src="/assets/icons/recent_search.svg" alt="recent_search">
				<h1>Consulté récement</h1>
			</a>
			<hr>
			<a href="#">
				<img src="/assets/icons/logIn.svg" alt="log in">
				<h1>Connexion / Inscription</h1>
			</a>
		</div>
		<nav>
			<h2>Mentions légales</h2>
			<h2>Politique de confidentialité</h2>
			<img src="/assets/images/logo_entier_white.svg" alt="logo">
		</nav>
	</div>
</header>

<script>
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
</script>