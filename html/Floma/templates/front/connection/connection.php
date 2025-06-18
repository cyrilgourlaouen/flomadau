<div class="main">
     <a href="/" class="undoBtn"><img src="/assets/icons/chevron_left_black.svg" alt="logo"></a>
    <div class="connection">
        <a href="/"><img src="/assets/images/logo_entier_bleu.svg" alt="logo"></a>
        <div class="title-connexion">
            <h2>Connexion</h2>
            <hr>
        </div>
        <div class="logMember">
            <form method="POST" class="form" action="?path=/connexion/logIn">
                <div class="logLines">
                    <label for="email">
                        <h2>E-mail</h2>
                    </label>
                    <input class="formBtnEmail" type="email" id="email" name="email" required>
                </div>
                <div class="logLines">
                    <label for="password">
                        <h2>Mot de passe</h2>
                    </label>
                    <input class="formBtnPassword" type="password" id="password" name="password" required>
                    <?php if (isset($_GET["state"]) && $_GET["state"] === "failure") { ?>
                        <p class="error">Erreur email ou mot de passe incorrect</p>
                    <?php } ?>
                </div>
                <p>Si vous n'avez pas de compte <a href="?path=/inscription/membre">inscrivez-vous</a></p>
                <nav class="submit-container">
                    <button type="submit">
                        <p>Se connecter</p>
                    </button>
                </nav>
            </form>
        </div>
        <div class="logPro">
            <h2 class="pro">Professionnel</h2>
            <hr>
            <p>Si vous êtes professionnel <a href="http://localhost:8080/?path=/pro/connexion">connectez-vous</a></p>
        </div>
    </div>
    <img class="right-img" src="/assets/images/monaco.png" alt="monaco">
</div>