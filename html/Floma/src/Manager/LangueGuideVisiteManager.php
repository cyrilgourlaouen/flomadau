<?php
namespace App\Manager;

use App\Entity\LangueGuideVisite;
use Floma\Manager\AbstractManager;

/**
 * Class TagManager
 *
 * @package App\Manager
 */
class LangueGuideVisiteManager extends AbstractManager
{
       /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(LangueGuideVisite::class, ['id_tag' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(LangueGuideVisite::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(LangueGuideVisite::class);
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
        return $this->readMany(LangueGuideVisite  ::class, $filters, $order, $limit, $offset);
    }

    public function add(LangueGuideVisite $langueGuideVisite) {
		return $this->create(LangueGuideVisite::class, [
				'id_langue' => $langueGuideVisite->getIdLangue(),
                'id_offre' => $langueGuideVisite->getIdOffre(),
			]
		);
	}
}
