<?php

namespace App\Resource;

use App\Entity\Offer;
use App\Entity\OptionSouscrite;
use App\Entity\OptionVisibilite;
use App\Enum\OfferCategoryEnum;
use App\Manager\OfferManager;
use App\Manager\OptionSouscriteManager;
use App\Manager\OptionVisibiliteManager;
use App\Manager\ProfessionnelManager;
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
        if (isset($context['categorie'])) {
            $isMultiple = (bool) ($context['categorie']['isMultiple'] ?? false);

            $enum = OfferCategoryEnum::tryFrom($this->offer->getCategorie());

            if ($enum != null) {
                $manager = $enum->getManager();
                $resource = $enum->getResource();

                $categoryData = $isMultiple
                    ? $resource::buildAll($manager->findBy(['id_offre' => $this->offer->getId()]))
                    : $resource::build($manager->findOneBy(['id_offre' => $this->offer->getId()]));


                $this->add('categoryData', $categoryData);
            }
        }

        if (isset($context['professionnel'])) {
            $isMultiple = (bool) ($context['professionnel']['isMultiple'] ?? false);

            $professionnelManager = new ProfessionnelManager();

            $professionnelResource = $isMultiple
                ? ProfessionnelResource::buildAll($professionnelManager->findBy(['id_compte' => $this->offer->getCodeProfessionnel()]))
                : ProfessionnelResource::build($professionnelManager->find($this->offer->getCodeProfessionnel()));

            $this->add('professionnelData', $professionnelResource);
        }

        if (isset($context['option'])) {
            $isMultiple = (bool) ($context['option']['isMultiple'] ?? false);

            $optionSouscriteManager = new OptionSouscriteManager();
            $optionVisibiliteManager = new OptionVisibiliteManager();

            $optionSouscrites = $optionSouscriteManager->findBy([
                'id_offre' => $this->offer->getId(),
            ]);

            if ($isMultiple) {
                $visibiliteResources = array_values(array_filter(array_map(
                    function (OptionSouscrite $optSouscrite) use ($optionVisibiliteManager) {
                        $visibilite = $optionVisibiliteManager->find($optSouscrite->getIdOption());
                        return $visibilite ? OptionVisibiliteResource::build($visibilite) : null;
                    },
                    $optionSouscrites
                )));
            } else {
                $firstOpt = $optionSouscrites[0] ?? null;
                $visibilite = $firstOpt ? $optionVisibiliteManager->find($firstOpt->getIdOption()) : null;
                $visibiliteResources = $visibilite ? OptionVisibiliteResource::build($visibilite) : null;
            }

            if ($visibiliteResources) {
                $this->add('optionVisibiliteData', $visibiliteResources);
            }
        }

    }

    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id' => $this->offer->getId(),
            'titre' => $this->offer->getTitre(),
            'resume' => $this->offer->getResume(),
            'ville' => $this->offer->getVille(),
            'code_postal' => $this->offer->getCodePostal(),
            'note_moyenne' => $this->offer->getNoteMoyenne(),
            'nombre_avis' => $this->offer->getNombreAvis(),
            'categorie' => $this->offer->getCategorie(),
            'conditions_accessibilite' => $this->offer->getConditionsAccessibilite(),
            'description_detaillee' => $this->offer->getDescriptionDetaillee(),
            'telephone' => $this->offer->getTelephone(),
            'nom_rue' => $this->offer->getNomRue(),
            'numero_rue' => $this->offer->getNumeroRue(),
            'complement_adresse' => $this->offer->getComplementAdresse(),
            'site_web' => $this->offer->getSiteWeb(),
            'en_ligne' => $this->offer->isEnLigne(),
            'code_professionnel' => $this->offer->getCodeProfessionnel(),
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
        return array_map(fn($offer) => self::build($offer, $context), $entities);
    }
}