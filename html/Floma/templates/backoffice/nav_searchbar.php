<div id="nav_search">
    <div id="nav">
        <?php
            //Sous-en-tête pour offre
            $head_title = "OFFRES";
            $head_subtitle = $nb_offres;
            $head_svg = "/assets/icons/offer_white.svg";
            include 'little_title.php';

            //Sous-en-tête pour avis
            $head_title = "AVIS";
            $head_subtitle = $nb_avis;
            $head_svg = "/assets/icons/avis_white.svg";
            include 'little_title.php';

            //Sous-en-tête pour facture
            $head_title = "FACTURE : $mois";
            $head_subtitle = "0€";
            $head_svg = "/assets/icons/facture_white.svg";
            include 'little_title.php';
        ?>
    </div>
    <div id="title_searchbar_btn">
        <h2 id="all_offer">Toutes mes offres</h2>
        <div id="searchbar_all_btn">
            <div id="searchbar_white_btn">
                <form action="" method="">
                    <input type="search" id="input_search" name="recherche" placeholder="Rechercher" disabled>
                </form>
                <?php 
                    echo button('Filtrer', 'btn_filtrer');    
                ?>
                <?php 
                    echo button('Trier', 'btn_trier');    
                ?>
            </div>
            <div id="blue_btn">
                <?php 
                    echo button('Ajouter', 'btn_ajouter');    
                ?>
            </div>
        </div>
    </div>
</div>