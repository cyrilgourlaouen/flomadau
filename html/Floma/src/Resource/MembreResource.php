<?php

namespace App\Resource;

use App\Entity\Membre;
use Floma\Resource\AbstractResource;

class MembreResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Membre $membre, array $context = [])
    {
        parent::__construct($membre);
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
            'code'            => $this->membre->getCode(),
            'raison_sociale'  => $this->membre->getPseudo(),
            'id_compte'       => $this->membre->getIdCompte(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Membre $membre, array $context = []): array
    {
        return (new self($membre, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($membre) => self::build($membre, $context), $entities);
    }
}