<?php

namespace App\Resource;

use App\Entity\Professionnel;
use App\Manager\ProfessionnelManager;
use Floma\Resource\AbstractResource;

class ProfessionnelResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Professionnel $professionnel, array $context = [])
    {
        parent::__construct($professionnel);
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
            'code'            => $this->professionnel->getCode(),
            'raison_sociale'  => $this->professionnel->getRaisonSociale(),
            'id_compte'       => $this->professionnel->getIdCompte(),
            'est_prive'       => $this->professionnel->isPrive(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Professionnel $professionnel, array $context = []): array
    {
        return (new self($professionnel, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($professionnel) => self::build($professionnel, $context), $entities);
    }
}