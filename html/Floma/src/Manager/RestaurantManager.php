<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Restaurant;

/**
 * Class RestaurantManager
 *
 * @package App\Manager
 */
class RestaurantManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Restaurant::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Restaurant::class, $filters);
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
        return $this->readMany(Restaurant::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Restaurant::class);
    }

    public function add(Restaurant $restaurant) {
		return $this->create(Restaurant::class, [
				'id_offre' => $restaurant->getIdOffre(),
                'url_carte_restaurant' => $restaurant->getUrlCarteRestaurant(),
                'gamme_de_prix' => $restaurant->getGammeDePrix(),
			]
		);
	}
}