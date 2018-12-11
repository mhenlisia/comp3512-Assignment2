<?php
//i think it needs to go to the proper directory tree
//include '../php/functions.inc.php';
include '../php/db-functions.php';
include '../php/config.inc.php';

header('Content-Type: application/json');

try{
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    
    if(isset($_GET['PaintingID'])){
        $sql = "SELECT PaintingID,  ArtistID,  GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
        Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings where PaintingID= " . $_GET['PaintingID'];
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
    elseif(isset($_GET['ArtistID'])){
        $sql = "SELECT PaintingID,  ArtistID,  GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
        Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings  where Paintings.ArtistID= " . $_GET['ArtistID'];
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
    elseif(isset($_GET['GalleryID'])){
        $sql = "SELECT PaintingID,  ArtistID,  GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
        Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings where Paintings.GalleryID= " . $_GET['GalleryID'];
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
    elseif(isset($_GET['GenreID'])){
        $sql = "SELECT Paintings.PaintingID as PaintingID,  ArtistID, GenreID, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
        Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN PaintingGenres ON Paintings.PaintingID = PaintingGenres.PaintingID WHERE GenreID= " . $_GET['GenreID'];
        $result = runQuery($connection, $sql, null);
        foreach($result as $r){
            $string = json_encode($r);
            echo $string;
        }
    }
    else{
        $sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
        Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID  ";
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
?>