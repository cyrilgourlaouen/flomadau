<?php
require_once dirname(__DIR__, 2) . '/src/Service/TwoFactorAuthService.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['code_pro'])) {
    $twoFactorService = new App\Service\TwoFactorAuthService();
    $userId = $_SESSION['code_pro'];
    $is2FAEnabled = $twoFactorService->isEnabled($userId);

    // Check if 2FA was just disabled
    $wasDisabled = isset($_GET['2fa_disabled']) && $_GET['2fa_disabled'] === '1';
?>

    <div class="security-status-card">
        <div class="security-header">
            <h4>Sécurité du compte</h4>
        </div>

        <?php if ($wasDisabled): ?>
            <div class="alert alert-warning">
                <strong>2FA désactivée:</strong> L'authentification à deux facteurs a été désactivée pour votre compte.
            </div>
        <?php endif; ?>

        <div class="security-content">
            <?php if ($is2FAEnabled): ?>
                <div class="status-enabled">
                    <span class="status-text">Authentification à deux facteurs activée</span>
                </div>
                <p class="status-description">Votre compte est protégé par la 2FA.</p>
                <div class="security-actions">
                    <a href="?path=/pro/2fa/disable" class="disable-2fa-link">Désactiver la 2FA</a>
                </div>
            <?php else: ?>
                <div class="status-disabled">
                    <span class="status-text">Authentification à deux facteurs non activée</span>
                </div>
                <p class="status-description">Renforcez la sécurité de votre compte en activant la 2FA.</p>
                <div class="security-actions">
                    <a href="?path=/pro/2fa/setup" class="setup-2fa-btn">Activer la 2FA</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

<?php
}
?>
