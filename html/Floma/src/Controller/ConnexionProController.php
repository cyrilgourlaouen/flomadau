<?php

namespace App\Controller;

use App\Manager\CompteManager;
use App\Resource\CompteResource;
use App\Service\MetricProAccount;
use Floma\Controller\AbstractController;

class ConnexionProController extends AbstractController
{
    public function connexionPro()
    {
        return $this->renderView(
            'backoffice/connexion_pro.php',
            [
                'seo' => [
                    'title' => 'Connexion du compte professionnel',
                    'descriptions'=> 'Page de connexion d\'un professionnel PACT afin d\'avoir accès à vos offres.'
                ]
            ]);
    }

    public function logIn()
    {
        if (!empty($_POST)) {
            $compteManager = new CompteManager();
            $metricProAccount = new MetricProAccount();
            $enrichedAccounts = CompteResource::buildAll($compteManager->findAll(), [
                'gradeUser' => ['isMultiple' => true],
            ]);
            $isProExist = $metricProAccount->isProExist($enrichedAccounts, $_POST["raison_sociale"], $_POST["password"]);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($isProExist) {
                $_SESSION['raison_sociale'] = $_POST['raison_sociale'];
                session_regenerate_id();
                return $this->redirectToRoute('/pro');
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
        return $this->redirectToRoute('/');
    }

    public function connection()
    {
        return $this->renderView(
            'backoffice/connexion_pro.php',
            [
                'seo' => [
                    'title' => 'LogIn',
                ]
            ]
        );
    }

    public function contact()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        return $this->redirectToRoute('home', ['state' => 'success']);
    }
}
