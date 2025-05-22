<?php

namespace App\Resource;

use App\Entity\Image;
use App\Manager\ImageManager;
use Floma\Resource\AbstractResource;

class ImageResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Image $image, array $context = [])
    {
        parent::__construct($image);
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
            'id' => $this->image->getId(),
            'url_img' => $this->image->getUrlImg(),
            'principale' => $this->image->isPrincipale(),
            'id_offre' => $this->image->getIdOffre(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Image $image, array $context = []): array
    {
        return (new self($image, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($image) => self::build($image, $context), $entities);
    }
}