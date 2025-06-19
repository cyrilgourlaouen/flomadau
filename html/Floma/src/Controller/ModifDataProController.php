<?php

namespace App\Controller;

use App\Manager\ProfessionnelManager;
use App\Manager\CompteManager;
use App\Manager\ProPriveManager;
use App\Resource\CompteResource;
use App\Resource\ProfessionnelResource;
use App\Entity\Compte;
use App\Entity\Professionnel;
use App\Entity\ProPrive;
use Floma\Controller\AbstractController;
use Floma\View\Layout;

class ModifDataProController extends AbstractController
{
    private int $idCompte;
    private string $photo;

    public function updateData() {
        $dataJson = ['success' => true];
        $proManager = new ProfessionnelManager();
        $infosPro = ProfessionnelResource::buildAll($proManager->findBy(['code' => $_SESSION['code_pro']]), [
            'compte' => ['isMultiple' => false],
        ]);

        $this->idCompte = $infosPro[0]['id_compte'];
        $this->photo = $infosPro[0]['compteData'][0]['url_photo_profil'];

        //Verif méthode
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $dataJson = ['success' => false, 'erreur' => 'Méthode non autorisée'];
            echo json_encode($dataJson);
            exit;
        }
        
        //Vérif mdp
        $password = $_POST['old-password'];

        if(!empty($password)){
            $passwordValide = $this->validePassword($password);
    
            if(!$passwordValide){
                $dataJson = ['success' => false, 'erreur' => ['old-password' => 'Le mot de passe ne correspond pas']];
                echo json_encode($dataJson);
                exit;
            }
        }

        //Vérif email

        $email = $_POST['email'];

        $emailValide = $this->valide($email, 'email');

        if(!$emailValide){
            $dataJson = ['success' => false, 'erreur' => ['email' => 'L\'email existe déjà']];
            echo json_encode($dataJson);
            exit;
        }

        //Vérif tel
        $telephone = $_POST['telephone'];
        $telephoneValide = $this->valide($telephone, 'telephone');

        if(!$telephoneValide){
            $dataJson = ['success' => false, 'erreur' => ['telephone' => 'Le numéro de téléphone existe déjà']];
            echo json_encode($dataJson);
            exit;
        }

        //Update dans compte
        $compte = new Compte();
        $compteManager = new CompteManager();

        $compte->setNom(str_replace(' ', '', $_POST['nom']));
        $compte->setPrenom(str_replace(' ', '', $_POST['prenom']));
        $compte->setEmail(str_replace(' ', '', $_POST['email']));
        $compte->setTelephone(str_replace(' ', '', $_POST['telephone']));
        $compte->setMotDePasse($_POST['confirm-password']);
        $compte->setVille(str_replace(' ', '', $_POST['ville']));
        $compte->setCodePostal($_POST['code-postal']);
        $compte->setNomRue($_POST['rue']);
        $compte->setNumeroRue(str_replace(' ', '', $_POST['numero']));
        $compte->setComplementAdresse($_POST['complement']);

        //Si il y a une nouvelle pp
        if(!empty($_FILES['photo']['name'])){
            $dataJsonImg = $this->uploadImg();

            if($dataJsonImg['successUpload']){
                $compte->setUrlPhotoProfil(explode('.', $dataJsonImg['name'])[0]);
            }else{
                echo json_encode($dataJsonImg);
                exit;
            }
        //Si la pp a été supprimée on met la defaut
        }else if($_POST['delete-picture'] === "1"){
            $compte->setUrlPhotoProfil('pp_compte_defaut');
        //Sinon on remet l'ancienne
        }else{
            $compte->setUrlPhotoProfil($this->photo);
        }

        $compteManager->updateCompte($compte, $this->idCompte);

        //Update dans pro
        $pro = new Professionnel();
        $proManager = new ProfessionnelManager();

        $pro->setRaisonSociale($_POST['denomination']);
        $proManager->updateCompte($pro, $_SESSION['code_pro']);

        //Update dans pro privé
        $proPrive = new ProPrive();
        $proPriveManger = new ProPriveManager();

        $proPrive->setSiren(str_replace(' ', '', $_POST['siren']));
        if(!empty($_POST['card-number'])){
            $proPrive->setNumeroCarte(str_replace(' ', '', $_POST['card-number']));
            $proPrive->setCodeSecurite(str_replace(' ', '', $_POST['cvv']));
            $proPrive->setDateExpiration($_POST['expiration-date']);
        }

        $proPriveManger->updateCompte($proPrive, $_SESSION['code_pro']);

        return $this->redirectToRoute('/pro/check', ["state" => "success"]);
    }


    private function valide($val, $nomVal): bool {
        if (empty($val)) return false;

        $compteManager = new CompteManager();

        $accountsFound = CompteResource::buildAll($compteManager->findBy([$nomVal => $val]));

        foreach ($accountsFound as $account) {
            if($account['id'] !== $this->idCompte) {
                return false;
            }
        }

        return true;
    }


    private function validePassword($password) {
        if (empty($password)) return false;

        $proManager = new ProfessionnelManager();

        if(isset($_SESSION['code_pro'])){
            $infosPro = ProfessionnelResource::buildAll($proManager->findBy(['code' => $_SESSION['code_pro']]), [
                'compte' => ['isMultiple' => false]
            ]);

            var_dump($password);
            var_dump($infosPro[0]['compteData'][0]['mot_de_passe']);
            var_dump(password_verify($password, $infosPro[0]['compteData'][0]['mot_de_passe']));

            if(password_verify($password, $infosPro[0]['compteData'][0]['mot_de_passe'])){
                return true;
            }else{
                return false;
            }
        }
    }


    private function uploadImg(){
        if (!empty($_FILES['photo']['name']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $cheminTemp = $_FILES['photo']['tmp_name'];
            $AncienNomFichier = $_FILES['photo']['name'];

            $infosFichier = pathinfo($AncienNomFichier);
            $extensionFichier = strtolower($infosFichier['extension']);

            $nouveauNomFichier = 'pp_compte'.'_'.$this->idCompte.'.'. $extensionFichier;
            $cheminDestination = 'uploads/profilePicture/'.$nouveauNomFichier;

            if (!move_uploaded_file($cheminTemp , $cheminDestination)) {
                $dataJson['success'] = false;
                $dataJson['erreur']['photo'] = 'Erreur de transfert de l\'image';
                return ['successUpload' => false, 'erreur'['photo'] => 'Erreur de transfert de l\'image'];
            }else{
                return ['successUpload' => true, 'name' => $nouveauNomFichier];
            }
        }else{
            return ['successUpload' => false, 'erreur' => 'Aucun fichier reçu'];
        }
    }
}