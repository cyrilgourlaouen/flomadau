<?php

namespace App\Resource;

use App\Entity\ProPrive;
use Floma\Resource\AbstractResource;

class ProPriveResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private ProPrive $proPrive, array $context = [])
    {
        parent::__construct($proPrive);
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
            'siren'=> $this->proPrive->getSiren(),
            'numero_carte'=> $this->proPrive->getNumeroCarte(),
            'date_expiration'=> $this->proPrive->getDateExpiration(),
            'code_professionnel'=> $this->proPrive->getCodeProfessionnel(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(ProPrive $proPrive, array $context = []): array
    {
        return (new self($proPrive, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($proPrive) => self::build($proPrive, $context), $entities);
    }
}