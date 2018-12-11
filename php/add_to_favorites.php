<?php 
include '../php/functions.inc.php';
include '../php/page-functions.inc.php';

if(isset($_GET['PaintingID'])){
    $id = $_GET['PaintingID'];
    if (isset($_SESSION['favorits'])){
        $favorites = $_SESSION['favorits'];
    } else {
        $favorites = [];
    }
    
    $favorites[] = $id;
    $_SESSION['favorits'] = $favorites;
}
header("Location: {$_SERVER['HTTP_REFERER']}");
?>