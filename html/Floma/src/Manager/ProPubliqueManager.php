<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\ProPublique;

/**
 * Class ProfessionnelManager
 *
 * @package App\Manager
 */
class ProPubliqueManager extends AbstractManager
{
    public function add(ProPublique $proPublique)
    {
        return $this->create(ProPublique::class, [
            'code_professionnel' => $proPublique->getCodeProfessionnel(),
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(ProPublique::class, ['code_professionnel' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(ProPublique::class, $filters);
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
        return $this->readMany(ProPublique::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(ProPublique::class);
    }
}
