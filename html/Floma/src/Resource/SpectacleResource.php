<?php

namespace App\Resource;

use App\Entity\Spectacle;
use App\Manager\SpectacleManager;
use Floma\Resource\AbstractResource;

class SpectacleResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Spectacle $spectacle, array $context = [])
    {
        parent::__construct($spectacle);
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
            'id_offre' => $this->spectacle->getIdOffre(),
            'prix_minimal' => $this->spectacle->getPrixMinimal(),
            'duree' => $this->spectacle->getDuree(),
            'capacite' => $this->spectacle->getCapacite(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Spectacle $spectacle, array $context = []): array
    {
        return (new self($spectacle, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($spectacle) => self::build($spectacle, $context), $entities);
    }
}