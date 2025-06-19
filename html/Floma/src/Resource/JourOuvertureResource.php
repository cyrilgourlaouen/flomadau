<?php

namespace App\Resource;

use App\Entity\JourOuverture;
use Floma\Resource\AbstractResource;

class JourOuvertureResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private JourOuverture $jourOuverture, array $context = [])
    {
        parent::__construct($jourOuverture);
        $this->hydrate($context);
    }

    /**
     * Ajoute automatiquement les ressources supplémentaires si les managers
     * sont disponibles (ou instanciés par défaut).
     */
    private function hydrate(array $context): void
    {
        if (isset($context['jour_ouverture_offre'])) {
            $this->add([
                'horaire_debut' => $context['jour_ouverture_offre']->getHoraireDebut(),
                'horaire_fin' => $context['jour_ouverture_offre']->getHoraireFin(),
            ]);
        }
    }



    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id' => $this->jourOuverture->getId(),
            'nom_jour'  => $this->jourOuverture->getNomJour(),
        ];
    }

    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(JourOuverture $jourOuverture, array $context = []): array
    {
        return (new self($jourOuverture, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($jourOuverture) => self::build($jourOuverture, $context), $entities);
    }
}