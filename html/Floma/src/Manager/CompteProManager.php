<?php
// src/Manager/CompteManager.php

namespace App\Manager;

use App\Entity\Compte;
use Floma\Manager\AbstractManager;

class CompteProManager extends AbstractManager
{
    public function add(Compte $compte)
    {
        return $this->create(Compte::class, [
            'nom' => $compte->getNom(),
            'prenom' => $compte->getPrenom(),
            'email' => $compte->getEmail(),
            'telephone' => $compte->getTelephone(),
            'mot_de_passe' => password_hash($compte->getMotDePasse(), PASSWORD_DEFAULT),
            'ville' => $compte->getVille(),
            'code_postal' => $compte->getCodePostal(),
            'nom_rue' => $compte->getNomRue(),
            'numero_rue' => $compte->getNumeroRue(),
            'complement_adresse' => $compte->getComplementAdresse()
        ]);
    }
}