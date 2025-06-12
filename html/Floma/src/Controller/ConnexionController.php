<?php
namespace App\Controller;

use App\Entity\Membre;
use App\Manager\CompteManager;
use App\Manager\MembreManager;
use App\Resource\MembreResource;
use Floma\Controller\AbstractController;
use Floma\View\Layout;
use App\Resource\CompteResource;

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
            $enrichedAccounts = CompteResource::build($compteManager->findOneBy( ['email' => $_POST["email"]]), [
                'userName' => ['isMultiple' => true],
            ]);
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if ($enrichedAccounts) {
                $_SESSION = $enrichedAccounts;
                session_regenerate_id();
                return $this->redirectToRoute('/');
            } else {
                return $this->redirectToRoute('/connection', ["state" => "failure"]);
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