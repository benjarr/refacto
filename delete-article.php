<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE ARTICLE WHOSE ID IS PASSED IN GET
 *
 * It will therefore be necessary to make sure that an "id" is passed in GET, then that this article exists
 * Then, we will be able to delete article and redirect to the home page
 */
require_once('libraries/controllers/Article.php');

$controller = new \Controllers\Article();
$controller->delete();
