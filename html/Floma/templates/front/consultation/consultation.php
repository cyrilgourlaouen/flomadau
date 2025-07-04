<?php $compte = $_SESSION; ?>
<div class="information-data-container">
    <form method="POST" class="personal-data" action="?path=/update/membre">
        <input type="hidden" name="id_compte" value="<?= htmlspecialchars($compte['id']) ?>">
        <div class="title">
            <h2>Informations personnelles</h2>
        </div>
        <div class="lines-container">
            <div class="lines">
                <h3>Prénom*</h3>
                <input class="input" type="text" name="firstname" oninput="this.= this.value.replace(/[^a-zA-ZÀ-ÿ\s\-']/g, '')" value="<?= htmlspecialchars($compte['prenom']) ?>"
                    disabled required>
            </div>
            <div class="lines">
                <h3>Nom*</h3>
                <input class="input" type="text" name="name" oninput="this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s\-']/g, '')" value="<?= htmlspecialchars($compte['nom']) ?>" disabled
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
                <input class="input" type="tel" name="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="10" name="num"  value="<?= htmlspecialchars($compte['telephone']) ?>" disabled
                    required>
            </div>
        </div>
        <div class="lines-container">
            <div class="lines email">
                <h3>Adresse e-mail*</h3>
                <input id="emailInput" class="input" type="email" name="email" value="<?= htmlspecialchars($compte['email']) ?>" disabled
                    required>
                <p id="emailMessage"></p>
            </div>
        </div>
        <button class="UpdateBtn" id="UpdateBtn" type="button">
            <p>Modifier</p>
        </button>
        <div class="BtnLines">
            <button class="hidden" id="BtnCancel" type="button">
                <p>Annuler</p>
            </button>
            <button class="hidden" id="BtnValider" type="submit">
                <p>Valider</p>
            </button>
        </div>
    </form>
    <div class="personal-data">
    <div class="title">
        <h2>Changer de mot de passe</h2>
    </div>

    <div class="lines-container">
        <div class="lines">
            <h3>Mot de passe actuel*</h3>
            <div class="password">
                <input id="inputPassword" class="inputPassword" type="password" required>
                <button id="checkPasswordBtn" type="button"><p>Valider</p></button>
            </div>
            <p id="message"></p>
        </div>
        <div class="lines">
            <h3>Nouveau mot de passe</h3>
            <input id="newPassword" type="password" name="new_password" required disabled>
        </div>

        <div class="lines">
            <h3>Confirmer le nouveau mot de passe</h3>
            <input id="confirmPassword" type="password" name="confirm_password" required disabled>
            <p id="messageNewPassword"></p>
        </div>

        <div class="BtnLines">
            <button id="BtnCancelPassword" type="button">
                <p>Annuler</p>
            </button>
            <button id="submitPasswordBtn" type="button" disabled>
                <p>Changer de mot de passe</p>
            </button>
        </div>
    </div>
</div>
<script src="./js/_js-ConsultationMembre.js"></script>



