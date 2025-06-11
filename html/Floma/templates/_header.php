<header>
	<?php 
		session_start();
	?>
	<div class="top_header">
		<a href="#" id="BtnOpen" class="btnBurger"><img src="/assets/icons/menu_burger_white.svg"
				alt="Icone de menu burger"></a>
		<a href="/"><img class="logo" src="/assets/images/logo_entier_blanc.svg" alt="logo"></a>
		<div class="menu_nav">
			<a href="#" class="postOffer">
				<h3 class="txtPostOffer">Publier une offre</h3>
			</a>
			<a href="#" class="search"><img src="/assets/icons/search_white.svg" alt="loupe" class="ImgSearch"></a>
			<?php if (!isset($_SESSION['email'])) { ?>
				<a class="logBtn" id="logBtn"><img class="imgLog"
						src="/assets/icons/menu_logIn_white.svg" alt="Icon de connexion"></a>
				<div id="logMenu" class="logMenu hidden">
					<ul>
						<li><a href="?path=/connexion">Se connecter</a></li>
					</ul>
				</div>
			<?php } else { ?>
				<a class="logBtn" id="logBtn"><img class="imgLogOut"
						src="/assets/icons/login_white.svg" alt="Icon de déconnexion"></a>
				<div id="logMenu" class="logMenu hidden">
					<ul>
						<li><a href="?path=/profil">Mes informations</></li>
						<li><a href="?path=/connexion/logOut">Se déconnecter</a></li>
					</ul>
				</div>
			<?php } ?>
		</div>
	</div>

	<!-- TODO: Ajouter les liens dur les pages -->
	<div id="mySidenav" class="sidenav hidden">
		<div class="menu">
			<a id="BtnClose" href="#" class="close"><img src="/assets/icons/chevron_left_white.svg"
					alt="Chevron vers la gauche"></a>
			<h2>Menu</h2>
			<a href="#" class="action">
				<img src="/assets/icons/discover_white.svg" alt="Icone boussole">
				<h2>Découvrez nos offres</h2>
			</a>
			<a href="#" class="action">
				<img src="/assets/icons/diamond_white.svg" alt="Icone de diamant">
				<h2>Sélection du moment</h2>
			</a>
			<a href="#" class="action">
				<img src="/assets/icons/recent_search_white.svg" alt="Icone de recherche récente">
				<h2>Consulté récement</h2>
			</a>
			<hr>
			<?php if (!isset($_SESSION['email'])) { ?>
				<a href="?path=/connexion" class="action">
					<img src="/assets/icons/login_white.svg" alt="Icone de connexion">
					<h2>Connexion / Inscription</h2>
				</a>
			<?php } else { ?>
				<a href="#" class="action">
					<img class="checkBtn" src="/assets/icons/check_white.svg" alt="Icone de consultation">
					<h2>Consulté mes informations</h2>
				</a>
				<a href="?path=/connexion/logOut" class="action">
					<img src="/assets/icons/login_white.svg" alt="Icone de connexion">
					<h2>Déconnexion</h2>
				</a></h3>
			<?php } ?>
		</div>
		<nav>
			<a href="https://entreprendre.service-public.fr/vosdroits/F31228" class="nav-hover">
				<h3>Mentions légales</h3>
			</a>
			<a href="https://www.economie.gouv.fr/politique-confidentialite" class="nav-hover">
				<h3>Politique de confidentialité</h3>
			</a>
			<img src="/assets/images/logo_entier_blanc.svg" alt="logo">
		</nav>
	</div>
	<script src="./js/_js-header.js"></script>
</header>