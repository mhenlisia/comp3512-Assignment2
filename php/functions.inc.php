<?php 

    function tableOfContents(){
        echo '<ul class = "menuOptions">
                    <li><h2>Assignment#2</h2></li>
                    <li><a href="main.php">Home</a> </li>
                    <li><a href="aboutUs.php">About Us</a></li>
                    <li><a href="#">Favourites</a></li>
                    <li><a href="#">Login</a></li>
              </ul>';
    }
    
    //blah
    
    function getGallerySQL() {
        $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries';
        $sql .= " ORDER BY GalleryName";
        return $sql;
    }
    
function getAllGalleries() {
  try{
     $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
     $sql = 'SELECT GalleryID, GalleryName, GalleryNativeName, GalleryCity, GalleryCountry, Latitude, Longitude, GalleryWebSite FROM Galleries ORDER BY GalleryName';
     //getGallerySQL();
     
     $result = runQuery($connection, $sql, null);
     return $result;
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
   echo "<li><a href='single-gallery.php?GalleryID=" . $gallery['GalleryID'] . "'>" . $gallery['GalleryName'] . "</a></li>";
    
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
        echo "<div class='box " . $a['ArtistID'] . "'><a href='single-artist.php?ArtistID=" . $a['ArtistID'] . "'>" . $a['FirstName'] . " " . $a['LastName'] . "</a></div>";
    }
}

function getAllGenres(){
    try{
        $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
        $sql = 'select GenreID, GenreName, EraID, Description from Genres';
        $result = runQuery($connection, $sql, null);
     return $result;
  }
  catch (PDOException $e) {
      die( $e->getMessage() );
    }
}

function outputGenres(){
    $genres = getAllGenres();
    foreach($genres as $g){
        echo "<div class='box " . $g['GenreID'] . "'><a href='/php/single-genre.php?GenreID=" . $g['GenreID'] . "'>" . $g['GenreName'] . "<img src= '/images/genres/genres/square-medium/" . 
        $g['GenreID'] . ".jpg'></a></div>";
    }
}

function getArtistById(){
    if(isset($_GET['ArtistID'])){
        try{
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            $sql = "select ArtistID, FirstName, LastName, Nationality, Gender, YearOfBirth, YearOfDeath, Details from Artists where ArtistID=" . $_GET['ArtistID'];

            $result = runQuery($connection, $sql, null);
            foreach($result as $r){
                ouputSingleArtist();
            }
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
    if(isset($_GET['ArtistID'])){
    try{
     $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
     $sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName, GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE ArtistID= " . $_GET['ArtistID'];

     $result = runQuery($connection, $sql, null);
     return $result;
  }
  catch (PDOException $e) {
      die( $e->getMessage() );
   }
    }
}
function ouputPaintingTable(){
    $paintings = getPaintingsByArtist();
    foreach($paintings as $p){
        echo "<tr>";
        echo "<td><img src='/images/works/square-medium/" . $p['ImageFileName'] . ".jpg'></td>";
        echo "<td>" . $p['Title'] . "</td>";
        echo "<td>" . $p['FirstName'] . " " . $p['LastName'] . "</td>";
        echo "<td>" . $p['YearOfWork'] . "</td>";
        echo "</tr>";
    }
}

?>