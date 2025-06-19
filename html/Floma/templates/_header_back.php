<header>
    <div id="menuContent">
        <a href="index.php?path=/pro"><img src="/assets/images/logo_blue.png" alt="Logo" class="logo"></a>
        <div id="menuTextContainer">
            <h2>MENU</h2>
            <ul id="sidebar-menu">
                <li id="menu-home">
                    <a href="index.php?path=/pro">Accueil</a>
                </li>
                <?php
                    if(isset($_SESSION['code_pro'])){
                        ?>
                            <li id="menu-info">
                                <a href="index.php?path=/pro/check">Informations</a>
                            </li>
                            <li id="menu-logout">
                                <a href="index.php?path=/pro/connexion/logout">Déconnexion</a>
                            </li>
                        <?php
                    }
                ?>
                <li id="menu-return">
                    <a href="index.php?path=/">Retour au site</a>
                </li>
                <!-- <li id="menu-offers"><a href="#"> -->
                <!--         <h2>Offres</h2> -->
                <!--     </a></li> -->
                <!-- <li id="menu-avis"><a href="#"> -->
                <!--         <h2>Avis</h2> -->
                <!--     </a></li> -->
                <!-- <li id="menu-factures"><a href="#"> -->
                <!--         <h2>Factures</h2> -->
                <!--     </a></li> -->
            </ul>
        </div>
    </div>
</header>
