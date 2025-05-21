<?php

namespace App\Resource;

use App\Entity\Offer;
use App\Manager\OfferManager;
use Floma\Resource\AbstractResource;

class OfferResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Offer $offer, array $context = [])
    {
        parent::__construct($offer);
        $this->hydrate($context);
    }

    /**
     * Ajoute automatiquement les ressources supplémentaires si les managers
     * sont disponibles (ou instanciés par défaut).
     */
    private function hydrate(array $context): void
    {
        // OfferManager pour la catégorie
        $offerManager = $context['offerManager'] ?? new OfferManager();
        $categoryData = $offerManager->getCategoryInfo(
            $this->offer->getCategorie(),
            $this->offer->getId()
        );
        $this->add('categoryData', $categoryData);
    }

    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id'                      => $this->offer->getId(),
            'titre'                   => $this->offer->getTitre(),
            'resume'                  => $this->offer->getResume(),
            'ville'                   => $this->offer->getVille(),
            'code_postal'             => $this->offer->getCodePostal(),
            'note_moyenne'            => $this->offer->getNoteMoyenne(),
            'nombre_avis'             => $this->offer->getNombreAvis(),
            'categorie'               => $this->offer->getCategorie(),
            'conditions_accessibilite'=> $this->offer->getConditionsAccessibilite(),
            'description_detaillee'   => $this->offer->getDescriptionDetaillee(),
            'telephone'               => $this->offer->getTelephone(),
            'nom_rue'                 => $this->offer->getNomRue(),
            'numero_rue'              => $this->offer->getNumeroRue(),
            'complement_adresse'      => $this->offer->getComplementAdresse(),
            'site_web'                => $this->offer->getSiteWeb(),
            'en_ligne'                => $this->offer->isEnLigne(),
            'code_professionnel'      => $this->offer->getCodeProfessionnel(),
        ];
    }

    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Offer $offer, array $context = []): array
    {
        return (new self($offer, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($o) => self::build($o, $context), $entities);
    }
}