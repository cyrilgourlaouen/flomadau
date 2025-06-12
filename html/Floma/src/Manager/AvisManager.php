<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Avis;

/**
 * Class AvisManager
 *
 * @package App\Manager
 */
class AvisManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Avis::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Avis::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Avis::class);
    }
}