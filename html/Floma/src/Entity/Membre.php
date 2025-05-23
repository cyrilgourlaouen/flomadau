<?php

namespace App\Entity;

class Membre
{
    public const TABLE_NAME = 'membre';

    private int $code;
    private string $pseudo;
    private int $id_compte;

    public function getCode(): int
    {
        return $this->code;
    }
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    public function getIdCompte(): int
    {
        return $this->id_compte;
    }
    public function setIdCompte(int $id_compte): void
    {
        $this->id_compte = $id_compte;
    }
}
