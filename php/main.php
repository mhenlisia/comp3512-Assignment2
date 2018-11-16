<?php 
require_once 'config.inc.php';
include 'functions.inc.php';
require_once 'db-functions.php';


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
            <ul id="galleryList">
                <?php outputGalleries(); ?>
            </ul> 
        </div>
        
        <div class = "box artists">
            <?php outputArtists(); ?>
        </div>
        
        <div class = "box genres">
            <?php outputGenres(); ?>
        </div>
        
    </main>
    
</body>
    
</html>
    