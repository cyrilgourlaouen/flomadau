<?php
namespace App\Manager;

use App\Entity\LangueGuide;
use Floma\Manager\AbstractManager;

/**
 * Class TagManager
 *
 * @package App\Manager
 */
class LangueGuideManager extends AbstractManager
{
       /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(LangueGuide::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(LangueGuide::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(LangueGuide::class);
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
        return $this->readMany(LangueGuide  ::class, $filters, $order, $limit, $offset);
    }
}
