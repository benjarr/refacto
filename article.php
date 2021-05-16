<?php

/**
 * THIS FILE MUST SHOW AN ARTICLE AND ITS COMMENTS !
 *
 * We must first retrieve the "id" parameter which will be present in GET and verify its existence
 * If we don't have an "id", then we display an error message !
 *
 * Otherwise, we will connect to the database, retrieve comments from oldest to newest
 *
 * then display the article and its comments
 */
require_once('libraries/utils.php');
require_once('libraries/models/Article.php');
require_once('libraries/models/Comment.php');

$articleModel = new Article();
$commentModel = new Comment();

/**
 * 1. Retrieving the "id" and verifying it
 */
// We assume that we do not have an "id"
$article_id = null;

// But if there is one and it is an integer, so that's cool
if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $article_id = $_GET['id'];
}

// We can now decide: error or not?!
if (!$article_id) {
    die("You must specify an `id` parameter in the URL!");
}

/**
 * 3. Retrieving the article where id = article_id
 */
$article = $articleModel->find($article_id);
if (!$article) {
    die("Article $article_id doen't exist!");
}

/**
 * 4. Retrieving comments by article_id
 */
$comments = $commentModel->findAllBy($article_id);

/**
 * 5. Display
 */
$pageTitle = $article['title'];

render('articles/show', compact('pageTitle', 'article', 'comments', 'article_id'));
