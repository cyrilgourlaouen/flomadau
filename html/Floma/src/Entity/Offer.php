<?php

namespace App\Entity;

class Offer
{
    public const TABLE_NAME = 'offre';

    private int $id;
    private string $titre;
    private string $resume;
    private string $ville;
    private int $code_postal;
    private ?float $note_moyenne = null;
    private ?int $nombre_avis = null;
    private string $categorie;
    private string $conditions_accessibilite;
    private ?string $description_detaillee = null;
    private ?string $telephone = null;
    private ?string $nom_rue = null;
    private ?int $numero_rue = null;
    private ?string $complement_adresse = null;
    private ?string $site_web = null;
    private bool $en_ligne = true;
    private int $code_professionnel;
    private string $date_creation;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function getResume(): string
    {
        return $this->resume;
    }

    public function setResume(string $resume): void
    {
        $this->resume = $resume;
    }

    public function getVille(): string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getCodePostal(): int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): void
    {
        $this->code_postal = $code_postal;
    }

    public function getNoteMoyenne(): ?float
    {
        return $this->note_moyenne;
    }

    public function setNoteMoyenne(?float $note_moyenne): void
    {
        $this->note_moyenne = $note_moyenne;
    }

    public function getNombreAvis(): ?int
    {
        return $this->nombre_avis;
    }

    public function setNombreAvis(?int $nombre_avis): void
    {
        $this->nombre_avis = $nombre_avis;
    }

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getConditionsAccessibilite(): string
    {
        return $this->conditions_accessibilite;
    }

    public function setConditionsAccessibilite(string $conditions_accessibilite): void
    {
        $this->conditions_accessibilite = $conditions_accessibilite;
    }

    public function getDescriptionDetaillee(): ?string
    {
        return $this->description_detaillee;
    }

    public function setDescriptionDetaillee(?string $description_detaillee): void
    {
        $this->description_detaillee = $description_detaillee;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    public function getNomRue(): ?string
    {
        return $this->nom_rue;
    }

    public function setNomRue(?string $nom_rue): void
    {
        $this->nom_rue = $nom_rue;
    }

    public function getNumeroRue(): ?int
    {
        return $this->numero_rue;
    }

    public function setNumeroRue(?int $numero_rue): void
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

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): void
    {
        $this->site_web = $site_web;
    }

    public function isEnLigne(): bool
    {
        return $this->en_ligne;
    }

    public function setEnLigne(bool $en_ligne): void
    {
        $this->en_ligne = $en_ligne;
    }

    public function getCodeProfessionnel(): int
    {
        return $this->code_professionnel;
    }

    public function setCodeProfessionnel(int $code_professionnel): void
    {
        $this->code_professionnel = $code_professionnel;
    }

    public function getDateCreation(): string
    {
        return $this->date_creation;
    }

    public function setDateCreation(string $date_creation): void
    {
        $this->date_creation = $date_creation;
    }
}
