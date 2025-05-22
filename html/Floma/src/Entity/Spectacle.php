<?php

namespace App\Entity;

class Spectacle
{
    public const TABLE_NAME = 'spectacle';

    private int $id_offre;
    private float $prix_minimal;
    private string $duree;
    private int $capacite;

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

    public function getCapacite(): int
    {
        return $this->capacite;
    }

    public function setCapacite(int $capacite): void
    {
        $this->capacite = $capacite;
    }
}
