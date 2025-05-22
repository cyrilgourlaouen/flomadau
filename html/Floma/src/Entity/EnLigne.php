<?php

namespace App\Entity;

class EnLigne
{
    public const TABLE_NAME = 'en_ligne';

    private int $id;
    private string $mise_en_ligne;
    private string $mise_hors_ligne;
    private int $id_offre;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getMiseEnLigne(): string
    {
        return $this->mise_en_ligne;
    }

    public function setMiseEnLigne(string $mise_en_ligne): void
    {
        $this->mise_en_ligne = $mise_en_ligne;
    }

    public function getMiseHorsLigne(): string
    {
        return $this->mise_hors_ligne;
    }

    public function setMiseHorsLigne(string $mise_hors_ligne): void
    {
        $this->mise_hors_ligne = $mise_hors_ligne;
    }

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }
}
