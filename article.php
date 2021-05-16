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
require_once('libraries/controllers/Article.php');

$controller = new \Controllers\Article();
$controller->show();
