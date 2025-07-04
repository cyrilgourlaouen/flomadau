<header>
	<div class="top_header">
		<a href="#" id="BtnOpen" class="btnBurger"><img src="/assets/icons/menu_burger_white.svg"
				alt="Icone de menu burger"></a>
		<a href="/"><img class="logo" src="/assets/images/logo_entier_blanc.svg" alt="logo"></a>
		<div class="menu_nav">
			<a href="?path=/pro/connexion" class="postOffer">
				<h3 class="txtPostOffer">Publier une offre</h3>
			</a>
			<a href="/#offer-section" class="search"><img src="/assets/icons/search_white.svg" alt="loupe" class="ImgSearch"></a>
			<?php if (!isset($_SESSION['email'])) { ?>
				<img class="imgLog" id="logBtn" src="/assets/icons/login_white.svg" alt="Icon de connexion">
				<div id="logMenu" class="logMenu hidden">
					<ul>
						<li><a href="?path=/connexion">Se connecter</a></li>
					</ul>
				</div>
			<?php } else { ?>
				<img class="imgLogOut imgProfil" id="logBtn"
					src="uploads/profilePicture/<?= htmlspecialchars(isset($_SESSION['url_photo_profil']) ? $_SESSION['url_photo_profil'] : 'pp_compte_defaut.jpg') ?>"
					alt="Icon de déconnexion">
				<div id="logMenu" class="logMenu hidden">
					<ul>
						<li><a href="?path=/consultation/membre">Mes informations</a></li>
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
			<a href="/#offer-section" class="action" onClick="closeNav()">
				<img src="/assets/icons/discover_white.svg" alt="Icone boussole">
				<h2>Découvrez nos offres</h2>
			</a>
			<a href="/#highlighted-offers-section" class="action" onClick="closeNav()">
				<img src="/assets/icons/diamond_white.svg" alt="Icone de diamant">
				<h2>Sélection du moment</h2>
			</a>
			<hr>
			<?php if (!isset($_SESSION['email'])) { ?>
				<a href="?path=/connexion" class="action">
					<img src="/assets/icons/login_white.svg" alt="Icone de connexion">
					<h2>Connexion / Inscription</h2>
				</a>
			<?php } else { ?>
				<a href="?path=/consultation/membre" class="action">
					<img class="checkBtn" src="/assets/icons/check_white.svg" alt="Icone de consultation">
					<h2>Consulté mes informations</h2>
				</a>
				<a href="?path=/connexion/logOut" class="action">
					<img src="/assets/icons/login_white.svg" alt="Icone de connexion">
					<h2>Déconnexion</h2>
				</a>
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