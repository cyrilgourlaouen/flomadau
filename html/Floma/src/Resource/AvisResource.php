<?php

namespace App\Resource;

use App\Entity\Avis;
use App\Manager\AvisManager;
use App\Manager\ReponseProManager;
use Floma\Resource\AbstractResource;

class AvisResource extends AbstractResource
{
    /**
     * Constructeur. Si un contexte (managers) est fourni, on enrichit aussitôt.
     */
    public function __construct(private Avis $avis, array $context = [])
    {
        parent::__construct($avis);
        $this->hydrate($context);
    }

    /**
     * Ajoute automatiquement les ressources supplémentaires si les managers
     * sont disponibles (ou instanciés par défaut).
     */
    private function hydrate(array $context): void
    {
        if(isset($context['reponsePro'])){
            $reponseProManager = new ReponseProManager();

            $reponsePro = ReponseProResource::buildAll($reponseProManager->findBy(['id_avis' => $this->avis->getId()]));

            $this->add('ReponseProData', $reponsePro);
        }
    }

    /**
     * Données de base extraites de l'entité Avis.
     */
    protected function baseData(): array
    {
        return [
            'id' => $this->avis->getId(),
            'titre' => $this->avis->getTitre(),
            'note' => $this->avis->getNote(),
            'commentaire' => $this->avis->getCommentaire(),
            'date_publication' => $this->avis->getDatePublication(),
            'date_visite'=> $this->avis->getDateVisite(),
            'contexte_visite' => $this->avis->getContexteVisite(),
            'nb_like' => $this->avis->getNbLike(),
            'nb_dislike' => $this->avis->getNbDislike(),
            'signalements' => $this->avis->getSignalements(),
            'signalement_pro' => $this->avis->isSignalementPro(),
            'id_offre' => $this->avis->getPrestationsNonIncluses(),
            'code_membre' => $this->avis->getCodeMembre(),
        ];
    }


    /**
     * Construit une ressource enrichie pour UNE offre.
     */
    public static function build(Avis $avis, array $context = []): array
    {
        return (new self($avis, $context))->toArray();
    }

    /**
     * Construit des ressources enrichies pour PLUSIEURS offres.
     */
    public static function buildAll(array $entities, array $context = []): array
    {
        return array_map(fn($avis) => self::build($avis, $context), $entities);
    }
}