<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Image;
use App\Entity\JourOuvertureOffre;

/**
 * Class ImageManager
 *
 * @package App\Manager
 */
class JourOuvertureOffreManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(JourOuvertureOffre::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(JourOuvertureOffre::class, $filters);
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
        return $this->readMany(JourOuvertureOffre::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(JourOuvertureOffre::class);
    }

    public function add(JourOuvertureOffre $jourOuvertureOffre) {
		return $this->create(JourOuvertureOffre::class, [
				'id_offre' => $jourOuvertureOffre->getIdOffre(),
                'id_jour' => $jourOuvertureOffre->getIdJour(),
                'horaire_debut' => $jourOuvertureOffre->getHoraireDebut(),
                'horaire_fin' => $jourOuvertureOffre->getHoraireFin(),
			]
		);
	}
}