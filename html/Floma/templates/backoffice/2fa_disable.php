<?php
$head_title = "Désactiver 2FA";
$head_subtitle = "AUTHENTIFICATION À DEUX FACTEURS";
$head_svg = "/assets/icons/account_white.svg";
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
                            <?= black_button('Désactiver'); ?>
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
