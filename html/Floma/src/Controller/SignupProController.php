<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Professionnel;
use App\Manager\CompteProManager;
use App\Manager\ProfessionnelManager;
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

            /* $professionnel = new Professionnel(); */
            /* $professionnelManager = new ProfessionnelManager(); */

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

            /* $professionnel->setRaisonSociale($_POST['raison_sociale'] ?? null); */
            /* $professionnel->setSiret($_POST['siret'] ?? null); */

            // FIX: $professionnel->setIdCompte()

            // OUTDATED:
            // Check if the email already exists

            /* if ($compteProManager->checkEmail($comptePro->getEmail())) { */
            /**/
            /* return $this->redirectToRoute('/pro/signup', [ */
            /* 'error' => 'L\'email est déjà utilisé.' */
            /* ]); */
            /* } */

            $compteProManager->add($comptePro);

            return $this->redirectToRoute('/pro/connexion');
        }

        return $this->redirectToRoute('/pro/signup');
    }
}
