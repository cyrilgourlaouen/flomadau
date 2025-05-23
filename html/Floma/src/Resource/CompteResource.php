<?php

namespace App\Resource;

use App\Entity\Activite;
use App\Entity\Compte;
use App\Enum\CompteRoleEnum;
use Floma\Resource\AbstractResource;

class CompteResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Compte $compte, array $context = [])
    {
        parent::__construct($compte);
        $this->hydrate($context);
    }

    /**
     * Ajoute automatiquement les ressources supplémentaires si les managers
     * sont disponibles (ou instanciés par défaut).
     */
    private function hydrate(array $context): void
    {
        if (isset($context['gradeUser'])) {
            $isMultiple = (bool) ($context['gradeUser']['isMultiple'] ?? false);

            $enum = CompteRoleEnum::tryFrom("Professionnel");
            if ($enum != null) {
                $manager = $enum->getManager();
                $resource = $enum->getResource();
    
                $categoryData = $isMultiple
                    ? $resource::buildAll($manager->findBy(['id_compte' => $this->compte->getId()]))
                    : $resource::build($manager->findOneBy(['id_compte' => $this->compte->getId()]));
              
                $this->add('roleData', $categoryData);
            }
        }
    }

    /**
     * Données de base extraites de l'entité Offer.
     */
    protected function baseData(): array
    {
        return [
            'id' => $this->compte->getId(),
            'nom' => $this->compte->getNom(),
            'prenom' => $this->compte->getPrenom(),
            'email' => $this->compte->getEmail(),
            'telephone' => $this->compte->getTelephone(),
            'mot_de_passe' => $this->compte->getMotDePasse(),
            'ville' => $this->compte->getVille(),
            'code_postal' => $this->compte->getCodePostal(),
            'nom_rue' => $this->compte->getNomRue(),
            'numero_rue' => $this->compte->getNumeroRue(),
            'complement_adresse' => $this->compte->getComplementAdresse(),
            'url_photo_profil' => $this->compte->getUrlPhotoProfil(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Compte $compte, array $context = []): array
    {
        return (new self($compte, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($compte) => self::build($compte, $context), $entities);
    }
}