<div id="nav_search">
    <div id="nav">
        <?php
            //Sous-en-tête pour offre
            $head_title = "OFFRES";
            $head_subtitle = $nbOffres;
            $head_svg = "/assets/icons/offer_white.svg";
            include 'little_title_without_h1.php';

            //Sous-en-tête pour avis
            $head_title = "AVIS NON RÉPONDU";
            $head_subtitle = $nbAvisNonConsulte;
            $head_svg = "/assets/icons/avis_white.svg";
            include 'little_title_without_h1.php';

            //Sous-en-tête pour facture
            $head_title = "AVIS NON CONSULTÉ";
            $head_subtitle = $nbAvisNonRepondu;
            $head_svg = "/assets/icons/eye_close_white.svg";
            include 'little_title_without_h1.php';
        ?>
    </div>
    <div id="title_searchbar_btn">
        <h2 id="all_offer">Toutes mes offres</h2>
        <div id="searchbar_all_btn">
            <div id="searchbar_white_btn">
                <form action="" method="">
                    <input type="search" id="input_search" name="recherche" placeholder="Rechercher" disabled>
                </form>
                <?= button('Filtrer', 'btn_filtrer'); ?>
                <?= button('Trier', 'btn_trier'); ?>
            </div>
            <div id="blue_btn">
                <?= button('Ajouter', 'btn_ajouter'); ?>
            </div>
        </div>
    </div>
</div>