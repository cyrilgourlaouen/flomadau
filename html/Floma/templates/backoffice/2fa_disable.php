<?php
$head_title = "Désactiver 2FA";
$head_subtitle = "AUTHENTIFICATION À DEUX FACTEURS";
$head_svg = "/assets/icons/warning_white.svg";
include 'head_title.php';
include 'black_button.php';
?>

<div class="connection">
    <div class="disable-confirmation">
        <h3>Désactiver l'authentification à deux facteurs</h3>
        
        <div class="warning-details">
            <p><strong>Attention!</strong> Désactiver la 2FA réduira la sécurité de votre compte.</p>
            <p>Sans la 2FA, votre compte sera uniquement protégé par votre mot de passe.</p>
        </div>
        
        <div class="confirmation-actions">
            <form method="POST" action="?path=/pro/2fa/disable">
                <input type="hidden" name="confirm" value="yes">
                
                <div class="button-group">
                    <nav class="submit-container">
                        <div class="buttonContainer danger">
                            <?= black_button('Oui, désactiver la 2FA'); ?>
                        </div>
                    </nav>
                </div>
            </form>
            
            <div class="cancel-action">
                <a href="?path=/pro" class="cancel-link">Annuler et garder la 2FA activée</a>
            </div>
        </div>
        
        <div class="security-reminder">
            <h4>Recommandations de sécurité:</h4>
            <ul>
                <li>Utilisez un mot de passe fort et unique</li>
                <li>Ne partagez jamais vos identifiants</li>
                <li>Considérez réactiver la 2FA plus tard</li>
            </ul>
        </div>
    </div>
</div>

<style>
.disable-confirmation {
    max-width: 500px;
    margin: 0 auto;
    text-align: center;
    padding: 2rem;
}

.disable-confirmation h3 {
    color: #dc3545;
    margin-bottom: 1.5rem;
}

.warning-details {
    background: #fff3cd;
    padding: 1.5rem;
    border-radius: 8px;
    margin: 1.5rem 0;
    border-left: 4px solid #ffc107;
}

.warning-details p {
    margin-bottom: 1rem;
    line-height: 1.6;
    text-align: left;
}

.warning-details p:last-child {
    margin-bottom: 0;
}

.confirmation-actions {
    margin: 2rem 0;
}

.button-group {
    margin-bottom: 1rem;
}

.buttonContainer.danger button {
    background-color: #dc3545;
}

.buttonContainer.danger button:hover {
    background-color: #c82333;
}

.cancel-action {
    margin-top: 1rem;
}

.cancel-link {
    color: #007cba;
    text-decoration: none;
    font-weight: bold;
}

.cancel-link:hover {
    text-decoration: underline;
}

.security-reminder {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
    text-align: left;
}

.security-reminder h4 {
    margin-bottom: 1rem;
    color: #333;
}

.security-reminder ul {
    list-style-type: disc;
    padding-left: 1.5rem;
}

.security-reminder li {
    margin-bottom: 0.5rem;
    line-height: 1.4;
}
</style>
