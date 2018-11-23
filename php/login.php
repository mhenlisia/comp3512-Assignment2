<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>Assignment#2</title>

    <link rel="stylesheet" href="../css/main.css">
    <script src="../jS/main.js"></script>

</head>
<html>
    <?php
        login();
        //register();
    ?>
</html>

<?php
    
//credits
//https://www.w3schools.com/howto/howto_css_login_form.asp
//https://www.w3schools.com/html/tryit.asp?filename=tryhtml_form_mail

function login(){
    echo "<form class='loginForm' action='main.php'>";
        emailPassBox();
    
    //use hide and show via jS
    echo "<div class='loginInfo' style='background-color:#f1f1f1'>
        <button type='button' class='cancelbtn'>Cancel</button>
        <span class='register'>Dont have an account:<a href='../register.php'>Register Here</a></span>
    </div>";
    
    echo "</form>";
}

function register(){
    echo "<form action='main.php'>";
    echo "<div class='loginInfo'>";
        
    //Prints first name, last name, city, and country    
    echo"
        <label for='firstName'><b>First Name</b></label>
        <input type='text' placeholder='Enter your first name' name='firstName' required>
        
        <label for='lastName'><b>Last Name</b></label>
        <input type='text' placeholder='Enter your last name' name='lastName' required>

        <label for='cityLabel'><b>City</b></label>
        <input type='text' placeholder='Enter the city you reside in' name='cityLabel' required>
        
        <label for='countryLabel'><b>Country</b></label>
        <input type='text' placeholder='Enter the country you reside in' name='countryLabel' required>
    ";
    emailPassBox();
    echo"
        <label for='passWord'><b>Password</b></label>
        <input type='password' placeholder='Enter Password Again' name='passWord' required>  
    ";
    echo "<button type='submit'>Register</button>
    </div>";
}

    
function emailPassBox(){
    echo "<div class='loginInfo'>
        
        <label for='eMail'><b>Email</b></label>
        <input type='mail' placeholder='Enter your email here' name='eMail' required>
        <label for='passWord'><b>Password</b></label>
        <input type='password' placeholder='Enter your password here' name='passWord' required>
        
        <button type='submit'>Login</button>
        <label>
            <input type='checkbox' checked='checked' name='rememeber'/>Remember Me
        </label>
        
    </div>";
    
}

function registerLink(){
    
}

?>


        
        




