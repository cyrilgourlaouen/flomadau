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
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Visite::class);
    }
}