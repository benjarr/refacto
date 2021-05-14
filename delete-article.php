<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE ARTICLE WHOSE ID IS PASSED IN GET
 *
 * It will therefore be necessary to make sure that an "id" is passed in GET, then that this article exists
 * Then, we will be able to delete article and redirect to the home page
 */

/**
 * 1. We check that GET have an "id" and it is a number
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! You did not specify the article id!");
}

$id = $_GET['id'];

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
 * 3. Check that the article exist
 */
$query = $pdo->prepare('SELECT * FROM articles WHERE id = :id');
$query->execute(['id' => $id]);
if ($query->rowCount() === 0) {
    die("Item $id does not exist, so you cannot delete it!");
}

/**
 * 4. Real suppression of the article
 */
$query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
$query->execute(['id' => $id]);

/**
 * 5. Redirection to the home page
 */
header("Location: index.php");
exit();
