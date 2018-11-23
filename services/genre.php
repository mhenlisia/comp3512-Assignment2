<?php
//i think it needs to go to the proper directory tree
//require_once '../php/functions.inc.php';
require_once '../php/db-functions.php';
require_once '../php/config.inc.php';

header('Content-Type: application/json');

try{
    //$sql = "select GenreID, GenreName, EraID, Description, Link from Genres";
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    
    if(isset($_GET['GenreID'])){
        $sql = "select GenreID, GenreName, EraID, Description, Link from Genres where GenreID= " . $_GET['GenreID'];
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
    else{
        $sql = "select GenreID, GenreName, EraID, Description, Link from Genres";
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
}
catch (PDOException $e) {
    die( $e->getMessage() );
}

/*$result = getAllGenres();

$string = json_encode($result);

echo $string;*/

?>