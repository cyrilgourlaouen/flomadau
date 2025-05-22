<?php

namespace App\Resource;

use App\Entity\OptionSouscrite;
use App\Manager\OptionSouscriteManager;
use Floma\Resource\AbstractResource;

class OptionSouscriteResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private OptionSouscrite $optionSouscrite, array $context = [])
    {
        parent::__construct($optionSouscrite);
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
     * Données de base extraites de l'entité OptionSouscrite.
     */
    protected function baseData(): array
    {
        return [
            'id_offre' => $this->optionSouscrite->getIdOffre(),
            'id_option' => $this->optionSouscrite->getIdOption(),
            'nombre_jour' => $this->optionSouscrite->getNombreJour(),
            'date_debut' => $this->optionSouscrite->getDateDebut(),
            'date_fin' => $this->optionSouscrite->getDateFin(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(OptionSouscrite $optionSouscrite, array $context = []): array
    {
        return (new self($optionSouscrite, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($optionSouscrite) => self::build($optionSouscrite, $context), $entities);
    }
}