<?php

/**
 * IN THIS FILE, WE ARE LOOKING TO DELETE THE COMMENT WHOSE ID IS PASSED IN GET
 *
 * We will therefore check that the "id" is present in GET, that it corresponds to an existing comment
 * Then we will delete it!
 */
require_once('libraries/autoload.php');

$controller = new \Controllers\Comment();
$controller->delete();
