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
class InscriptionController extends AbstractController
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
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        if (isset($_POST)) {
            $compte = new Compte();
            $compte->setNom($_POST['nom']);
			$compte->setPrenom($_POST['prenom']);
			$compte->setEmail($_POST['email']);
            $compte->setTelephone($_POST['tel']);
            $compte->setMotDePasse($_POST['password']);
            $compte->setVille($_POST['city']);
            $compte->setCodePostal($_POST['zip_code']);
            $compte->setNomRue($_POST['name_street']);
            $compte->setNumeroRue($_POST['num_street']);
            if (isset($_POST['adress_comp'])){
                $compte->setComplementAdresse($_POST['adress_comp']);
            }

            $compteManager = new CompteManager();
            $compteManager->add($compte);

            $id_compte = $compte.getId();

            $membre = new Membre();
            $membre->setPseudo($_POST['pseudo']);
            $membre->setIdCompte($id_compte);


            $membreManager = new MembreManager();
            $membreManager->add($membre);
            return $this->redirectToRoute('/');
        }
        return $this->redirectToRoute('/inscription/membre', ['state' => 'failure']);
    }

    /**
     * @return null
    */
    public function getPseudo()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        
    }

    public function getEmail()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        
    }

    public function getTel()
    {
        // Imaginons ici traiter la soumission d'un formulaire de contact et envoyer un mail...
        
    }

}
