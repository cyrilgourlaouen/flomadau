<?php
namespace App\Controller;

use App\Manager\CompteManager;
use Floma\Controller\AbstractController;
use App\Resource\CompteResource;
use App\Service\MetricMembreAccount;

/**
 * Class ConnexionController
 *
 * @package App\Controller
 */
class ConnexionController extends AbstractController
{
    /**
     * @return void
     */
    public function logIn()
    {
        if (!empty($_POST)) {
            $compteManager = new CompteManager();
            $metricMembreAccount = new MetricMembreAccount();
            $enrichedAccounts = CompteResource::buildAll($compteManager->findAll(), [
                'userName' => ['isMultiple' => true],
            ]);
            $index = $metricMembreAccount->isMembreExist($enrichedAccounts, $_POST["email"], $_POST["password"]);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if($index !== false){
                $_SESSION = $enrichedAccounts[$index];
                session_regenerate_id(true);
                return $this->redirectToRoute('/');
            } else {
                return $this->redirectToRoute('/connexion', ["state" => "failure"]);
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
            'front/connection/connection.php',
            [
                'seo' => [
                    'title' => 'LogIn',
                ]
            ]
        );
    }

    /**
     * @return null
     */
    public function contact()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        return $this->redirectToRoute('home', ['state' => 'success']);
    }
}