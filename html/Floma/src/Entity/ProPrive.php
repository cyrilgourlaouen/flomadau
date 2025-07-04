<?php

namespace App\Entity;

class ProPrive
{
    public const TABLE_NAME = 'pro_prive';

    private string $siren;
    private ?int $numero_carte = null;
    private ?string $date_expiration = null;
    private int $code_professionnel;

    public function getSiren(): string { return $this->siren; }
    public function setSiren(string $siren): void { $this->siren = $siren; }

    public function getNumeroCarte(): ?int { return $this->numero_carte; }
    public function setNumeroCarte(?int $numero_carte): void { $this->numero_carte = $numero_carte; }

    public function getDateExpiration(): ?string { return $this->date_expiration; }
    public function setDateExpiration(?string $date_expiration): void { $this->date_expiration = $date_expiration; }

    public function getCodeProfessionnel(): int { return $this->code_professionnel; }
    public function setCodeProfessionnel(int $code_professionnel): void { $this->code_professionnel = $code_professionnel; }
}