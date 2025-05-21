<?php

namespace App\Entity;

class JourOuverture
{
    public const TABLE_NAME = 'jour_ouverture';

    private int $id;
    private string $nom_jour;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomJour(): string
    {
        return $this->nom_jour;
    }

    public function setNomJour(string $nom_jour): void
    {
        $this->nom_jour = $nom_jour;
    }
}
