<?php $compte = $_SESSION;?>
<div class="information-data-container">
    <form method="POST" class="personal-data">
        <div class="title">
            <h2>Informations personnelles</h2>
        </div>
        <div class="lines-container">
            <div class="lines">
                <h3>Prénom*</h3>
                <input class="input" type="text" name="firstname" value="<?= htmlspecialchars($compte['prenom']) ?>"
                    disabled required>
            </div>
            <div class="lines">
                <h3>Nom*</h3>
                <input class="input" type="text" name="name" value="<?= htmlspecialchars($compte['nom']) ?>" disabled
                    required>
            </div>
        </div>
        <div class="lines-container">
            <div class="lines">
                <h3>Pseudonyme*</h3>
                <input class="input" type="text" name="pseudo" value="<?= htmlspecialchars($compte['membreData'][0]['pseudo']) ?>" disabled
                    required>
            </div>
            <div class="lines">
                <h3>Numéro de téléphone*</h3>
                <input class="input" type="text" name="num" value="<?= htmlspecialchars($compte['telephone']) ?>" disabled
                    required>
            </div>
        </div>
        <div class="lines-container">
            <div class="lines , email">
                <h3>Adresse e-mail*</h3>
                <input class="input" type="email" name="email" value="<?= htmlspecialchars($compte['email']) ?>" disabled
                    required>
            </div>
        </div>
        <button class="UpdateBtn" id="UpdateBtn" type="button">
            <p>Modifier</p>
        </button>
        <button class="hidden" id="BtnValider" type="submit">
            <p>Valider</p>
        </button>
    </form>
    <div class="personal-data">
        <div class="title">
            <h2>Changer de mot de passe</h2>
        </div>
        <form method="POST" class="lines-container">
            <div class="lines">
                <h3>Mot de passe actuel*</h3>
                <div class="password">
                    <input class="inputPassword" id="inputPassword" type="password" name="mdp" required>
                    <button id="CheckPassword" type="submit">
                        <p>Valider</p>
                    </button>
                </div>
            </div>
        </form>
        <form method="POST" class="lines-container">
            <div class="lines">
                <h3>Nouveau mot de passe</h3>
                <input id="newPassword" type="password" name="mdp_confirm" required disabled>
            </div>
            <div class="lines">
                <h3>Confirmer le nouveau mot de passe</h3>
                <input id="confirmPassword" type="password" name="mdp_confirm" required disabled>
            </div>
            <p id="message"></p>
            <button id="submitPasswordBtn" type="submit">
                <p>Changement de mot de passe</p>
            </button>
        </form>
    </div>


    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $motDePasseSaisi = $_POST["mdp"];
        if (password_verify($motDePasseSaisi, $user['mot_de_passe'])) {
            echo "Mot de passe correct.";
        } else {
            echo "Mot de passe incorrect.";
        }
    }
    ?>
</div>
<script src="./js/_js-ConsultationMembre.js"></script>



