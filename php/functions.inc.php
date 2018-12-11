<?php 
//include '../php/config.inc.php';
//include '../php/db-functions.php';
    
    function tableOfContents(){
        echo '<div class="menuOptions" id-="menuOptions">
                <a href="main.php" class="active">Home</a>
                <a href="aboutUs.php">About Us</a>
                <a href="favourites.php">Favourites</a>
                <a href="login.php">Login</a>
                </div>';
    }
    
    
    function getGallerySQL() {
        $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
        $sql .= " ORDER BY GalleryName";
        return $sql;
    }
    
function getAllGalleries() {
  try{
    $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
    
    if(isset($_GET['GalleryID'])){
        $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries WHERE GalleryID= ' . $_GET['GalleryID'];
        $result = runQuery($connection, $sql, null);
        return $result;
    }else{
        $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries ORDER BY GalleryName';
        $result = runQuery($connection, $sql, null);
        return $result;
    }

  }
  catch (PDOException $e) {
      die( $e->getMessage() );
   }
}

function outputGalleries(){
    $galleries = getAllGalleries();
    foreach ($galleries as $g){
        ouputSingleGallery($g);
    }
}

function ouputSingleGallery($gallery){
   echo "<div class='card'><a href='single-gallery.php?GalleryID=" . $gallery['GalleryID'] . "'>" . $gallery['GalleryName'] . "</a></div>";
    
}

function getAllArtists(){
    try{
        $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        $sql = 'select ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details from Artists';
        $result = runQuery($connection, $sql, null);
     return $result;
  }
  catch (PDOException $e) {
      die( $e->getMessage() );
    }
}



function outputArtists(){
    $artists = getAllArtists();
    foreach($artists as $a){
        echo "<div class='card'><a href='single-artist.php?ArtistID=" . $a['ArtistID'] . "'>" . $a['FirstName'] . " " . $a['LastName'] . "</a></div>";
    }
}

function getAllGenres(){
    try{
        $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
         if(isset($_GET['GenreID'])){
        $sql = "select GenreID, GenreName, EraID, Description, Link from Genres where GenreID= " . $_GET['GenreID'];
        $result = runQuery($connection, $sql, null);
        return $result;
        }
    
    else{
        $sql = "select GenreID, GenreName, EraID, Description, Link from Genres";
        $result = runQuery($connection, $sql, null);
        return $result;
    }
  }
  catch (PDOException $e) {
      die( $e->getMessage() );
    }
}

function outputGenres(){
    $genres = getAllGenres();
    foreach($genres as $g){
        //echo "<figure><img src= '/images/genres/genres/square-medium/" . $g['GenreID'] . ".jpg'><figcaption>
        //<a href='/php/single-genre.php?GenreID=" . $g['GenreID'] . "'>" . $g['GenreName'] . "</a></figcaption></figure>";
        
        echo "<a href='/php/single-genre.php?GenreID=" . $g['GenreID'] . "'> 
                    <figure>
                        <img src= '/images/genres/genres/square-medium/" . $g['GenreID'] . ".jpg'><br> " . $g['GenreName'] . 
                    "</br></figure>
            </a>";
        
        
    }
}

// This function connects to the database and  
function getArtists(){
    $sql = "select ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details from Artists";
    if(isset($_GET['ArtistID'])){
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $sql = $sql . " where ArtistID=" . $_GET['ArtistID'];
            $result = runQuery($connection, $sql, null);
            return $result;
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
    else {
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $result = runQuery($connection, $sql, null);
            return $result;
        }
        catch (PDOException $e) {
            die( $e->getMessage() );
        }
    }
}


function ouputSingleArtist(){
    echo "<h1>" . $r['FirstName'] . " " . $r['LastName'] . "</h1>";
}

function getPaintingsByArtist(){
    $sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE ArtistID= "  . $_GET['ArtistID'];
    getPaintings($sql);
}

function getAllPaintings(){
    $sql = "SELECT*FROM Paintings";
    return getPaintings($sql);
    
}

function getPaintings($sql){
    if(isset($_GET['ArtistID'])){
    try{
     $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
     //$sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE ArtistID= " . $_GET['ArtistID'];

     $result = runQuery($connection, $sql, null);
     return $result;
  }
  catch (PDOException $e) {
      die( $e->getMessage() );
   }
    }
}

function outputPaintingTable(){
    $paintings = getPaintingsByArtist();
    foreach($paintings as $p){
        echo "<tr>";
        echo "<td> <img src='/images/works/square-medium/" . $p['ImageFileName'] . ".jpg'></td>";
        echo "<td>" . $p['Title'] . "</td>";
        echo "<td>" . $p['FirstName'] . " " . $p['LastName'] . "</td>";
        echo "<td>" . $p['YearOfWork'] . "</td>";
        echo "</tr>";
    }
}

// function testGallery(){
//     include '../php/functions.inc.php';
//     header('Content-Type: application/json');
//     $string = json_encode(getAllGalleries());
//     echo $string;
// }

?>