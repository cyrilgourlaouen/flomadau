<?php
namespace App\Controller;

use App\Entity\Article;
use App\Manager\ArticleManager;
use Floma\Controller\AbstractController;

/**
 * Class ArticleController
 *
 * @package App\Controller
 */
class ArticleController extends AbstractController {

    /**
     * @return string
     */
    public function index() {
		$articleManager = new ArticleManager;
		return $this->renderView('article/index.php', [
			'articles' => $articleManager->findAll()
		]);
	}

    /**
     * @return string|null
     */
    public function add() {
		if (!empty($_POST)) {
			$article = new Article;
			$articleManager = new ArticleManager;
			$article->setTitle($_POST['title']);
			$article->setDescription($_POST['description']);
			$article->setContent($_POST['content']);
			$articleManager->add($article);
			return $this->redirectToRoute('/blog');
		}
		return $this->renderView('article/add.php');
	}

}