<?php

    include("../config/constants.php");

    // get the id

    $id = $_GET['id'];
    echo $id;

    // create qurey to delete admin

    $sql = "DELETE FROM admin WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn,$sql);

    
    // redirect to manage admin page with massege
    if ($res == True){
        $_SESSION['delete'] = 'Admin Deleted';

        header('location:'.HOMEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['delete'] = 'Admin Failed To Delete';

        header('location:'.HOMEURL.'admin/manage-admin.php');

    }
    