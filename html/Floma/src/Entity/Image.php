<?php

namespace App\Entity;

class Image
{
    public const TABLE_NAME = 'image';

    private int $id;
    private string $url_img;
    private bool $principale = false;
    private int $id_offre;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUrlImg(): string
    {
        return $this->url_img;
    }

    public function setUrlImg(string $url_img): void
    {
        $this->url_img = $url_img;
    }

    public function isPrincipale(): bool
    {
        return $this->principale;
    }

    public function setPrincipale(bool $principale): void
    {
        $this->principale = $principale;
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
