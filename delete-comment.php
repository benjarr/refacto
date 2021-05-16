<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE COMMENT WHOSE ID IS PASSED IN GET
 *
 * We will therefore check that the "id" is present in GET, that it corresponds to an existing comment
 * Then we will delete it!
 */
require_once('libraries/utils.php');
require_once('libraries/models/Comment.php');

$model = new Comment();

/**
 * 1. Retrieving the "id" in GET
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho! Had to specify the id parameter in GET!");
}

$id = $_GET['id'];

/**
 * 3. Check that the comment exist
 */
$comment = $model->find($id);
if (!$comment) {
    die("Item $id does not exist, so you cannot delete it!");
}

/**
 * 4. Real suppression of the comment
 */
$article_id = $comment['article_id'];

$model->delete($id);

/**
 * 5. Redirection to the article in question
 */
redirect("article.php?id=" . $article_id);
