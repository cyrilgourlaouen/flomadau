<?php

namespace App\Entity;

class JourOuvertureOffre
{
    public const TABLE_NAME = 'jour_ouverture_offre';

    private int $id_offre;
    private int $id_jour;
    private string $horaire_debut; // FORMAT TIME 'HH:MM:SS'
    private string $horaire_fin;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getIdJour(): int
    {
        return $this->id_jour;
    }

    public function setIdJour(int $id_jour): void
    {
        $this->id_jour = $id_jour;
    }

    public function getHoraireDebut(): string
    {
        return $this->horaire_debut;
    }

    public function setHoraireDebut(string $horaire_debut): void
    {
        $this->horaire_debut = $horaire_debut;
    }

    public function getHoraireFin(): string
    {
        return $this->horaire_fin;
    }

    public function setHoraireFin(string $horaire_fin): void
    {
        $this->horaire_fin = $horaire_fin;
    }
}
