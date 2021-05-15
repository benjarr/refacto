<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE COMMENT WHOSE ID IS PASSED IN GET
 *
 * We will therefore check that the "id" is present in GET, that it corresponds to an existing comment
 * Then we will delete it!
 */
require_once('libraries/database.php');
require_once('libraries/utils.php');

/**
 * 1. Retrieving the "id" in GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho! Had to specify the id parameter in GET!");
}

$id = $_GET['id'];

/**
 * 2. Connection to the database with PDO
 *
 * PS: You notice that these are the same lines as for index.php ?!
 */
$pdo = getPdo();

/**
 * 3. Check that the comment exist
 */
$query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
    die("Item $id does not exist, so you cannot delete it!");
}

/**
 * 4. Real suppression of the comment
 * On récupère l'identifiant de l'article avant de supprimer le commentaire
 */

$commentaire = $query->fetch();
$article_id = $commentaire['article_id'];

$query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
$query->execute(['id' => $id]);

/**
 * 5. Redirection to the article in question
 */
redirect("article.php?id=" . $article_id);
