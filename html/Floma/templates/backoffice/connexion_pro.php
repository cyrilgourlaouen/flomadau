<?php
$head_title = "Connexion au compte";
$head_subtitle = "IDENTIFICATION";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php'
?>
<div class="connection">
    <h3>Connexion</h3>
    <div class="logMember">
        <form method="POST" action="?path=/pro/connexion/login">
            <hr class="barCompte">
            <div class="logInLines">
                <p>Identifiant</p>
                <input type="text" placeholder="Dénomination sociale" id="raison_sociale" name="raison_sociale" required>
            </div>
            <div class="logInLines">
                <p>Mot de passe</p>
                <input type="password" id="password" name="password" required>
                <?php if (isset($_GET["state"]) && $_GET["state"] === "failure") { ?>
                        <p class="error">Erreur email ou mot de passe incorrect</p>
                <?php } ?>
            </div>
            <hr class="barCompte">
            <p>Si vous n'avez pas de compte <a href="index.php?path=/pro/signup">inscrivez-vous</a></p>
            <nav class="submit-container">
                <div class="buttonContainer">
                    <div class="buttonSubmit">
                        <?= black_button('Se connecter'); ?>
                    </div>
                </div>
            </nav>
        </form>
    </div>
</div>

</html>