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
 * 1. Connection to the database with PDO
 */
$pdo = getPdo();

/**
 * 2. Find all articles order by creation date
 */
$results = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
$articles = $results->fetchAll();

/**
 * 3. Display
 */
$pageTitle = "Home";

render('articles/index', compact('pageTitle', 'articles'));
