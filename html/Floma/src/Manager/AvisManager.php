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

    /**
     * @param array $filters
     * @param array $order
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
     */
    public function findBy(array $filters, array $order = [], ?int $limit = null, ?int $offset = null)
    {
        return $this->readMany(Avis::class, $filters, $order, $limit, $offset);
    }

    public function add(Avis $avis) {
		return $this->create(Avis::class, [
				'titre' => $avis->getTitre(),
                'commentaire' => $avis->getCommentaire(),
                'date_visite' => $avis->getDateVisite(),
                'contexte_visite' => $avis->getContexteVisite(),
                'note' => $avis->getNote(),
                'code_membre' => $avis->getCodeMembre(),
                'id_offre' => $avis->getIdOffre(),
                'date_publication' => $avis->getDatePublication(),
			]
		);
	}
}