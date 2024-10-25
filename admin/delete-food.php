<?php
    include('../config/constants.php');


    if (isset($_GET['id']) and isset($_GET['image_name'])) {
    
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if ($image_name != "") {
            $path = "../images/food/".$image_name;

            $remove = unlink($path);

            if ($remove != true) {
                $_SESSION['remove'] = "<div class='error'>Failed To Delete Image</div>";
                header("location:".HOMEURL."admin/manage-food.php");
                die();
            }
        }
        
        $sql = "DELETE FROM food WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $_SESSION['deletefood'] = "<div class='error'>Food Deleted Successfully</div>";
                header("location:".HOMEURL."admin/manage-food.php");
        }else
        {
            $_SESSION['deletefood'] = "<div class='error'>Failed To Delete Food</div>";
                header("location:".HOMEURL."admin/manage-food.php");
        }



        
    } else {
        header("location:".HOMEURL."admin/manage-food.php");
    }
    

    


?>