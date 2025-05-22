<?php

namespace App\Resource;

use App\Entity\OptionVisibilite;
use App\Manager\OptionVisibiliteManager;
use Floma\Resource\AbstractResource;

class OptionVisibiliteResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private OptionVisibilite $optionVisibilite, array $context = [])
    {
        parent::__construct($optionVisibilite);
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
     * Données de base extraites de l'entité OptionVisibilite.
     */
    protected function baseData(): array
    {
        return [
            'id'         => $this->optionVisibilite->getId(),
            'nom_option' => $this->optionVisibilite->getNomOption(),
            'prix'       => $this->optionVisibilite->getPrix(),
        ];
    }

    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(OptionVisibilite $optionVisibilite, array $context = []): array
    {
        return (new self($optionVisibilite, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($optionVisibilite) => self::build($optionVisibilite, $context), $entities);
    }
}