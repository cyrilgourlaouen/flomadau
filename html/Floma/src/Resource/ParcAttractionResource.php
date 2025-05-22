<?php

namespace App\Resource;

use App\Entity\ParcAttraction;
use App\Manager\ParcAttractionManager;
use Floma\Resource\AbstractResource;

class ParcAttractionResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private ParcAttraction $parcAttraction, array $context = [])
    {
        parent::__construct($parcAttraction);
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
            'id_offre' => $this->parcAttraction->getIdOffre(),
            'url_plan' => $this->parcAttraction->getUrlPlan(),
            'nombre_attraction' => $this->parcAttraction->getNombreAttraction(),
            'prix_minimal' => $this->parcAttraction->getPrixMinimal(),
            'age_requis' => $this->parcAttraction->getAgeRequis(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(ParcAttraction $parcAttraction, array $context = []): array
    {
        return (new self($parcAttraction, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($parcAttraction) => self::build($parcAttraction, $context), $entities);
    }
}