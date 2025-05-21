<?php

namespace App\Entity;

class TypeRepas
{
    public const TABLE_NAME = 'type_repas';

    private int $id;
    private string $nom_type;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomType(): string
    {
        return $this->nom_type;
    }

    public function setNomType(string $nom_type): void
    {
        $this->nom_type = $nom_type;
    }
}
