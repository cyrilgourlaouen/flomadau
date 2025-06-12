<?php
namespace App\Manager;

use App\Entity\LangueGuide;
use App\Entity\TypeRepas;
use Floma\Manager\AbstractManager;

/**
 * Class TagManager
 *
 * @package App\Manager
 */
class TypeRepasManager extends AbstractManager
{
       /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(TypeRepas::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(TypeRepas::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(TypeRepas::class);
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
        return $this->readMany(TypeRepas  ::class, $filters, $order, $limit, $offset);
    }

    public function add(TypeRepas $typeRepas) {
		return $this->create(TypeRepas::class, [
				'id' => $typeRepas->getId(),
                'nom_type' => $typeRepas->getNomType(),
			]
		);
	}
}
