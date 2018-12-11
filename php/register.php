<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Assignment#2</title>

    <link rel="stylesheet" href="../css/main.css">
    <script src="../jS/main.js"></script>

</head>
<html>
    <?php
        //login();
        register();
    ?>
</html>
<?php
function register(){
    echo "<form action='main.php' class='registerForm'>";
    echo "<div class='loginInfo'>";
        
    //Prints first name, last name, city, and country    
    echo"
        <label for='firstName'></label>
        <input type='text' placeholder='Enter your first name' name='firstName' required>
        
        <label for='lastName'></label>
        <input type='text' placeholder='Enter your last name' name='lastName' required>

        <label for='cityLabel'></label>
        <input type='text' placeholder='Enter the city you reside in' name='cityLabel' required>
        
        <label for='countryLabel'></label>
        <input type='text' placeholder='Enter the country you reside in' name='countryLabel' required>
    ";
    emailPassBox();
    echo"
        <label for='passWord'></label>
        <input type='password' placeholder='Enter Password Again' name='passWord' required>  
    ";
    echo "<button type='submit' class='registerButton'>Register</button>
    </div>";
}

function emailPassBox(){
    echo "<div class='loginInfo'>
        
        <label for='eMail'</label>
        <input type='mail' placeholder='Enter your email here' name='eMail' required>
        <label for='passWord'></label>
        <input type='password' placeholder='Enter your password here' name='passWord' required>
        
    </div>";
    
}
?>