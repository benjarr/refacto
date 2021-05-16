<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE ARTICLE WHOSE ID IS PASSED IN GET
 *
 * It will therefore be necessary to make sure that an "id" is passed in GET, then that this article exists
 * Then, we will be able to delete article and redirect to the home page
 */
require_once('libraries/utils.php');
require_once('libraries/models/Article.php');

$model = new Article();

/**
 * 1. We check that GET have an "id" and it is a number
 */
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    die("Ho ?! You did not specify the article id!");
}

$id = $_GET['id'];

/**
 * 3. Check that the article exist
 */
$article = $model->find($id);
if (!$article) {
    die("Item $id does not exist, so you cannot delete it!");
}

/**
 * 4. Real suppression of the article
 */
$model->delete($id);

/**
 * 5. Redirection to the home page
 */
redirect('index.php');
