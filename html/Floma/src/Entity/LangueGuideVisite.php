<?php

namespace App\Entity;

class LangueGuideVisite
{
    public const TABLE_NAME = 'langue_guide_visite';

    private int $id_langue;
    private int $id_offre;

    public function getIdLangue(): int
    {
        return $this->id_langue;
    }

    public function setIdLangue(int $id_langue): void
    {
        $this->id_langue = $id_langue;
    }

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }
}
