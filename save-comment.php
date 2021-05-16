<?php

/**
 * THIS FILE MUST RECORD A NEW COMMENT IS DIRECT ON THE ARTICLE!
 * 
 * We must first check that all the information has been entered in the form
 * If not: an error message
 * Otherwise, we'll save the information
 * 
 * To save the information, it would be good to be sure that the article we are trying to comment on exists.
 * It will therefore be necessary to make a first request to ensure that the article exists.
 * Then we can integrate the comment
 * 
 * And finally we can redirect the user to the article in question
 */
require_once('libraries/autoload.php');

$controller = new \Controllers\Comment();
$controller->insert();
