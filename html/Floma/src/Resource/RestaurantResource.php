<?php

namespace App\Resource;

use App\Entity\Restaurant;
use App\Manager\RestaurantManager;
use Floma\Resource\AbstractResource;

class RestaurantResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Restaurant $restaurant, array $context = [])
    {
        parent::__construct($restaurant);
        $this->hydrate($context);
    }

    /**
     * Ajoute automatiquement les ressources supplémentaires si les managers
     * sont disponibles (ou instanciés par défaut).
     */
    private function hydrate(array $context): void
    {
        
    }

    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id_offre' => $this->restaurant->getIdOffre(),
            'gamme_de_prix' => $this->restaurant->getGammeDePrix(),
            'url_carte_restaurant' => $this->restaurant->getUrlCarteRestaurant(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Restaurant $restaurant, array $context = []): array
    {
        return (new self($restaurant, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($restaurant) => self::build($restaurant, $context), $entities);
    }
}