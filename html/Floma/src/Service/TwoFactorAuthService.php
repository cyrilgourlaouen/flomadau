<?php

namespace App\Service;

// Include Composer autoloader for OTPHP library
require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use OTPHP\TOTP;
use App\Manager\TwoFactorAuthManager;

class TwoFactorAuthService
{
    private TwoFactorAuthManager $twoFactorManager;
    
    public function __construct()
    {
        $this->twoFactorManager = new TwoFactorAuthManager();
    }
    
    /**
     * Generate a new TOTP secret for a user
     */
    public function generateSecret(int $professionalCode, string $email): array
    {
        // Create TOTP instance
        $totp = TOTP::create();
        $totp->setLabel($email);
        $totp->setIssuer('PACT Pro'); // Your app name
        
        $secret = $totp->getSecret();
        
        // Store the secret temporarily in session during setup
        // Will be moved to database only after successful verification
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['2fa_setup_secret'] = $secret;
        $_SESSION['2fa_setup_user'] = $professionalCode;
        
        // Generate QR code URI
        $qrCodeUri = $totp->getQrCodeUri(
            'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={PROVISIONING_URI}',
            '{PROVISIONING_URI}'
        );
        
        return [
            'secret' => $secret,
            'qr_code_uri' => $qrCodeUri,
            'manual_entry_key' => $secret
        ];
    }
    
    /**
     * Verify a TOTP code for a user
     */
    public function verifyCode(int $professionalCode, string $code): bool
    {
        $secret = null;
        
        // First check if we're in setup mode (secret in session)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (isset($_SESSION['2fa_setup_secret']) && 
            isset($_SESSION['2fa_setup_user']) && 
            $_SESSION['2fa_setup_user'] == $professionalCode) {
            $secret = $_SESSION['2fa_setup_secret'];
        } else {
            // Check database for existing secret
            $secret = $this->twoFactorManager->getSecret($professionalCode);
        }
        
        if (!$secret) {
            return false;
        }
        
        $totp = TOTP::create($secret);
        
        // Verify the code with a window of ±1 period (30 seconds each)
        return $totp->verify($code, null, 1);
    }
    
    /**
     * Check if user has 2FA enabled
     */
    public function isEnabled(int $professionalCode): bool
    {
        return $this->twoFactorManager->isEnabled($professionalCode);
    }
    
    /**
     * Enable 2FA for a user (after successful verification)
     */
    public function enable(int $professionalCode): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Move secret from session to database
        if (isset($_SESSION['2fa_setup_secret']) && 
            isset($_SESSION['2fa_setup_user']) && 
            $_SESSION['2fa_setup_user'] == $professionalCode) {
            
            $secret = $_SESSION['2fa_setup_secret'];
            $this->twoFactorManager->setSecret($professionalCode, $secret);
            
            // Clean up session
            unset($_SESSION['2fa_setup_secret']);
            unset($_SESSION['2fa_setup_user']);
        }
    }
    
    /**
     * Disable 2FA for a user
     */
    public function disable(int $professionalCode): void
    {
        $this->twoFactorManager->disable($professionalCode);
    }
    
    /**
     * Remove 2FA data for a user (same as disable in simple approach)
     */
    public function remove(int $professionalCode): void
    {
        $this->disable($professionalCode);
    }
    
    /**
     * Clean up any temporary setup data from session
     */
    public function cleanupSetup(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        unset($_SESSION['2fa_setup_secret']);
        unset($_SESSION['2fa_setup_user']);
    }
    
    /**
     * Check if user is currently in setup mode
     */
    public function isInSetupMode(int $professionalCode): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['2fa_setup_secret']) && 
               isset($_SESSION['2fa_setup_user']) && 
               $_SESSION['2fa_setup_user'] == $professionalCode;
    }
}
