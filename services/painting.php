<?php
//i think it needs to go to the proper directory tree
//include '../php/functions.inc.php';
include '../php/db-functions.php';
include '../php/config.inc.php';

header('Content-Type: application/json');

$string = json_encode(getAllPaintings());

$output = json_decode($string);
echo "$output";

?>