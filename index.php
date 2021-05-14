<?php

/**
 * THIS FILE IS TO DISPLAY THE HOME PAGE !
 *
 * We will connect to the database, retrieve the articles from the most recent to the oldest
 * then loop over it to display each of them
 */

/**
 * 1. Connection to the database with PDO
 */
$pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/**
 * 2. Find all articles order by creation date
 */
$results = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
$articles = $results->fetchAll();

/**
 * 3. Display
 */
$pageTitle = "Home";
ob_start();
require('templates/articles/index.html.php');
$pageContent = ob_get_clean();

require('templates/layout.html.php');
