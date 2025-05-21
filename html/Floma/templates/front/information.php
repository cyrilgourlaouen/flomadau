<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body class="information">
    <?php
    $user = [
        'firstname' => 'Jean',
        'name' => 'Dupont',
        'pseudo' => 'jdup',
        'num' => '06 12 34 56 78',
        'email' => 'jean.dupont@example.com',
        'mdp' => 'dorian',
    ]
        ?>

    <div class="data-container">
        <form method="POST" class="personal-data">
            <div class="title">
                <h2>Informations personnelles</h2>
            </div>
            <div class="lines-container">
                <div class="lines">
                    <h3>Prénom*</h3>
                    <input class="input" type="text" name="firstname"
                        value="<?= htmlspecialchars($user['firstname']) ?>" disabled required>
                </div>
                <div class="lines">
                    <h3>Nom*</h3>
                    <input class="input" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" disabled
                        required>
                </div>
            </div>
            <div class="lines-container">
                <div class="lines">
                    <h3>Pseudonyme*</h3>
                    <input class="input" type="text" name="pseudo" value="<?= htmlspecialchars($user['pseudo']) ?>"
                        disabled required>
                </div>
                <div class="lines">
                    <h3>Numéro de téléphone*</h3>
                    <input class="input" type="text" name="num" value="<?= htmlspecialchars($user['num']) ?>" disabled
                        required>
                </div>
            </div>
            <div class="lines-container">
                <div class="lines , email">
                    <h3>Adresse e-mail*</h3>
                    <input class="input" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                        disabled required>
                </div>
            </div>
            <button class="UpdateBtn" id="UpdateBtn" type="button">
                <p>Modifier</p>
            </button>
            <button class="hidden" id="BtnValider" type="submit">
                <p>Valider</p>
            </button>
        </form>
        <form method="POST" class="personal-data">
            <div class="title">
                <h2>Changer de mot de passe</h2>
            </div>
            <div class="lines-container">
                <div class="lines">
                    <h3>Mot de passe actuel*</h3>
                    <div class="password">
                        <input class="inputPassword" id="inputPassword" type="password" name="mdp" required>
                        <button id="CheckPassword" type="button">
                            <p>Valider</p>
                        </button>
                    </div>

                </div>
            </div>
            <div class="lines-container">
                <div class="lines">
                    <h3>Nouveau mot de passe</h3>
                    <input id="newPassword" type="password" name="mdp_confirm" required disabled>
                </div>
                <div class="lines">
                    <h3>Confirmer le nouveau mot de passe</h3>
                    <input id="confirmPassword" type="password" name="mdp_confirm" required disabled>
                </div>
                <p id="message"></p>
            </div>
            <button id="submitPasswordBtn" type="submit">
                <p>Changement de mot de passe</p>
            </button>
        </form>
    </div>
    <script src="./js/_js-ConsultationMembre.js"></script>
</body>

</html>