<?php
$head_title = "Configuration 2FA";
$head_subtitle = "AUTHENTIFICATION À DEUX FACTEURS";
$head_svg = "/assets/icons/account_white.svg";
include 'head_title.php';
include 'black_button.php';
?>

<div class="connection">
    <h3>Configuration de l'authentification à deux facteurs</h3>

    <div class="twofa-setup">
        <div class="step-instructions">
            <h4>Étape 1: Installez une application d'authentification</h4>
            <p>Téléchargez une application comme Google Authenticator, Authy, ou Microsoft Authenticator sur votre téléphone.</p>
        </div>

        <div class="step-instructions">
            <h4>Étape 2: Scannez le code QR</h4>
            <div class="qr-code-container">
                <img src="<?= htmlspecialchars($GLOBALS['data']['qr_code_uri']) ?>" alt="QR Code 2FA" class="qr-code">
            </div>

            <div class="manual-entry">
                <p><strong>Ou entrez manuellement cette clé:</strong></p>
                <code class="manual-key"><?= htmlspecialchars($GLOBALS['data']['manual_key']) ?></code>
                <button type="button" onclick="copyToClipboard('<?= htmlspecialchars($GLOBALS['data']['manual_key']) ?>')" class="copy-btn">Copier</button>
            </div>
        </div>

        <div class="step-instructions">
            <h4>Étape 3: Entrez le code de vérification</h4>
            <p>Entrez le code à 6 chiffres généré par votre application d'authentification:</p>

            <form method="POST" action="?path=/pro/2fa/setup/verify" id="setup-form">
                <div class="logInLines">
                    <input type="text"
                        placeholder="123456"
                        id="totp_code"
                        name="totp_code"
                        maxlength="6"
                        pattern="[0-9]{6}"
                        autocomplete="off"
                        required>
                    <div id="code-feedback" class="code-feedback"></div>
                    <?php if (isset($_GET["error"]) && $_GET["error"] === "invalid_code") { ?>
                        <p class="error">Code invalide. Veuillez réessayer.</p>
                    <?php } ?>
                </div>

                <nav class="submit-container">
                    <div class="buttonContainer">
                        <div class="buttonSubmit">
                            <?= black_button('Activer 2FA'); ?>
                        </div>
                    </div>
                </nav>
            </form>
        </div>
    </div>
</div>

<script>
    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Clé copiée dans le presse-papiers!');
        }, function(err) {
            console.error('Erreur lors de la copie: ', err);
        });
    }

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
                    body: JSON.stringify({
                        code: code
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        feedback.textContent = 'Code valide';
                        feedback.className = 'code-feedback valid';
                    } else {
                        feedback.textContent = 'Code invalide';
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

    // Auto-submit when valid code is entered
    document.getElementById('setup-form').addEventListener('submit', function(e) {
        const code = document.getElementById('totp_code').value;
        if (code.length !== 6) {
            e.preventDefault();
            alert('Veuillez entrer un code à 6 chiffres');
        }
    });
</script>
