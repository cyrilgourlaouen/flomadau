<?php
namespace App\Manager;

use App\Entity\Compte;
use Floma\Manager\AbstractManager;

/**
 * Class OfferManager
 *
 * @package App\Manager
 */
class CompteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Compte::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Compte::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Compte::class);
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
        return $this->readMany(Compte::class, $filters, $order, $limit, $offset);
    }

    public function updateCompte(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'nom' => $compte->getNom(),
            'prenom' => $compte->getPrenom(),
            'telephone' => $compte->getTelephone(),
        ];

        return $this->update(Compte::class, $fields, $id);
    }

    public function updateEmail(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'email'=> $compte->getEmail(),
        ];
        return $this->update(Compte::class, $fields, $id);
    }

    public function updatePassword(Compte $compte, int $id): \PDOStatement
    {
        $fields = [
            'mot_de_passe'=> $compte->getMotDePasse(),
        ];
        return $this->update(Compte::class, $fields, $id);
    }
}