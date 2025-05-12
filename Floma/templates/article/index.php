<h1>Articles du blog</h1>

<?php foreach ($data['articles'] as $article): ?>
    <article style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
        <h2><?= htmlspecialchars($article->getTitle()) ?></h2>
        <p><strong>Description :</strong> <?= htmlspecialchars($article->getDescription()) ?></p>
        <div><?= nl2br(htmlspecialchars($article->getContent())) ?></div>
    </article>
<?php endforeach; ?>

<hr>

<h2>Ajouter un nouvel article</h2>

<form action="?path=/blog/add" method="post">
    <p>
        <label for="title">Titre :</label><br>
        <input type="text" name="title" id="title" required>
    </p>

    <p>
        <label for="description">Description :</label><br>
        <input type="text" name="description" id="description" required>
    </p>

    <p>
        <label for="content">Contenu :</label><br>
        <textarea name="content" id="content" rows="6" required></textarea>
    </p>

    <p>
        <button type="submit">Publier</button>
    </p>
</form>
