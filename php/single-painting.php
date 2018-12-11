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
    <script src="/jS/single-painting.js"></script>

</head>

<body>

    <main class="container">
        
        <div class="box tabeOfContents">
                <?php tableOfContents() ?>
        </div>
        
        <div class= "box largePaintingImg">
            <?php 
                outputPaintingImg();
            ?>
        </div>
        
        <div class= "box paintingInfo">
            <?php
                outputPaintingInfo();
            ?>
        </div>
        <div class= "box paintingcolorScheme">
            
        </div>
        <div class= "box paintingReview">
            <?php
                paintingRatingBar();
            ?>
        </div>
        
    </main>
</body>
    <script src="../jS/single-painting.js"></script>
    <script src="../jS/single-genre.js"></script>
</html>
    