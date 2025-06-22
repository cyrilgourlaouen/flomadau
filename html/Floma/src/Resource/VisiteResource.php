<?php

namespace App\Resource;

use App\Entity\Visite;
use App\Manager\VisiteManager;
use Floma\Resource\AbstractResource;

class VisiteResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Visite $visite, array $context = [])
    {
        parent::__construct($visite);
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
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Visite $visite, array $context = []): array
    {
        return (new self($visite, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($visite) => self::build($visite, $context), $entities);
    }

    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id_offre' => $this->visite->getIdOffre(),
            'prix_minimal' => $this->visite->getPrixMinimal(),
            'duree' => $this->visite->getDuree(),
            'guidee' => $this->visite->isGuidee(),
        ];
    }
}