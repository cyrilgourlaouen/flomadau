<?php

namespace App\Controller;

use App\Entity\Compte;
use Floma\Controller\AbstractController;
use App\Manager\CompteProManager;

class SignupProController extends AbstractController
{
    public function page()
    {
        return $this->renderView(
            'backoffice/signup_page.php',
            [
                'seo' => [
                    'title' => 'Accueil professionnel',
                    'descriptions' => 'Page d\'accueil d\'un professionnel PACT, parcourez vos offres, lisez vos avis.'
                ]
            ]
        );
    }

    public function submit()
    {
        if (!empty($_POST)) {
            $comptePro = new Compte();
            $compteProManager = new CompteProManager();

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

            $compteProManager->add($comptePro);

            return $this->redirectToRoute('/pro');
        }

            return $this->redirectToRoute('/pro/signup');
    }
}
