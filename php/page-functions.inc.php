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

function retrievePaintings(){
    try {
        if(isset($_GET['PaintingID'])){
            $connection = setConnectionInfo(DBCONNSTRING,DBUSER,DBPASS);
            
            //$sql = "SELECT PaintingID, Paintings.ArtistID AS ArtistID, FirstName, LastName,
            //GalleryID, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, 
            //CopyrightText, Description, Excerpt, YearOfWork, Width, Height, Medium, 
            //Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings INNER JOIN Artists ON Paintings.ArtistID = Artists.ArtistID WHERE ArtistID= "
            //. $_GET['PaintingID'];
            
            $sql = "SELECT Artists.FirstName, Artists.LastName, PaintingID,  Paintings.ArtistID, Paintings.GalleryID, Galleries.GalleryName, ImageFileName, Title, ShapeID, MuseumLink, AccessionNumber, CopyrightText, Description, Excerpt, YearOfWork, 
                    Width, Height, Medium, Cost, MSRP, GoogleLink, GoogleDescription, WikiLink FROM Paintings, Artists, Galleries where PaintingID= " . $_GET['PaintingID'] . " AND Artists.ArtistID = Paintings.ArtistID AND Paintings.GalleryID = Galleries.GalleryID";
            
            $result = runQuery($connection, $sql, null);
        
            //$data = $result->fetchAll();
            //echo json_encode($data);
            return $result;
        }
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
}

function outputPaintingImg(){
    $result = retrievePaintings();
    foreach($result as $r){
        //$string = json_encode($r);
        echo "<img style='height: 100%; width: 100%; object-fit: contain' src='/images/works/square-medium/" . $r['ImageFileName'] . ".jpg'>";
    }
}
function outputPaintingInfo(){
    $result = retrievePaintings();
    foreach($result as $r){
        echo "<section id='paintingInfoTitle'>";
        echo "<h1>" . $r['Title'] . "</h1>";
        //echo "<h3> Artist: " . $r['FirstName'] . " " . $r['LastName'] . "</h3>";
        
        echo "<table id=paintingInfoTable>";
        
        echo    "<a href='/php/single-artist.php?ArtistID=" . $r['ArtistID'] . "'><tr>
                    <td id='paintingInfoHead'>Artist: </td>";
        if ($r['ArtistID'] != null) {
            echo    "<td>" . $r['FirstName'] . " " . $r['LastName'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr></a>";
        
        echo    "<a href='/php/single-gallery.php?GalleryID=" . $r['GalleryID'] . "'><tr>
                    <td id='paintingInfoHead'>Gallery: </td>";
        if ($r['GalleryID'] != null) {
            //REPLACE THIS WITH GALARY NAME
            echo    "<td>". $r['GalleryID'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr></a>";
        
        echo    "<a href='/php/single-gallery.php?GenreID=" . $r['GenreID'] . "'>
                <tr>
                    <td id='paintingInfoHead'>Genre: </td>";
        if ($r['GenreID'] != null) {
            echo    "<td>" . $r['FirstName'] . " " . $r['LastName'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr>
                </a>";
        
        echo    "<tr>
                    <td id='paintingInfoHead'>Cost: </td>";
        if ($r['Cost'] != null) {
            echo    "<td>$". $r['Cost'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr>";
        
        echo    "<tr>
                    <td id='paintingInfoHead'>Year of work: </td>";
        if ($r['YearOfWork'] != null) {
            echo    "<td>". $r['YearOfWork'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr>";
        
        echo    "<tr>
                    <td id='paintingInfoHead'>Medium: </td>";
        if ($r['Medium'] != null) {
            echo    "<td>". $r['Medium'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }            
        echo    "</tr>";
        
        echo    "<tr>
                    <td style='vertical-align:top', id='paintingInfoHead' > Description: </td>";
        if ($r['Description'] != null) {
            echo    "<td>" . $r['Description'] . "</td>";
        } else {
            echo    "<td>Currently Unavailable </td>";
        }
        echo    "</tr>
             </table>";
    }
}

function paintingRatingBar(){
    //https://stackoverflow.com/questions/46741025/simple-rating-star-css
    echo "<section><p>Rate: </p>";
    echo '<fieldset class="rating">
                <input type="radio" id="5star" name="rating" value="5" />
                <label class="full" for="5star" title="Excellent"></label>
                
                <input type="radio" id="4halfstar" name="rating" value="4.5" />
                <label class="half" for="4halfstar" title="Good"></label>
                
                <input type="radio" id="4star" name="rating" value="4" />
                <label class="full" for="4star" title="Pretty good"></label>
                
                <input type="radio" id="3halfstar" name="rating" value="3.5" />
                <label class="half" for="3halfstar" title="Nice"></label>
                
                <input type="radio" id="3star" name="rating" value="3" />
                <label class="full" for="3star" title="Ok"></label>

                <input type="radio" id="2halfstar" name="rating" value="2.5" />
                <label class="half" for="2halfstar" title="Kinda bad"></label>

                <input type="radio" id="2star" name="rating" value="2" />
                <label class="full" for="2star" title="Bad"></label>

                <input type="radio" id="1halfstar" name="rating" value="1.5" />
                <label class="half" for="1halfstar" title="Meh"></label>

                <input type="radio" id="1star" name="rating" value="1" />
                <label class="full" for="1star" title="Umm"></label>

                <input type="radio" id="halfstar" name="rating" value="0.5" />
                <label class="half" for="halfstar" title="Worst"></label>
            </fieldset>';
    echo "</section>";
}

function printFavoritesInfo(){
    
    
    echo "<a href='/php/add_to_favorites.php?PaintingID=" . $_GET['PaintingID'] . "'><p id='addToFavBtn'> Add To Favorites </p></a>";
    echo "<p id='numbOfFav'> You have " . count($_SESSION['favorite']) . " favorite paintings</p>";
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