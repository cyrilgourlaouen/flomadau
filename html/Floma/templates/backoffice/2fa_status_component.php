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
    
    <style>
    .security-status-card {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1.5rem;
        margin: 1rem 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .security-header h4 {
        margin: 0 0 1rem 0;
        color: #333;
        font-size: 1.2em;
    }
    
    .alert {
        padding: 1rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
    
    .alert-warning {
        background-color: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
    }
    
    .status-enabled, .status-disabled {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .status-text {
        font-weight: bold;
        font-size: 1.1em;
    }
    
    .status-enabled .status-text {
        color: #28a745;
    }
    
    .status-disabled .status-text {
        color: #ffc107;
    }
    
    .status-description {
        color: #666;
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    
    .security-actions {
        margin-top: 1rem;
    }
    
    .setup-2fa-btn {
        background: #007cba;
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        font-weight: bold;
        transition: background-color 0.2s;
    }
    
    .setup-2fa-btn:hover {
        background: #005a87;
        text-decoration: none;
        color: white;
    }
    
    .disable-2fa-link {
        color: #dc3545;
        text-decoration: none;
        font-size: 0.9em;
    }
    
    .disable-2fa-link:hover {
        text-decoration: underline;
    }
    </style>
    
    <?php
}
?>
