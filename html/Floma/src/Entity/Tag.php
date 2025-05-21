<?php

namespace App\Entity;

class Tag
{
    public const TABLE_NAME = 'tag';

    private int $id;
    private string $nom_tag;
    private bool $tag_restaurant = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNomTag(): string
    {
        return $this->nom_tag;
    }

    public function setNomTag(string $nom_tag): void
    {
        $this->nom_tag = $nom_tag;
    }

    public function isTagRestaurant(): bool
    {
        return $this->tag_restaurant;
    }

    public function setTagRestaurant(bool $tag_restaurant): void
    {
        $this->tag_restaurant = $tag_restaurant;
    }
}
