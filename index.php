<?php

/**
 * THIS FILE IS TO DISPLAY THE HOME PAGE !
 *
 * We will connect to the database, retrieve the articles from the most recent to the oldest
 * then loop over it to display each of them
 */
require_once('libraries/database.php');
require_once('libraries/utils.php');

/**
 * 2. Find all articles order by creation date
 */
$articles = findAllArticles();

/**
 * 3. Display
 */
$pageTitle = "Home";

render('articles/index', compact('pageTitle', 'articles'));
