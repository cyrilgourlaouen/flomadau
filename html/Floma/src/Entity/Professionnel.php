<?php

namespace App\Entity;

class Professionnel
{
    public const TABLE_NAME = 'professionnel';

    private int $code;
    private string $raison_sociale;
    private int $id_compte;
    private bool $est_prive;

    public function getCode(): int
    {
        return $this->code;
    }
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getRaisonSociale(): string
    {
        return $this->raison_sociale;
    }
    public function setRaisonSociale(string $raison_sociale): void
    {
        $this->raison_sociale = $raison_sociale;
    }

    public function getIdCompte(): int
    {
        return $this->id_compte;
    }
    public function setIdCompte(int $id_compte): void
    {
        $this->id_compte = $id_compte;
    }

    public function isPrive(): bool
    {
        return $this->est_prive;
    }

    public function setPrive(bool $est_prive): void
    {
        $this->est_prive = $est_prive;
    }
}
