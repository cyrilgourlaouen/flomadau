<?php
$head_title = "2FA Activée";
$head_subtitle = "SUCCÈS";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
?>

<div class="connection">
    <div class="success-message">
        <h3><?= htmlspecialchars($GLOBALS['data']['message']) ?></h3>
        
        <div class="success-details">
            <p>Votre compte est maintenant protégé par l'authentification à deux facteurs.</p>
            <p>À chaque connexion, vous devrez entrer un code généré par votre application d'authentification.</p>
        </div>
        
        <nav class="submit-container">
            <div class="buttonContainer">
                <a href="?path=/pro" class="button-link">
                    <?= black_button('Continuer'); ?>
                </a>
            </div>
        </nav>
        
        <div class="additional-info">
            <h4>Conseils de sécurité:</h4>
            <ul>
                <li>Gardez votre téléphone en sécurité</li>
                <li>Sauvegardez vos codes de récupération si votre app les propose</li>
                <li>Ne partagez jamais vos codes avec personne</li>
            </ul>
        </div>
    </div>
</div>

<style>
.success-message {
    max-width: 500px;
    margin: 0 auto;
    text-align: center;
    padding: 2rem;
}

.success-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.success-message h3 {
    color: #28a745;
    margin-bottom: 1.5rem;
}

.success-details {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.success-details p {
    margin-bottom: 1rem;
    line-height: 1.6;
}

.success-details p:last-child {
    margin-bottom: 0;
}

.button-link {
    text-decoration: none;
}

.additional-info {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
    text-align: left;
}

.additional-info h4 {
    margin-bottom: 1rem;
    color: #333;
}

.additional-info ul {
    list-style-type: disc;
    padding-left: 1.5rem;
}

.additional-info li {
    margin-bottom: 0.5rem;
    line-height: 1.4;
}
</style>
