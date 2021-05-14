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
    die("You must specify an `id` parameter in the URL !");
}

/**
 * 2. Connection to the database with PDO
 *
 * PS: You notice that these are the same lines as for index.php ?!
 */
$pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/**
 * 3. Retrieving the article where id = article_id
 * Here we will use a prepared query because it includes a variable that comes from the user :
 * Never trust users!
 */
$query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
$query->execute(['article_id' => $article_id]);
$article = $query->fetch();

/**
 * 4. Retrieving comments from the article who have id = article_id
 * Same, always a prepared request to secure the data sent by the user
 */
$query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
$query->execute(['article_id' => $article_id]);
$comments = $query->fetchAll();

/**
 * 5. Display
 */
$pageTitle = $article['title'];
ob_start();
require('templates/articles/show.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
