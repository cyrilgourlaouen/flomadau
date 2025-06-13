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
            $compte->setEmail($_POST['email'] ?? null);
            $compte->setTelephone($_POST['phone'] ?? null);

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
            $compteMisAJour = CompteResource::build($compteManager->findOneBy( ['email' => $compte->getEmail()] ), [
                'userName' => ['isMultiple' => true],
            ]);

            if ($compteMisAJour) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }

                $_SESSION = $compteMisAJour;

                session_regenerate_id(true);
                return $this->redirectToRoute('/consultationMembre');
            } else {
                return $this->redirectToRoute('/consultationMembre', ["state" => "failure"]);
            }
        }
        return $this->redirectToRoute('/connexion');
    }
}
