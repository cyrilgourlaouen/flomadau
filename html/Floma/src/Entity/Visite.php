<?php

namespace App\Entity;

class Visite
{
    public const TABLE_NAME = 'visite';

    private int $id_offre;
    private float $prix_minimal;
    private string $duree;
    private bool $guidee = false;

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

    public function isGuidee(): bool
    {
        return $this->guidee;
    }

    public function setGuidee(bool $guidee): void
    {
        $this->guidee = $guidee;
    }
}