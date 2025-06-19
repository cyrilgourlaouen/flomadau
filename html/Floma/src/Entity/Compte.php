<?php

namespace App\Entity;

class Compte
{
    public const TABLE_NAME = 'compte';

    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $telephone;
    private string $mot_de_passe;
    private string $ville;
    private string $code_postal;
    private string $nom_rue;
    private int $numero_rue;
    private ?string $complement_adresse = null;
    private bool $est_pro; 

    private ?string $url_photo_profil = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelephone(): string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getMotDePasse(): string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $mot_de_passe): void
    {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getCodePostal(): string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): void
    {
        $this->code_postal = $code_postal;
    }

    public function getNomRue(): string
    {
        return $this->nom_rue;
    }

    public function setNomRue(string $nom_rue): void
    {
        $this->nom_rue = $nom_rue;
    }

    public function getNumeroRue(): int
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(int $numero_rue): void
    {
        $this->numero_rue = $numero_rue;
    }

    public function getComplementAdresse(): ?string
    {
        return $this->complement_adresse;
    }

    public function setComplementAdresse(?string $complement_adresse): void
    {
        $this->complement_adresse = $complement_adresse;
    }

    public function isPro(): bool
    {
        return $this->est_pro;
    }
    public function getUrlPhotoProfil(): ?string
    {
        return $this->url_photo_profil;
    }

    public function setUrlPhotoProfil(?string $url_photo_profil): void
    {
        $this->url_photo_profil = $url_photo_profil;
    }
}
