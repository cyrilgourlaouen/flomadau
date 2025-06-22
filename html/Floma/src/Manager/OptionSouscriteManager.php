<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\OptionSouscrite;

/**
 * Class OptionSouscriteManager
 *
 * @package App\Manager
 */
class OptionSouscriteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(OptionSouscrite::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(OptionSouscrite::class, $filters);
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
        return $this->readMany(OptionSouscrite::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(OptionSouscrite::class);
    }

    public function add(OptionSouscrite $optionSouscrite) {
		return $this->create(OptionSouscrite::class, [
				'id_offre' => $optionSouscrite->getIdOffre(),
                'id_option' => $optionSouscrite->getIdOption(),
                'nombre_jour' => $optionSouscrite->getNombreJour(),
                'date_debut' => $optionSouscrite->getDateDebut(),
                'date_fin' => $optionSouscrite->getDateFin(),
			]
		);
	}
}