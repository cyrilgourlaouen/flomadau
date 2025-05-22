<?php

namespace App\Entity;

class ProPublique
{
    public const TABLE_NAME = 'pro_publique';

    private bool $association = false;
    private int $code_professionnel;

    public function isAssociation(): bool { return $this->association; }
    public function setAssociation(bool $association): void { $this->association = $association; }

    public function getCodeProfessionnel(): int { return $this->code_professionnel; }
    public function setCodeProfessionnel(int $code_professionnel): void { $this->code_professionnel = $code_professionnel; }
}
