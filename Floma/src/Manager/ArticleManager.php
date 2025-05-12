<?php
namespace App\Manager;

use Floma\Manager\AbstractManager;
use App\Entity\Article;
use PDOStatement;

/**
 * Class ArticleManager
 *
 * @package App\Manager
 */
class ArticleManager extends AbstractManager {

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id) {
		return $this->readOne(Article::class, [ 'id' => $id ]);
	}

    /**
     * @param array $filters
     * @return mixed
     */
    public function findOneBy(array $filters) {
		return $this->readOne(Article::class, $filters);
	}

    /**
     * @return mixed
     */
    public function findAll() {
		return $this->readMany(Article::class);
	}

    /**
     * @param array $filters
     * @param array $order
     * @param int|null $limit
     * @param int|null $offset
     * @return mixed
     */
    public function findBy(array $filters, array $order = [], int $limit = null, int $offset = null) {
		return $this->readMany(Article::class, $filters, $order, $limit, $offset);
	}

    /**
     * @param Article $article
     * @return PDOStatement
     */
    public function add(Article $article) {
		return $this->create(Article::class, [
				'title' => $article->getTitle(),
				'description' => $article->getDescription(),
				'content' => $article->getContent()
			]
		);
	}

    /**
     * @param Article $article
     * @return PDOStatement
     */
    public function edit(Article $article) {
		return $this->update(Article::class, [
				'title' => $article->getTitle(),
				'description' => $article->getDescription(),
				'content' => $article->getContent()
			],
			$article->getId()
		);
	}

    /**
     * @param Article $article
     * @return PDOStatement
     */
    public function delete(Article $article) {
		return $this->remove(Article::class, $article->getId());
	}
}