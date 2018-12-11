<?php

include '../php/config.inc.php';
include '../php/db-functions.php';

function outputArtistInfo(){
    if(isset($_GET['ArtistID'])){
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $sql = "select ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details from Artists" . " where ArtistID=" . $_GET['ArtistID'];
            $artists = runQuery($connection, $sql, null);
            foreach($artists as $a){
                echo "<h2>" . $a['FirstName'] . " " . $a['LastName'] . "</h2>";
                echo "<label>Nationality: </label><span>" . $a['Nationality'] . "</span><br>";
                echo "<label>Gender: </label><span>" . $a['Gender'] . "</span><br>";
                echo "<label>Year of Birth: </label><span>" . $a['YearOfBirth'] . "</span><br>";
                echo "<label>Year of Death: </label><span>" . $a['YearOfDeath'] . "</span><br>";
                echo "<label>Details: </label><span>" . $a['Details'] . "</span><br>";
        
            }
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
    
}

function outputGenreInfo(){
    if(isset($_GET['GenreID'])){
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $sql = "select GenreID, GenreName, EraID, Description, Link from Genres" . " where GenreID=" . $_GET['GenreID'];
            $genres = runQuery($connection, $sql, null);
            foreach ($genres as $g){
                echo "<h2>" . $g['GenreName'] . "</h2>";
                echo "<img src='/images/genres/genres/square-medium/" . $g['GenreID'] . ".jpg'><br>";
                echo "<label>Description: </label><span>" . $g['Description'] . "</span>";
            }
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
}

function outputGalleryInfo(){
    if(isset($_GET['GalleryID'])){
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries WHERE GalleryID= ' . $_GET['GalleryID'];
            $galleries = runQuery($connection, $sql, null);
            foreach($galleries as $g){
                echo "<h2>" . $g['GalleryName'] . "</h2>";
                echo "<label>Native Name: </label><span>" . $g['GalleryNativeName'] . "</span><br>";
                echo "<label>City: </label><span>" . $g['GalleryCity'] . "</span><br>";
                echo "<label>Country: </label><span>" . $g['GalleryCountry'] . "</span><br>";
                echo "<label>Home: </label><span><a href='" . $g['GalleryWebSite'] . "'>" . $g['GalleryWebSite'] . "</a></span>";
            }
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
}

?>