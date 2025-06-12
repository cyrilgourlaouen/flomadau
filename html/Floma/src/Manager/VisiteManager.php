<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Visite;

/**
 * Class VisiteManager
 *
 * @package App\Manager
 */
class VisiteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Visite::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Visite::class, $filters);
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
        return $this->readMany(Visite::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Visite::class);
    }

    public function add(Visite $visite) {
		return $this->create(Visite::class, [
				'id_offre' => $visite->getIdOffre(),
                'duree' => $visite->getDuree(),
                'prix_minimal' => $visite->getPrixMinimal(),
			]
		);
	}
}