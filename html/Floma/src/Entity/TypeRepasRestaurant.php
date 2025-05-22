<?php

namespace App\Entity;

class TypeRepasRestaurant
{
    public const TABLE_NAME = 'type_repas_restaurant';

    private int $id_type;
    private int $id_offre;

    public function getIdType(): int
    {
        return $this->id_type;
    }

    public function setIdType(int $id_type): void
    {
        $this->id_type = $id_type;
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
