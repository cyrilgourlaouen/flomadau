<?php
// src/Manager/CompteManager.php

namespace App\Manager;

use App\Entity\Compte;
use Floma\Manager\AbstractManager;

class CompteProManager extends AbstractManager
{
    public function add(Compte $compte)
    {
        return $this->createGetId(Compte::class, [
            'nom' => $compte->getNom(),
            'prenom' => $compte->getPrenom(),
            'email' => $compte->getEmail(),
            'telephone' => $compte->getTelephone(),
            'mot_de_passe' => password_hash($compte->getMotDePasse(), PASSWORD_DEFAULT),
            'ville' => $compte->getVille(),
            'code_postal' => $compte->getCodePostal(),
            'nom_rue' => $compte->getNomRue(),
            'numero_rue' => $compte->getNumeroRue(),
            'complement_adresse' => $compte->getComplementAdresse(),
            'est_pro' => 'true'
        ]);
    }

    public function checkEmail(string $email)
    {
        return $this->readOne(Compte::class, [
            'email' => $email
        ]);
    }

    public function checkTelephone(string $telephone)
    {
        return $this->readOne(Compte::class, [
            'telephone' => $telephone
        ]);
    }


    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Compte::class, $filters);
    }
}
