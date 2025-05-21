<?php

namespace App\Entity;

class OptionVisibilite
{
    public const TABLE_NAME = 'option_visibilite';

    private int $id;
    private ?string $nom_option = null;
    private float $prix;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomOption(): ?string
    {
        return $this->nom_option;
    }

    public function setNomOption(?string $nom_option): void
    {
        $this->nom_option = $nom_option;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): void
    {
        $this->prix = $prix;
    }
}
