<?php
    function logoutSession(){
        session_start();
        session_destroy();
        
        header('Location:' . APP_ROOT . '/php/main.php');
    }
    
?>