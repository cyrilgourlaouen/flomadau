<?php

namespace App\Controller;

use App\Manager\CompteManager;
use App\Resource\CompteResource;
use App\Service\MetricProAccount;
use App\Service\TwoFactorAuthService;
use Floma\Controller\AbstractController;

class ConnexionProController extends AbstractController
{
    private TwoFactorAuthService $twoFactorService;

    public function __construct()
    {
        $this->twoFactorService = new TwoFactorAuthService();
    }

    public function connexionPro()
    {
        return $this->renderView(
            'backoffice/connexion_pro.php',
            [
                'seo' => [
                    'title' => 'Connexion compte professionnel',
                    'description' => 'Page de connexion d\'un professionnel PACT afin d\'avoir accès à vos offres.'
                ]
            ]
        );
    }

    public function logIn()
    {
        if (!empty($_POST)) {
            $compteManager = new CompteManager();
            $metricProAccount = new MetricProAccount();
            $enrichedAccounts = CompteResource::buildAll($compteManager->findAll(), [
                'gradeUser' => ['isMultiple' => true],
            ]);
            $isProExist = $metricProAccount->isProExist($enrichedAccounts, $_POST["email"], $_POST["password"]);
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            
            if ($isProExist) {
                $proId = $metricProAccount->getProId($enrichedAccounts, $_POST["email"], $_POST["password"]);
                
                // Check if 2FA is enabled for this user
                if ($this->twoFactorService->isEnabled($proId)) {
                    // Store user ID temporarily for 2FA verification
                    $_SESSION['2fa_user_id'] = $proId;
                    // Clear any existing full login session
                    unset($_SESSION['code_pro']);
                    
                    return $this->redirectToRoute('/pro/2fa/verify');
                } else {
                    // No 2FA, proceed with normal login
                    $_SESSION['code_pro'] = $proId;
                    session_regenerate_id();
                    return $this->redirectToRoute('/pro');
                }
            } else {
                return $this->redirectToRoute('/pro/connexion', ["state" => "failure"]);
            }
        }
    }

    public function logOut()
    {
        // Clear session data
        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
        return $this->redirectToRoute('/pro');
    }

    public function connection()
    {
        return $this->renderView(
            'backoffice/connexion_pro.php',
            [
                'seo' => [
                    'title' => 'Connexion',
                    'description' => 'Page de connexion'
                ]
            ]
        );
    }
}
