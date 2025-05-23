<?php

namespace App\Resource;

use App\Entity\Professionnel;
use App\Entity\Tag;
use App\Manager\ProfessionnelManager;
use Floma\Resource\AbstractResource;

class TagResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Tag $tag, array $context = [])
    {
        parent::__construct($tag);
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
            'id'            => $this->tag->getId(),
            'nom_tag'  => $this->tag->getNomTag(),
            'tag_restaurant'       => $this->tag->isTagRestaurant(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Tag $tag, array $context = []): array
    {
        return (new self($tag, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($tag) => self::build($tag, $context), $entities);
    }
}