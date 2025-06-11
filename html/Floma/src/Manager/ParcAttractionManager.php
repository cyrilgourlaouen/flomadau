<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\ParcAttraction;

/**
 * Class ParcAttractionManager
 *
 * @package App\Manager
 */
class ParcAttractionManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(ParcAttraction::class, ['code' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(ParcAttraction::class, $filters);
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
        return $this->readMany(ParcAttraction::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(ParcAttraction::class);
    }

    public function add(ParcAttraction $amusementParc) {
		return $this->create(ParcAttraction::class, [
				'age_requis' => $amusementParc->getAgeRequis(),
                'nb_attraction' => $amusementParc->getNombreAttraction(),
                'url_plan' => $amusementParc->getUrlPlan(),
                'prix_minimal' => $amusementParc->getPrixMinimal(),
			]
		);
	}
}