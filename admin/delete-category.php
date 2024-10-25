<?php
    include ('../config/constants.php');


    // get the id from manage category
    if (isset($_GET['id']) and isset($_GET['id'])) {

        $id = $_GET['id'];
        $new_image = $_GET['image_name'];

        // delete the physical image from it's path
        if ($new_image != "") {
            
            $path = "../images/category/".$new_image;

            // remove the image
            $remove = unlink($path);

            // check is the image not removed send error message 
            if ($remove == false) {

                $_SESSION['notremoved'] = "<div class='error'>Failed To Remove The Image</div>";
                header("location:".HOMEURL."admin/manage-category.php");

                // Stop the process
                die();
            }
        }

        // create sql query 
        $sql = "DELETE FROM category WHERE id = $id";

        $res = mysqli_query($conn, $sql);

        // redirect to manage category page with massege
        if ($res == true) 
        {
            $_SESSION['deleted'] = "Category Deleted";
            header("location:".HOMEURL."admin/manage-category.php");
        }
        else
        {
            $_SESSION['deleted'] = "Failed To Delete Category";
            header("location:".HOMEURL."admin/manage-category.php");
        }
    } 
    else 
    {
        header("location:".HOMEURL."admin/manage-category.php");
    }
    
    