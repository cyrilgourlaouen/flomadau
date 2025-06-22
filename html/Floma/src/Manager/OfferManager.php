<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Offer;
use App\Manager\AvisManager;
use App\Enum\OfferCategoryEnum;
use App\Resource\AvisResource;

/**
 * Class OfferManager
 *
 * @package App\Manager
 */
class OfferManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Offer::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Offer::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Offer::class);
    }

    /**
     * @param array $filters
     * @param array $order
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
     */
    public function findBy(array $filters, array $order = [], ?int $limit = null, ?int $offset = null)
    {
        return $this->readMany(Offer::class, $filters, $order, $limit, $offset);
    }

    public function add(Offer $offer) {
		return $this->create(Offer::class, [
				'titre' => $offer->getTitre(),
                'resume' => $offer->getResume(),
                'ville' => $offer->getVille(),
                'code_postal' => $offer->getCodePostal(),
                'categorie' => $offer->getCategorie(),
                'conditions_accessibilite' => $offer->getConditionsAccessibilite(),
                'telephone' => $offer->getTelephone(),
                'site_web' => $offer->getSiteWeb(),
                'description_detaillee' => $offer->getDescriptionDetaillee(),
                'nom_rue' => $offer->getNomRue(),
                'numero_rue' => $offer->getNumeroRue(),
                'code_professionnel' => $offer->getCodeProfessionnel(),
			]
		);
	}

    public function addGetId(Offer $offer) {
        
		return $this->createGetId(Offer::class, [
				'titre' => $offer->getTitre(),
                'resume' => $offer->getResume(),
                'ville' => $offer->getVille(),
                'code_postal' => $offer->getCodePostal(),
                'categorie' => $offer->getCategorie(),
                'conditions_accessibilite' => $offer->getConditionsAccessibilite(),
                'telephone' => $offer->getTelephone(),
                'site_web' => $offer->getSiteWeb(),
                'description_detaillee' => $offer->getDescriptionDetaillee(),
                'nom_rue' => $offer->getNomRue(),
                'numero_rue' => $offer->getNumeroRue(),
                'code_professionnel' => $offer->getCodeProfessionnel(),
                'complement_adresse' => $offer->getComplementAdresse() ?? $offer->getComplementAdresse(),
			]
		);
	}

    /**
     * @param int $id
     * @return \PDOStatement
     */
    public function updateNoteMoy(int $id): \PDOStatement
    {
        $offre = $this->find($id);
        $noteMoy = $offre->getNoteMoyenne();

        $avisManager = new AvisManager();

        $avis = AvisResource::buildAll($avisManager->findBy(['id_offre' => $id]));
        
        $notes = 0;
        $total = 0;

        foreach($avis as $un_avis){
            $notes += $un_avis['note'];
            $total ++;
        }

        $fields = [
            'note_moyenne' => $notes / $total,
        ];

        return $this->update(Offer::class, $fields, $id);
    }
}