<?php

namespace App\Entity;

class Activite
{
    public const TABLE_NAME = 'activite';

    private int $id_offre;
    private float $prix_minimal;
    private string $duree;
    private int $age_requis;
    private string $prestations_incluses;
    private string $prestations_non_incluses;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getPrixMinimal(): float
    {
        return $this->prix_minimal;
    }

    public function setPrixMinimal(float $prix_minimal): void
    {
        $this->prix_minimal = $prix_minimal;
    }

    public function getDuree(): string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): void
    {
        $this->duree = $duree;
    }

    public function getAgeRequis(): int
    {
        return $this->age_requis;
    }

    public function setAgeRequis(int $age_requis): void
    {
        $this->age_requis = $age_requis;
    }

    public function getPrestationsIncluses(): string
    {
        return $this->prestations_incluses;
    }

    public function setPrestationsIncluses(string $prestations_incluses): void
    {
        $this->prestations_incluses = $prestations_incluses;
    }

    public function getPrestationsNonIncluses(): string
    {
        return $this->prestations_non_incluses;
    }

    public function setPrestationsNonIncluses(string $prestations_non_incluses): void
    {
        $this->prestations_non_incluses = $prestations_non_incluses;
    }
}