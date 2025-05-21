<?php

namespace App\Entity;

class TagOffre
{
    public const TABLE_NAME = 'tag_offre';

    private int $id_offre;
    private int $id_tag;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getIdTag(): int
    {
        return $this->id_tag;
    }

    public function setIdTag(int $id_tag): void
    {
        $this->id_tag = $id_tag;
    }
}
