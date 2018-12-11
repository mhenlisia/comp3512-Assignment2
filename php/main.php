<?php 

require_once 'config.inc.php';
include 'functions.inc.php';
require_once 'db-functions.php';

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
        
        <div class="box galleries">
            <img src="/images/lg.circle-slack-loading-icon.gif" id="loading-gif">
            <ul id="galleryList">
                
            </ul> 
        </div>
        
        <div class = "box artists">
            
                
                <?php outputArtists();
                    //testGallery();
                ?>
            
        </div>
        
        <div class = "box genres">
            <?php outputGenres(); ?>
        </div>
        
    </main>

<script src="../jS/main-page.js"></script>
</body>
    
</html>
    