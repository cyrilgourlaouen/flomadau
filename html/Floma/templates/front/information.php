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
        'num' => '0612345678',
        'email' => 'jean.dupont@example.com',
        'mdp' => '',
    ]
        ?>

    <div class="consultation">
        <div class="form-update">
            <div class="logo">
                <img src="/assets/pictures/Logo_bleu.svg" alt="logo">
            </div>
            <form method="POST" class="personal-data">
                <div class="title">
                    <h2>Informations personnelles</h2>
                </div>
                <div class="lines">
                    <h3>Prénom*</h3>
                    <div class="input-container">
                        <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>" disabled required>
                        <a href="#"><img src="/assets/icons/pencil_black.svg" alt="pencil"></a> 
                    </div>
                    <h3>Nom*</h3>
                    <div class="input-container">
                        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" disabled required>
                        <a href="#"><img src="/assets/icons/pencil_black.svg" alt="pencil"></a> 
                    </div>
                </div>
                <div class="lines">
                    <h3>Pseudonyme*</h3>
                    <div class="input-container">
                        <input type="text" name="pseudo" value="<?= htmlspecialchars($user['pseudo']) ?>"  disabled required>
                        <a href="#"><img src="/assets/icons/pencil_black.svg" alt="pencil"></a> 
                    </div>
                    <h3>Numéro de téléphone*</h3>
                    <div class="input-container">
                        <input type="text" name="num" value="<?= htmlspecialchars($user['num'])  ?>" disabled required >
                        <a href="#"><img src="/assets/icons/pencil_black.svg" alt="pencil"></a> 
                    </div>
                </div>
                <div class="lines">
                    <h3>Adresse e-mail*</h3>
                    <div class="input-container">
                        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" disabled required>
                        <a href="#"><img src="/assets/icons/pencil_black.svg" alt="pencil"></a> 
                    </div>
                </div>
                <button class="submit-button" type="submit">
                    <p>Valider</p>
                </button>
            </form>
            <form method="POST" class="personal-data">
                <div class="title">
                    <h2>Changer de mot de passe</h2>
                </div>
                <div class="lines mdp">
                    <h3>Mot de passe actuel*</h3>
                    <input type="password" name="mdp" required >
                    <h3>Nouveau mot de passe*</h3>
                    <input type="password" name="mdp_confirm" required disabled>
                </div>
                <button class="submit-button" type="submit">
                    <p>Changement de mot de passe</p>
                </button>
            </form>
        </div>
        <img src="/assets/pictures/picture-3.jpg" alt="img" class="picture-consultation">
    </div>
</body>

</html>