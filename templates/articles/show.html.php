<h1><?= $article['title'] ?></h1>
<small>Written on <?= $article['created_at'] ?></small>
<p><?= $article['introduction'] ?></p>
<hr>
<?= $article['content'] ?>
<hr>

<?php if (count($comments) === 0) : ?>
    <h2>There are no comments yet for this article ... BE THE FIRST! :D</h2>
<?php else : ?>
    <h2 class="badge badge-info">There is already <?= count($comments) ?> reactions</h2>
    <?php foreach ($comments as $comment) : ?>
        <div class="card border-light mb-3">
            <div class="card-body text-secondary">
                <h5 class="card-title">Commented by <?= $comment['author'] ?> <small class="text-warning">Le <?= $comment['created_at'] ?></small></h5>
                <p class="card-text"><small><?= $comment['content'] ?></small></p>
                <a class="btn btn-outline-secondary" href="index.php?controller=comment&task=delete&id=<?= $comment['id'] ?>" onclick="return window.confirm(`Are you sure you want to delete this comment ?!`)">Delete</a>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<hr>
<form class="mb-5" action="index.php?controller=comment&task=insert" method="POST">
    <div class="form-group">
        <h3>Do you want to react? Don't hesitate bros!</h3>
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="author" placeholder="Your username!">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="content" id="" cols="30" rows="10" placeholder="Your comment ..."></textarea>
    </div>
    <input type="hidden" name="article_id" value="<?= $article_id ?>">
    <button class="btn btn-primary">Comment!</button>
    <a class="btn btn-outline-success float-right" href="index.php">Return to the Articles list</a>
</form>