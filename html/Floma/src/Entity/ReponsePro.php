<?php

namespace App\Entity;

class ReponsePro
{
    public const TABLE_NAME = 'reponse_pro';

    private int $id;
    private string $reponse;
    private bool $signalement = false;
    private int $id_avis;

    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getReponse(): string { return $this->reponse; }
    public function setReponse(string $reponse): void { $this->reponse = $reponse; }

    public function isSignalement(): bool { return $this->signalement; }
    public function setSignalement(bool $signalement): void { $this->signalement = $signalement; }

    public function getIdAvis(): int { return $this->id_avis; }
    public function setIdAvis(int $id_avis): void { $this->id_avis = $id_avis; }
}
