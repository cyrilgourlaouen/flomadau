<?php

namespace App\Entity;

class OptionSouscrite
{
    public const TABLE_NAME = 'option_souscrite';

    private int $id_offre;
    private int $id_option;
    private int $nombre_jour;
    private string $date_debut; // FORMAT DATE 'YYYY-MM-DD'
    private string $date_fin;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getIdOption(): int
    {
        return $this->id_option;
    }

    public function setIdOption(int $id_option): void
    {
        $this->id_option = $id_option;
    }

    public function getNombreJour(): int
    {
        return $this->nombre_jour;
    }

    public function setNombreJour(int $nombre_jour): void
    {
        $this->nombre_jour = $nombre_jour;
    }

    public function getDateDebut(): string
    {
        return $this->date_debut;
    }

    public function setDateDebut(string $date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    public function getDateFin(): string
    {
        return $this->date_fin;
    }

    public function setDateFin(string $date_fin): void
    {
        $this->date_fin = $date_fin;
    }
}
