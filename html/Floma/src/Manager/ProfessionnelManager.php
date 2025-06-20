<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Professionnel;

/**
 * Class ProfessionnelManager
 *
 * @package App\Manager
 */
class ProfessionnelManager extends AbstractManager
{
    public function add(Professionnel $professionnel)
    {
        return $this->createGetCode(Professionnel::class, [
            'id_compte' => $professionnel->getIdCompte(),
            'raison_sociale' => $professionnel->getRaisonSociale(),
            'est_prive' => $professionnel->isPrive() ? 'true' : 'false'
        ]);
    }
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Professionnel::class, ['code' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Professionnel::class, $filters);
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
        return $this->readMany(Professionnel::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Professionnel::class);
    }

    /**
     * @param Professionnel $pro
     * @param int $id
     * @return \PDOStatement
     */
    public function updateCompte(Professionnel $pro, int $id): \PDOStatement
    {
        $fields = [
            'raison_sociale' => $pro->getRaisonSociale(),
        ];

        return $this->update(Professionnel::class, $fields, $id, true);
    }
}