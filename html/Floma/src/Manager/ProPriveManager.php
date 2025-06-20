<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\ProPrive;

/**
 * Class ProfessionnelManager
 *
 * @package App\Manager
 */
class ProPriveManager extends AbstractManager
{
    public function add (ProPrive $proPrive)
    {
        return $this->create(ProPrive::class, [
            'siren' => $proPrive->getSiren(),
            'code_professionnel' => $proPrive->getCodeProfessionnel(),
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(ProPrive::class, ['code_professionnel' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(ProPrive::class, $filters);
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
        return $this->readMany(ProPrive::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(ProPrive::class);
    }

    
    /**
     * @param ProPrive $proPrive
     * @param int $id
     * @return \PDOStatement
     */
    public function updateCompte(ProPrive $proPrive, int $id): \PDOStatement
    {
        $fields = [
            'siren' => $proPrive->getSiren(),
            'numero_carte' => $proPrive->getNumeroCarte(),
            'date_expiration' => $proPrive->getDateExpiration(),
        ];

        return $this->update(ProPrive::class, $fields, $id, false, true);
    }
}