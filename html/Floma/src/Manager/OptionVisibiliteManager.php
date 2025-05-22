<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\OptionVisibilite;

/**
 * Class OptionVisibiliteManager
 *
 * @package App\Manager
 */
class OptionVisibiliteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(OptionVisibilite::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(OptionVisibilite::class, $filters);
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
        return $this->readMany(OptionVisibilite::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(OptionVisibilite::class);
    }
}