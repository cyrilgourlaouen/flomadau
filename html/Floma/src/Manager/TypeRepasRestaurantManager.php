<?php
namespace App\Manager;

use App\Entity\LangueGuideVisite;
use App\Entity\TypeRepasRestaurant;
use Floma\Manager\AbstractManager;

/**
 * Class TagManager
 *
 * @package App\Manager
 */
class TypeRepasRestaurantManager extends AbstractManager
{
       /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(TypeRepasRestaurant::class, ['id_tag' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(TypeRepasRestaurant::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(TypeRepasRestaurant::class);
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
        return $this->readMany(TypeRepasRestaurant  ::class, $filters, $order, $limit, $offset);
    }
}
