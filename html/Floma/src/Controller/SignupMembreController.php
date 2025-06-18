<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Membre;
use App\Manager\CompteManager;
use App\Manager\MembreManager;
use Floma\Controller\AbstractController;

/**
 * Class MainController
 *
 * @package App\Controller
 */
class SignupMembreController extends AbstractController
{
    /**
     * @return string
     */
    public function home()
    {
        return $this->renderView(
            'front/inscription/create_member.php', 
            [
                'seo' => [
                    'title' => 'Création d\'un compte membre',
                    'descriptions'=> 'Page pour crée un compte membre'
                ]
            ]);
    }

    /**
     * @return null
     */
    public function signUp()
    {
        if (isset($_POST)) {
            
            $compte = new Compte();
            $compte->setNom($_POST['nom']);
			$compte->setPrenom($_POST['prenom']);
			$compte->setEmail($_POST['email']);
            $compte->setTelephone($_POST['tel']);
            $hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $compte->setMotDePasse($hashed);
            $compte->setVille($_POST['city']);
            $compte->setCodePostal($_POST['zip_code']);
            $compte->setNomRue($_POST['name_street']);
            $compte->setNumeroRue($_POST['num_street']);
            if (isset($_POST['adress_comp'])){
                $compte->setComplementAdresse($_POST['adress_comp']);
            }

            $compteManager = new CompteManager();
            $temp = $compteManager->addGetId($compte);
            $id_compte = $temp[1];
            
            $membre = new Membre();
            $membre->setPseudo($_POST['pseudo']);
            $membre->setIdCompte($id_compte);


            $membreManager = new MembreManager();
            $membreManager->add($membre);
            return $this->redirectToRoute('/');
        }
        return $this->redirectToRoute('/inscription/membre', ['state' => 'failure']);
    }

    public function verification()
    {
        header('Content-Type: application/json');
        $response = [];
        $compteManager = new CompteManager();
        $membreManager = new MembreManager();
        if (isset($_POST['email'])) {
            if ($compteManager->findOneBy(['email' => $_POST['email']])) {
                $response['statusEmail'] = 'error';
                $response['messageEmail'] = 'Cet email est déjà utilisé.';
            } else {
                $response['statusEmail'] = 'success';
                $response['messageEmail'] = 'Email disponible.';
            }
        }

        if (isset($_POST['pseudo'])) {
            if ($membreManager->findOneBy(['pseudo' => $_POST['pseudo']])) {
                $response['statusPseudo'] = 'error';
                $response['messagePseudo'] = 'Ce pseudo est déjà utilisé.';
            } else {
                $response['statusPseudo'] = 'success';
                $response['messagePseudo'] = 'Pseudo disponible.';
            }
        }

        if (isset($_POST['tel'])) {
            if ($compteManager->findOneBy(['telephone' => $_POST['tel']])) {
                $response['statusTel'] = 'error';
                $response['messageTel'] = 'Ce numéro de téléphone est déjà utilisé.';
            } else {
                $response['statusTel'] = 'success';
                $response['messageTel'] = 'Numéro de téléphone disponible.';
            }
        }
        echo json_encode($response);
        return;
    }
}