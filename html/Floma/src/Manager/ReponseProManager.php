<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\ReponsePro;

/**
 * Class ReponseProManager
 *
 * @package App\Manager
 */
class ReponseProManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(ReponsePro::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(ReponsePro::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(ReponsePro::class);
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
        return $this->readMany(ReponsePro::class, $filters, $order, $limit, $offset);
    }
}