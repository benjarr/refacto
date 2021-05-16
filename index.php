<?php

/**
 * THIS FILE IS TO DISPLAY THE HOME PAGE !
 *
 * We will connect to the database, retrieve the articles from the most recent to the oldest
 * then loop over it to display each of them
 */
require_once('libraries/controllers/Article.php');

$controller = new \Controllers\Article();
$controller->index();
