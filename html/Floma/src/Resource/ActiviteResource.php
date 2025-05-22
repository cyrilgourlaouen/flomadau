<?php

namespace App\Resource;

use App\Entity\Activite;
use App\Manager\ActiviteManager;
use Floma\Resource\AbstractResource;

class ActiviteResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Activite $activite, array $context = [])
    {
        parent::__construct($activite);
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
            'id_offre' => $this->activite->getIdOffre(),
            'prix_minimal' => $this->activite->getPrixMinimal(),
            'duree' => $this->activite->getDuree(),
            'age_requis' => $this->activite->getAgeRequis(),
            'prestations_incluses' => $this->activite->getPrestationsIncluses(),
            'prestations_non_incluses' => $this->activite->getPrestationsNonIncluses(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Activite $activite, array $context = []): array
    {
        return (new self($activite, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($activite) => self::build($activite, $context), $entities);
    }
}