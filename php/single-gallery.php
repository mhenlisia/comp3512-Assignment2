<?php 
include '../php/functions.inc.php';
include '../php/page-functions.inc.php';
//https://php3-mhenlisia.c9users.io/phpmyadmin/index.php?token=5e7510b1eddc13838e7aa26d04238d86#PMAURL-2:tbl_structure.php?db=art&table=PaintingGenres&server=1&target=&token=5e7510b1eddc13838e7aa26d04238d86

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
        
        <div class="box gallery-info">
            <section>
                <?php outputGalleryInfo() ?>
            </section>
        </div>
        
        <div class = "box map">
            <section>
              <div id="map"></div>
            </section>
        </div>
        
        <div class = "box paintings">
            <?php //outputGenres(); ?>
        </div>
        
    </main>

<script src="../js/main-page.js"></script>
</body>
    
</html>
    