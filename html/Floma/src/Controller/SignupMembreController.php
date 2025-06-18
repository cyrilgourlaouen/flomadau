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
        if (isset($_POST['email'])){
            $checkEmail = new CompteManager();
            $checkEmail->findOneBy(['email' => $_POST['email']]);
            if ($checkEmail == null) {
                $response['emailExists'] = false;
            }
            else {
                $response['emailExists'] = true;
            }
        }
        if (isset($_POST['pseudo'])){
            $checkPseudo = new CompteManager();
            $checkPseudo->findOneBy(['pseudo' => $_POST['pseudo']]);
            if ($checkPseudo == null) {
                $response['pseudoExists'] = false;
            }
            else {
                $response['pseudoExists'] = true;
            }
        }
        if (isset($_POST['tel'])){
            $checkTel = new CompteManager();
            $checkTel->findOneBy(['telephone' => $_POST['tel']]);
            if ($checkTel == null) {
                $response['telExists'] = false;
            }
            else {
                $response['telExists'] = true;
            }
        }
        echo json_encode($response);
    }
}