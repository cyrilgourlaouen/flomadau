<?php
$head_title = "Connexion au compte";
$head_subtitle = "IDENTIFICATION";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="connection-page">
    <div class="main">
        <div class="connection">
            <img src="/assets/images/logo_entier_bleu.svg" alt="logo">
            <div class="title-connexion">
                <h2>Connexion</h2>
                <hr>
            </div>
            <div class="logMember">
                <form method="POST" class="form">
                    <div class="logInLines">
                        <h2>Identifiant</h2>
                        <input type="text" placeholder="Dénomination sociale">
                    </div>
                    <div class="logInLines">
                        <h2>Mot de passe</h2>
                        <input type="password" id="password" name="password">
                    </div>
                    <p>Si vous n'avez pas de compte <a href="">inscrivez-vous</a></p>
                    <nav class="submit-container">
                        <button type="submit">
                            <p>Se connecter</p>
                        </button>
                    </nav>
                </form>
            </div>
        </div>
    </div>
</body>
</html>