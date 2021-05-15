<?php

/**
 * THIS FILE MUST RECORD A NEW COMMENT IS DIRECT ON THE ARTICLE!
 * 
 * We must first check that all the information has been entered in the form
 * If not: an error message
 * Otherwise, we'll save the information
 * 
 * To save the information, it would be good to be sure that the article we are trying to comment on exists.
 * It will therefore be necessary to make a first request to ensure that the article exists.
 * Then we can integrate the comment
 * 
 * And finally we can redirect the user to the article in question
 */
require_once('libraries/database.php');
require_once('libraries/utils.php');

/**
 * 1. We check that the data has been sent in POST
 * First, we get the information from POST
 * Then we check that they are not null
 */
// We start with the author
$author = null;
if (!empty($_POST['author'])) {
    $author = $_POST['author'];
}

// Then the content
$content = null;
if (!empty($_POST['content'])) {
    // We are still careful that the guy does not try weird tags in his comment
    $content = htmlspecialchars($_POST['content']);
}

// Finally the article id
$article_id = null;
if (!empty($_POST['article_id']) && ctype_digit($_POST['article_id'])) {
    $article_id = $_POST['article_id'];
}

// Final verification of the information sent in the form
// If there is no author OR there is no content OR there is no article id
if (!$author || !$article_id || !$content) {
    die("Your form was incorrectly completed!");
}

$article = findArticle($article_id);
// If nothing came back, we made a mistake
if (!$article) {
    die("Ho! The article $article_id does not exist boloss!");
}

/**
 * 3. Comment insertion
 */
insertComment($author, $content, $article_id);

/**
 * 4. Redirection to the article in question
 */
redirect("article.php?id=" . $article_id);
