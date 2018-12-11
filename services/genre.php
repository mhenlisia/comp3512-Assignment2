<?php
//i think it needs to go to the proper directory tree
require_once '../php/functions.inc.php';
require_once '../php/db-functions.php';
require_once '../php/config.inc.php';

header('Content-Type: application/json');

$string = getAllGenres();

$data = $string->fetchAll();
echo json_encode($data);
//foreach($string as $r) {
//    $string = json_encode($r);
//    echo $string;
//}

?>