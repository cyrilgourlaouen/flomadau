<?php
namespace App\Manager;

use App\Entity\Membre;
use Floma\Manager\AbstractManager;

/**
 * Class ProfessionnelManager
 *
 * @package App\Manager
 */
class MembreManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Membre::class, ['code' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Membre::class, $filters);
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
        return $this->readMany(Membre::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Membre::class);
    }

    public function updateMembre(Membre $membre, int $id): \PDOStatement
    {
        $fields = [
            'pseudo' => $membre->getPseudo(), 

        ];

        return $this->update(Membre::class, $fields, $id , 'id_compte');
    }
}