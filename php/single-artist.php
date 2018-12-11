<?php 
include '../php/functions.inc.php';
include '../php/page-functions.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Assignment#2</title>

    <link rel="stylesheet" href="../css/main.css">
    <script src="../jS/main.js"></script>

</head>

<body>

    <main class="container">
        
        <div class="box tabeOfContents">
                <?php tableOfContents() ?>
        </div>
        
        <div class="box artist-info">
            <section>
                <?php outputArtistInfo(); ?>
                
            </section>
        </div>
        
        <div class = "box paintings">
            <section>
                <h2>Paintings</h2>  
                <table id="artistPaintingTable">
                   <!-- <div id = "hover-image"></div>-->
                     <tr>
                         <th></th>
                         <th id = "pArtist"><a href = "">Artist</a></th>
                         <th id="pTitle"><a href = "">Title</a></th> 
                         <th id = "pYear"><a href = "">Year</a></th>
                     </tr>
                 </table> 
            </section>
        </div>
        
        
    </main>
<!-- <script src="../jS/main-page.js"></script> -->
<script src="../jS/single-artist.js"></script> 
</body>
    
</html>
    