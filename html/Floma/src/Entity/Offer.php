<?php

namespace App\Entity;

/**
 * Class Offer
 *
 * @package App\Entity
 */
class Offer
{
    /** @var int */
    private int $id;

    /** @var string */
    private string $titre;

    /** @var string */
    private string $resume;

    /** @var string */
    private string $ville;

    /** @var int|null */
    private ?int $noteMoyenne;

    /** @var int|null */
    private ?int $nombreAvis;

    /** @var string */
    private string $category;

    /** @var string */
    private string $conditionAccessibilite;

    /** @var string|null */
    private ?string $descriptionDetaillee;

    /** @var string|null */
    private ?string $telephone;

    /** @var string|null */
    private ?string $adressePostale;

    /** @var string|null */
    private ?string $siteWeb;

    /** @var bool */
    private bool $enLigne;

    /** @var float */
    private float $prixMinimal;

    const TABLE_NAME = 'Offre';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getResume(): string
    {
        return $this->resume;
    }

    /**
     * @param string $resume
     */
    public function setResume(string $resume): void
    {
        $this->resume = $resume;
    }

    /**
     * @return string
     */
    public function getVille(): string
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return int|null
     */
    public function getNoteMoyenne(): ?int
    {
        return $this->noteMoyenne;
    }

    /**
     * @param int|null $noteMoyenne
     */
    public function setNoteMoyenne(?int $noteMoyenne): void
    {
        $this->noteMoyenne = $noteMoyenne;
    }

    /**
     * @return int|null
     */
    public function getNombreAvis(): ?int
    {
        return $this->nombreAvis;
    }

    /**
     * @param int|null $nombreAvis
     */
    public function setNombreAvis(?int $nombreAvis): void
    {
        $this->nombreAvis = $nombreAvis;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getConditionAccessibilite(): string
    {
        return $this->conditionAccessibilite;
    }

    /**
     * @param string $conditionAccessibilite
     */
    public function setConditionAccessibilite(string $conditionAccessibilite): void
    {
        $this->conditionAccessibilite = $conditionAccessibilite;
    }

    /**
     * @return string|null
     */
    public function getDescriptionDetaillee(): ?string
    {
        return $this->descriptionDetaillee;
    }

    /**
     * @param string|null $descriptionDetaillee
     */
    public function setDescriptionDetaillee(?string $descriptionDetaillee): void
    {
        $this->descriptionDetaillee = $descriptionDetaillee;
    }

    /**
     * @return string|null
     */
    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /**
     * @param string|null $telephone
     */
    public function setTelephone(?string $telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string|null
     */
    public function getAdressePostale(): ?string
    {
        return $this->adressePostale;
    }

    /**
     * @param string|null $adressePostale
     */
    public function setAdressePostale(?string $adressePostale): void
    {
        $this->adressePostale = $adressePostale;
    }

    /**
     * @return string|null
     */
    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    /**
     * @param string|null $siteWeb
     */
    public function setSiteWeb(?string $siteWeb): void
    {
        $this->siteWeb = $siteWeb;
    }

    /**
     * @return bool
     */
    public function isEnLigne(): bool
    {
        return $this->enLigne;
    }

    /**
     * @param bool $enLigne
     */
    public function setEnLigne(bool $enLigne): void
    {
        $this->enLigne = $enLigne;
    }

    /**
     * @return float
     */
    public function getPrixMinimal(): float
    {
        return $this->prixMinimal;
    }

    /**
     * @param float $prixMinimal
     */
    public function setPrixMinimal(float $prixMinimal): void
    {
        $this->prixMinimal = $prixMinimal;
    }
}