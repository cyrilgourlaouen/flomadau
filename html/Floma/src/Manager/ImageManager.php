<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Image;

/**
 * Class ImageManager
 *
 * @package App\Manager
 */
class ImageManager extends AbstractManager
{
    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->readOne(Image::class, ['id' => $id]);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters)
    {
        return $this->readOne(Image::class, $filters);
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
        return $this->readMany(Image::class, $filters, $order, $limit, $offset);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->readMany(Image::class);
    }

    public function add(Image $image) {
		return $this->create(Image::class, [
				'id_offre' => $image->getIdOffre(),
                'url_img' => $image->getUrlImg(),
                'principale' => $image->isPrincipale(),
			]
		);
	}
}