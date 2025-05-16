# Floma Framework - Documentation simplifiée

> Mini-framework PHP MVC pédagogique, inspiré de [LaConsole.dev](https://laconsole.dev/formations/framework-php).

## 🚧 Structure du projet

```
Floma/
├── config/            # Configuration (BDD, routes)
├── lib/               # Coeur du framework (router, controller, manager)
├── public/            # Point d'entrée (index.php)
├── src/               # Code métier : contrôleurs, entités, managers
├── templates/         # Vues HTML
```

## ⚙️ Fonctionnement général

### 🔁 Autoload (`lib/autoload.php`)

Charge automatiquement les classes selon leur namespace :

* `App\` → `src/`
* `Floma\` → `lib/`

```php
spl_autoload_register(function ($class) {
    $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/../' . $classPath . '.php';
    if (file_exists($file)) {
        require $file;
    }
});
```

### 🌐 Routage (`lib/Router/Router.php`)

Analyse l'URL via `?path=/quelque-chose` et exécute le bon contrôleur :

```php
const ROUTES = [
  '/blog' => [
    'controller' => App\Controller\ArticleController::class,
    'method' => 'index',
    'view' => true
  ],
  '/blog/add' => [
    'controller' => App\Controller\ArticleController::class,
    'method' => 'add',
    'view' => false // accessible uniquement en POST
  ]
];
```

Si `view` est à `false` et la méthode est `GET`, l’accès est bloqué.

### 🧠 Contrôleurs (`src/Controller/`)

Les classes héritent de `AbstractController` et peuvent :

* `renderView('vue.php', $data)`
* `redirectToRoute('/blog')`

### 📥 Récupérer un paramètre d'URL (ex: ID)

Dans le fichier `config/routes.php`, une route peut contenir des paramètres dynamiques :

```php
$router->get('/article/{id}', 'ArticleController@show');


### 🗃️ Managers & Entités

* `src/Entity` : objets métiers (ex. `Article`)
* `src/Manager` : accès à la BDD via `AbstractManager`

Exemple :

```php
$manager = new ArticleManager();
$articles = $manager->findAll();
```

---

## ✅ Ajouter une fonctionnalité complète : exemple "commentaire"

### 1. Créer une entité `Comment.php`

```php
namespace App\Entity;
class Comment {
  private int $id;
  private int $articleId;
  private string $content;
  // Getters/setters
}
```

### 2. Créer un manager `CommentManager.php`

```php
class CommentManager extends AbstractManager {
  public function findAllByArticle(int $articleId) {
    return $this->readMany(Comment::class, ['article_id' => $articleId]);
  }

  public function create(Comment $comment) {
    $this->insert($comment);
  }
}
```

### 3. Ajouter un contrôleur `CommentController.php`

```php
class CommentController extends AbstractController {
  public function add(int $articleId) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $comment = new Comment();
      $comment->setArticleId($articleId);
      $comment->setContent($_POST['content']);

      $manager = new CommentManager();
      $manager->create($comment);
    }
    $this->redirectToRoute('/blog');
  }
}
```

### 4. Ajouter la route

```php
'/comment/add/{articleId}' => [
  'controller' => App\Controller\CommentController::class,
  'method' => 'add',
  'view' => false
],
```

### 5. Ajouter un formulaire dans la vue `article/index.php`

```php
<form action="?path=/comment/add/<?= $article->getId() ?>" method="post">
  <textarea name="content" required></textarea>
  <button type="submit">Commenter</button>
</form>
```

---

## ✅ Astuces

* Place les classes applicatives dans `src/` (pas dans `lib/`)
* Chaque entité a son manager et son contrôleur
* Utilise `view => false` pour les routes de traitement POST (ex: création, suppression)

---

## 🧪 Tester localement

1. Lancer PHP :

```bash
cd Floma/public
php -S localhost:8000
```

2. Accéder à l'app :

```
http://localhost:8000/?path=/blog
```

---

Bonne collaboration et bon code 👨‍💻
