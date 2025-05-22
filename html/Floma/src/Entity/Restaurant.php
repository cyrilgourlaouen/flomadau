<?php

namespace App\Entity;

class Restaurant
{
    public const TABLE_NAME = 'restaurant';

    private int $id_offre;
    private int $gamme_de_prix;
    private ?string $url_carte_restaurant = null;

    public function getIdOffre(): int
    {
        return $this->id_offre;
    }

    public function setIdOffre(int $id_offre): void
    {
        $this->id_offre = $id_offre;
    }

    public function getGammeDePrix(): int
    {
        return $this->gamme_de_prix;
    }

    public function setGammeDePrix(int $gamme_de_prix): void
    {
        $this->gamme_de_prix = $gamme_de_prix;
    }

    public function getUrlCarteRestaurant(): ?string
    {
        return $this->url_carte_restaurant;
    }

    public function setUrlCarteRestaurant(?string $url_carte_restaurant): void
    {
        $this->url_carte_restaurant = $url_carte_restaurant;
    }
}
