<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Offer;
use App\Enum\OfferCategoryEnum;

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
                'conditions_accessibilite' => $offer->getConditionAccessibilite()
			]
		);
	}
}