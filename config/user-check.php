<?php

    // check is the user logged in or not
    // if the user NOT Logged in
    if (!isset($_SESSION['user'])) {  
        
        // erorr message to login
        $_SESSION['login'] =  "<div class='text-center error'>Please Login to Enter</div>";
        // redirect to login page
        header('location:'.HOMEURL.'admin/login.php');
    }


?>