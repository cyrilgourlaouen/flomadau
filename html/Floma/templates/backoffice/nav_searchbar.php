<div id="nav_search">
    <div id="nav">
        <?php
            //Sous-en-tête pour offre
            $head_title = "OFFRES";
            $head_subtitle = $nbOffres;
            $head_svg = "/assets/icons/offer_white.svg";
            include 'info_box.php';

            //Sous-en-tête pour avis
            $head_title = "AVIS NON RÉPONDU";
            $head_subtitle = $nbAvisNonRepondu;
            $head_svg = "/assets/icons/avis_white.svg";
            include 'info_box.php';

            //Sous-en-tête pour facture
            $head_title = "AVIS NON CONSULTÉ";
            $head_subtitle = $nbAvisNonConsulte;
            $head_svg = "/assets/icons/eye_close_white.svg";
            include 'info_box.php';
        ?>
    </div>
    <div id="title_searchbar_btn">
        <h2 id="all_offer">Toutes mes offres</h2>
        <div id="searchbar_all_btn">
            <div id="searchbar_white_btn">
                <form action="" method="">
                    <input type="search" id="input_search" name="recherche" placeholder="Rechercher">
                </form>
            </div>
            <div id="blue_btn">
                <a href="?path=/offre/creation">
                    <button id="btn_ajouter">Ajouter</button>
                </a>
            </div>
        </div>
    </div>
</div>