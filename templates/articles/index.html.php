<h1>Our articles</h1>
<hr>

<?php foreach ($articles as $article) : ?>
    <h2><?= $article['title'] ?></h2>
    <small>Written on <?= $article['created_at'] ?></small>
    <p><?= $article['introduction'] ?></p>
    <a href="article.php?id=<?= $article['id'] ?>">Read more</a> |
    <a href="delete-article.php?id=<?= $article['id'] ?>" onclick="return window.confirm(`Are you sure you want to delete this article ?!`)">Delete</a>
<?php endforeach ?>