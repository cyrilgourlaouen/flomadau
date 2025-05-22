<?php

namespace App\Entity;

class ParcAttraction
{
    public const TABLE_NAME = 'parc_attraction';

    private int $id_offre;
    private string $url_plan;
    private int $nombre_attraction;
    private float $prix_minimal;
    private int $age_requis;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getUrlPlan(): string
    {
        return $this->url_plan;
    }

    public function setUrlPlan(string $url_plan): void
    {
        $this->url_plan = $url_plan;
    }

    public function getNombreAttraction(): int
    {
        return $this->nombre_attraction;
    }

    public function setNombreAttraction(int $nombre_attraction): void
    {
        $this->nombre_attraction = $nombre_attraction;
    }

    public function getPrixMinimal(): float
    {
        return $this->prix_minimal;
    }

    public function setPrixMinimal(float $prix_minimal): void
    {
        $this->prix_minimal = $prix_minimal;
    }

    public function getAgeRequis(): int
    {
        return $this->age_requis;
    }

    public function setAgeRequis(int $age_requis): void
    {
        $this->age_requis = $age_requis;
    }
}