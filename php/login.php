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
    echo "<button type='submit' class='loginButton'>Login</button>
        <label>
            <input type='checkbox' checked='checked' name='rememeber'/>Remember Me
        </label>";
    
    //use hide and show via jS
    echo "<div class='loginInfo'>
        <button type='button' class='cancelbtn'>Cancel</button>
        <span class='register'>Dont have an account:<a href='register.php'>Register Here</a></span>
    </div>";
    
    echo "</form>";
}


function emailPassBox(){
    echo "<div class='loginInfo'>
        
        <label for='eMail'</label>
        <input type='mail' placeholder='Enter your email here' name='eMail' required>
        <label for='passWord'></label>
        <input type='password' placeholder='Enter your password here' name='passWord' required>
        
    </div>";
    
}

function registerLink(){
    
}

    
}
    


?>


        
        




