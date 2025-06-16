<?php


namespace App\Controller;


use App\Manager\CompteManager;
use App\Manager\MembreManager;
use Floma\Controller\AbstractController;
use App\Entity\Compte;
use App\Resource\CompteResource;
use App\Entity\Membre;

/**
 * Class InformationMController
 *
 * @package App\Controller
 */
class ModificationMembreController extends AbstractController
{
    public function updateData()
    {
        if (!empty($_POST)) {
            $compte = new Compte();
            $compteManager = new CompteManager();
            
            $compte->setNom($_POST['name'] ?? null);
            $compte->setPrenom($_POST['firstname'] ?? null);
            $compte->setTelephone($_POST['phone'] ?? null);
            
            if (!empty($_POST['email']) && $this->isEmailAvailable($_POST['email'])) {
                $compte->setEmail($_POST['email']);
                $compteManager->updateEmail($compte, $_SESSION['id']);
            } 
            
            $membre = new Membre();
            $membreManager = new MembreManager();
            
            $id = (int) ($_POST['id_compte'] ?? 0);
            
            $previousMembre = $membreManager->findOneBy(['id_compte' => $id ?? null]);

            if($previousMembre->getPseudo() !== $_POST['pseudo']){
                $membre->setPseudo($_POST['pseudo'] ?? null);
                $membreManager->updateMembre($membre , $id);
            } else {
                $compteManager->updateCompte($compte, $id); 
            }

            session_unset();

            // 🔁 Reconnexion
            $compteMisAJour = CompteResource::build($compteManager->findOneBy( ['id' => $id] ), [
                'userName' => ['isMultiple' => true],
            ]);

            if ($compteMisAJour) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION = $compteMisAJour;

                session_regenerate_id(true);
                return $this->redirectToRoute('/consultation/membre');
            } else {
                return $this->redirectToRoute('/consultation/membre', ["state" => "failure"]);
            }
        }
    }

    public function checkPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = $_POST['password'] ?? '';

            if (password_verify($password, $_SESSION['mot_de_passe'])) {
                echo json_encode(true);  
            } else {
                echo json_encode(false); 
            }
            exit;
        }
    }

    public function updatePassword() {
        $compte = new Compte();
        $compteManager = new CompteManager();
        
        $compte = $compteManager->findOneBy(['id' => $_SESSION['id'] ?? 0]);

        $newPassword = $_POST['new_password'] ?? null;
        $confirmPassword = $_POST['confirm_password'] ?? null;

        if ($newPassword !== $confirmPassword) {
            echo json_encode(['success' => false, 'error' => 'Les mots de passe ne correspondent pas.']);
            exit;
        }

        if (!$this->isValidPassword($newPassword)) {
            echo json_encode(['success' => false, 'error' => 'Mot de passe invalide (12 caractères, 2 spéciaux, 1 majuscule).']);
            exit;
        }
        $password = password_hash($newPassword, PASSWORD_DEFAULT);
        $compte->setMotDePasse($password);
        $compteManager->updatePassword($compte, $_SESSION['id'] ?? 0);

        // 🔁 Reconnexion
        $compteMisAJour = CompteResource::build($compteManager->findOneBy( ['id' => $_SESSION['id']] ), [
            'userName' => ['isMultiple' => true],
        ]);
        
        if ($compteMisAJour) {
            session_unset();
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION = $compteMisAJour;
            session_regenerate_id(true);
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false]);
            exit;
        }
    }

    private function isValidPassword(string $password): bool {
        if (strlen($password) < 12) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }


        preg_match_all('/[^a-zA-Z0-9]/', $password, $matches);
        $specialCount = count($matches[0]);

        if ($specialCount < 2) {
            return false;
        }
        return true;
    }
    private function isEmailAvailable(string $email): bool {
        if (empty($email)) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        $compteManager = new CompteManager();
        $allMembre = CompteResource::buildAll($compteManager->findAll(), [
            'userName' => ['isMultiple' => true],
        ]);

        foreach ($allMembre as $membre) {
            if (isset($membre['email']) && $membre['email'] === $email) {
                return false;
            }
        }
        return true;
    }
    public function checkEmail() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'error' => 'Méthode non autorisée']);
            return;
        }

        $email = $_POST['email'] ?? '';

        if (empty($email)) {
            echo json_encode(['success' => false, 'error' => 'Email vide']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'error' => 'Email invalide']);
            return;
        }

        $isAvailable = $this->isEmailAvailable($email);
        echo json_encode(['success' => true, 'available' => $isAvailable]);
    }

}
