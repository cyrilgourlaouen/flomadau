<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Activite;

/**
 * Class ActiviteManager
 *
 * @package App\Manager
 */
class ActiviteManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Activite::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Activite::class, $filters);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Activite::class);
    }

    public function add(Activite $activite) {
		return $this->create(Activite::class, [
				'duree' => $activite->getDuree(),
                'age_requis' => $activite->getAgeRequis(),
                'prestations_incluses' => $activite->getPrestationsIncluses(),
                'prestations_non_incluses' => $activite->getPrestationsNonIncluses(),
                'prix_minimal' => $activite->getPrixMinimal(),
                'id_offre' => $activite->getIdOffre(),
			]
		);
	}
}