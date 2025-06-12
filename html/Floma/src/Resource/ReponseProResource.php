<?php

namespace App\Resource;

use App\Entity\ReponsePro;
use App\Manager\ReponseProManager;
use Floma\Resource\AbstractResource;

class ReponseProResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private ReponsePro $reponsePro, array $context = [])
    {
        parent::__construct($reponsePro);
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
     * Données de base extraites de l'entité Avis.
     */
    protected function baseData(): array
    {
        return [
            'id' => $this->reponsePro->getId(),
            'reponse' => $this->reponsePro->getReponse(),
            'signalement' => $this->reponsePro->isSignalement(),
            'id_avis' => $this->reponsePro->getIdAvis(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(ReponsePro $reponsePro, array $context = []): array
    {
        return (new self($reponsePro, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($reponsePro) => self::build($reponsePro, $context), $entities);
    }
}