<?php

namespace App\Entity;

class LangueGuide
{
    public const TABLE_NAME = 'langue_guide';

    private int $id;
    private string $nom_langue;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomLangue(): string
    {
        return $this->nom_langue;
    }

    public function setNomLangue(string $nom_langue): void
    {
        $this->nom_langue = $nom_langue;
    }
}
