<?php 

    // start session
    session_start();


    // create constants to save nun repeating values
    define("HOMEURL","http://localhost/food-order/");
    define('LOCALHOST', 'localhost');
    define('DB_username','root');
    define('DB_password','');
    define('DB_name','food-order');




    $conn = new mysqli(LOCALHOST, DB_username, DB_password, DB_name);
    if ($conn->connect_error) {
        die(mysqli_error($conn));
        
    };

 
    
    // other way to connect database

   /*  $conn = mysqli_connect(LOCALHOST, DB_usernam, DB_password, DB_name);
    $db_select = mysqli_select_db($conn, DB_name); */

?>