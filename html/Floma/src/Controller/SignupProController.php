<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Professionnel;
use App\Entity\ProPrive;
use App\Entity\ProPublique;
use App\Manager\CompteProManager;
use App\Manager\ProfessionnelManager;
use App\Manager\ProPriveManager;
use App\Manager\ProPubliqueManager;
use Floma\Controller\AbstractController;

class SignupProController extends AbstractController
{
    public function page()
    {
        return $this->renderView(
            'backoffice/signup_page.php',
            [
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions' => "Page d'accueil d'un professionnel PACT, parcourez vos offres, lisez vos avis."
                ]
            ]
        );
    }

    public function verify()
    {
        header('Content-Type: application/json');

        if (!empty($_POST)) {
            $comptePro = new Compte();
            $compteProManager = new CompteProManager();

            $comptePro->setEmail($_POST['mail'] ?? null);

            // Check if the email exists
            if ($compteProManager->checkEmail($comptePro->getEmail())) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Cet email est déjà utilisé.'
                ]);
                return;
            } else {
                // If everything is correct, return success
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Email disponible.'
                ]);
                return;
            }
        } else {
            // Handle case when no POST data is received
            echo json_encode([
                'status' => 'error',
                'message' => 'Aucune donnée reçue.'
            ]);
            return;
        }
    }

    public function submit()
    {
        if (!empty($_POST)) {
            $comptePro = new Compte();
            $compteProManager = new CompteProManager();

            $professionnel = new Professionnel();
            $professionnelManager = new ProfessionnelManager();

            $proPrive = new ProPrive();
            $proPriveManager = new ProPriveManager();

            $proPublique = new ProPublique();
            $proPubliqueManager = new ProPubliqueManager();

            $comptePro->setNom($_POST['nom'] ?? null);
            $comptePro->setPrenom($_POST['prenom'] ?? null);
            $comptePro->setEmail($_POST['mail'] ?? null);
            $comptePro->setTelephone($_POST['num'] ?? null);
            $comptePro->setMotDePasse($_POST['mdp'] ?? null);
            $comptePro->setVille($_POST['ville'] ?? null);
            $comptePro->setCodePostal($_POST['code_postal'] ?? null);
            $comptePro->setNomRue($_POST['rue'] ?? null);
            $comptePro->setNumeroRue($_POST['numero'] ?? null);
            $comptePro->setComplementAdresse($_POST['complement'] ?? null);

            $professionnel->setRaisonSociale($_POST['denomination'] ?? null);

            if($_POST['type_entreprise'] === 'privee') {
                $proPrive->setSiren((int)$_POST['siren'] ?? null);
                $professionnel->setPrive(true);
            } else {
                $professionnel->setPrive(false);
            }

            // $returnedId looks like this : [$stmt, $id] and I only care about the id
            $returnedId = $compteProManager->add($comptePro);

            $professionnel->setIdCompte($returnedId[1] ?? null);

            $returnedId = $professionnelManager->add($professionnel);

            if($_POST['type_entreprise'] === 'privee') {
                $proPrive->setCodeProfessionnel($returnedId[1] ?? null);
                $proPriveManager->add($proPrive);
            } else {
                $proPublique->setCodeProfessionnel($returnedId[1] ?? null);
                $proPubliqueManager->add($proPublique);
            }

            return $this->redirectToRoute('/pro/connexion');
        }

        return $this->redirectToRoute('/pro/signup');
    }
}
