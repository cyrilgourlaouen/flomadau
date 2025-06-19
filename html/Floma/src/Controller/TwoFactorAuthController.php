<?php

namespace App\Controller;

// Include Composer autoloader for OTPHP library
require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use App\Service\TwoFactorAuthService;
use App\Manager\CompteManager;
use Floma\Controller\AbstractController;

class TwoFactorAuthController extends AbstractController
{
    private TwoFactorAuthService $twoFactorService;
    
    public function __construct()
    {
        $this->twoFactorService = new TwoFactorAuthService();
    }
    
    /**
     * Show 2FA setup page with QR code
     */
    public function setup()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is logged in
        if (!isset($_SESSION['code_pro'])) {
            return $this->redirectToRoute('/pro/connexion');
        }
        
        $userId = $_SESSION['code_pro'];
        
        // Get user email for QR code label
        $compteManager = new CompteManager();
        $compte = $compteManager->findOneBy(['id' => $userId]);
        
        if (!$compte) {
            return $this->redirectToRoute('/pro');
        }
        
        // Check if 2FA is already enabled
        if ($this->twoFactorService->isEnabled($userId)) {
            return $this->renderView(
                'backoffice/2fa_already_enabled.php',
                [
                    'seo' => [
                        'title' => 'Authentification à deux facteurs',
                        'description' => '2FA déjà activée'
                    ]
                ]
            );
        }
        
        // Generate new secret and QR code
        $twoFactorData = $this->twoFactorService->generateSecret($userId, $compte->getEmail());
        
        return $this->renderView(
            'backoffice/2fa_setup.php',
            [
                'qr_code_uri' => $twoFactorData['qr_code_uri'],
                'manual_key' => $twoFactorData['manual_entry_key'],
                'seo' => [
                    'title' => 'Configuration 2FA',
                    'description' => 'Configuration de l\'authentification à deux facteurs'
                ]
            ]
        );
    }
    
    /**
     * Verify setup code and enable 2FA
     */
    public function verifySetup()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['code_pro'])) {
            return $this->redirectToRoute('/pro/connexion');
        }
        
        if (!empty($_POST['totp_code'])) {
            $userId = $_SESSION['code_pro'];
            $code = $_POST['totp_code'];
            
            if ($this->twoFactorService->verifyCode($userId, $code)) {
                // Code is valid, enable 2FA
                $this->twoFactorService->enable($userId);
                
                return $this->renderView(
                    'backoffice/2fa_success.php',
                    [
                        'message' => 'Authentification à deux facteurs activée avec succès!',
                        'seo' => [
                            'title' => '2FA Activée',
                            'description' => 'Authentification à deux facteurs activée'
                        ]
                    ]
                );
            } else {
                // Code is invalid, redirect back with error
                return $this->redirectToRoute('/pro/2fa/setup', ['error' => 'invalid_code']);
            }
        }
        
        return $this->redirectToRoute('/pro/2fa/setup');
    }
    
    /**
     * Show 2FA verification page during login
     */
    public function loginVerification()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if user is in 2FA pending state
        if (!isset($_SESSION['2fa_user_id'])) {
            return $this->redirectToRoute('/pro/connexion');
        }
        
        return $this->renderView(
            'backoffice/2fa_login_verification.php',
            [
                'seo' => [
                    'title' => 'Vérification 2FA',
                    'description' => 'Vérification de l\'authentification à deux facteurs'
                ]
            ]
        );
    }
    
    /**
     * Verify 2FA code during login
     */
    public function verifyLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['2fa_user_id'])) {
            return $this->redirectToRoute('/pro/connexion');
        }
        
        if (!empty($_POST['totp_code'])) {
            $userId = $_SESSION['2fa_user_id'];
            $code = $_POST['totp_code'];
            
            if ($this->twoFactorService->verifyCode($userId, $code)) {
                // Code is valid, complete login
                $_SESSION['code_pro'] = $userId;
                unset($_SESSION['2fa_user_id']);
                session_regenerate_id();
                
                return $this->redirectToRoute('/pro');
            } else {
                // Code is invalid
                return $this->redirectToRoute('/pro/2fa/verify', ['error' => 'invalid_code']);
            }
        }
        
        return $this->redirectToRoute('/pro/2fa/verify');
    }
    
    /**
     * Disable 2FA
     */
    public function disable()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['code_pro'])) {
            return $this->redirectToRoute('/pro/connexion');
        }
        
        $userId = $_SESSION['code_pro'];
        
        if (!empty($_POST['confirm']) && $_POST['confirm'] === 'yes') {
            $this->twoFactorService->disable($userId);
            return $this->redirectToRoute('/pro', ['2fa_disabled' => '1']);
        }
        
        return $this->renderView(
            'backoffice/2fa_disable.php',
            [
                'seo' => [
                    'title' => 'Désactiver 2FA',
                    'description' => 'Désactiver l\'authentification à deux facteurs'
                ]
            ]
        );
    }
    
    /**
     * AJAX endpoint to verify TOTP code
     */
    public function ajaxVerify()
    {
        header('Content-Type: application/json');
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!isset($input['code'])) {
            echo json_encode(['success' => false, 'error' => 'Missing code']);
            exit;
        }
        
        $userId = null;
        
        // Determine user ID based on context
        if (isset($_SESSION['code_pro'])) {
            $userId = $_SESSION['code_pro'];
        } elseif (isset($_SESSION['2fa_user_id'])) {
            $userId = $_SESSION['2fa_user_id'];
        }
        
        if (!$userId) {
            echo json_encode(['success' => false, 'error' => 'No user session']);
            exit;
        }
        
        $isValid = $this->twoFactorService->verifyCode($userId, $input['code']);
        
        echo json_encode(['success' => $isValid]);
        exit;
    }
}
