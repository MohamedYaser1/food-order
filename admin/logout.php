<?php
    include('../config/constants.php');

    // destroy the session
    session_destroy();

    // redirect to loging page
    header('location:'.HOMEURL.'admin/login.php');

?>