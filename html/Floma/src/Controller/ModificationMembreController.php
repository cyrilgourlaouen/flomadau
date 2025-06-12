<?php


namespace App\Controller;


use App\Manager\CompteManager;
use Floma\Controller\AbstractController;
use App\Entity\Compte;
use App\Service\MetricMembreAccount;
use App\Resource\CompteResource;

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
        $compte->setTelephone($_POST['num'] ?? null);

        $id = (int) ($_POST['id_compte'] ?? 0);

        $compteManager->updateCompte($compte, $id); 

        $compteManager = new CompteManager();
        $metricMembreAccount = new MetricMembreAccount();
        $enrichedAccounts = $compteManager->findOneBy($_POST['email']);
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if($enrichedAccounts){
            $_SESSION = $enrichedAccounts;
            session_regenerate_id(true);
            return $this->redirectToRoute('/consultation');
        } else {
            return $this->redirectToRoute('/connexion', ["state" => "failure"]);
        }
    }

    return $this->redirectToRoute('/connexion');
}

}
