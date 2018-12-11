<?php
//i think it needs to go to the proper directory tree
include '../php/db-functions.php';
include '../php/functions.inc.php';
include '../php/config.inc.php';

header('Content-Type: application/json');

$string = getAllGalleries();
foreach($string as $r) {
    $string = json_encode($r);
    echo $string;
}

?>