<?php
$head_title = "Vérification 2FA";
$head_subtitle = "AUTHENTIFICATION À DEUX FACTEURS";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
?>

<div class="connection">
    <h3>Vérification à deux facteurs</h3>
    
    <div class="twofa-verification">
        <p>Entrez le code à 6 chiffres généré par votre application d'authentification:</p>
        
        <form method="POST" action="?path=/pro/2fa/verify/submit" id="verification-form">
            <div class="logInLines">
                <input type="text" 
                       placeholder="123456" 
                       id="totp_code" 
                       name="totp_code" 
                       maxlength="6" 
                       pattern="[0-9]{6}"
                       autocomplete="off"
                       autofocus
                       required>
                <div id="code-feedback" class="code-feedback"></div>
                <?php if (isset($_GET["error"]) && $_GET["error"] === "invalid_code") { ?>
                    <p class="error">Code invalide. Veuillez réessayer.</p>
                <?php } ?>
            </div>
            
            <nav class="submit-container">
                <div class="buttonContainer">
                    <div class="buttonSubmit">
                        <?= black_button('Vérifier'); ?>
                    </div>
                </div>
            </nav>
        </form>
        
        <div class="login-help">
            <p><a href="?path=/pro/connexion">← Retour à la connexion</a></p>
            <p>Problème avec votre code? Assurez-vous que l'heure de votre appareil est correcte.</p>
        </div>
    </div>
</div>

<script>
// Real-time code verification
document.getElementById('totp_code').addEventListener('input', function() {
    const code = this.value;
    const feedback = document.getElementById('code-feedback');
    
    if (code.length === 6) {
        // Verify code via AJAX
        fetch('?path=/pro/2fa/ajax/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({code: code})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                feedback.textContent = 'Code valide';
                feedback.className = 'code-feedback valid';
                // Auto-submit after a short delay
                setTimeout(() => {
                    document.getElementById('verification-form').submit();
                }, 500);
            } else {
                feedback.textContent = '❌ Code invalide';
                feedback.className = 'code-feedback invalid';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            feedback.textContent = '';
            feedback.className = 'code-feedback';
        });
    } else {
        feedback.textContent = '';
        feedback.className = 'code-feedback';
    }
});

// Auto-focus and format input
document.getElementById('totp_code').addEventListener('keypress', function(e) {
    // Only allow numbers
    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab'].includes(e.key)) {
        e.preventDefault();
    }
});

// Auto-submit when valid code is entered
document.getElementById('verification-form').addEventListener('submit', function(e) {
    const code = document.getElementById('totp_code').value;
    if (code.length !== 6) {
        e.preventDefault();
        alert('Veuillez entrer un code à 6 chiffres');
    }
});
</script>

<style>
</style>
