<!DOCTYPE html>
<html>

<head>
    <title>food order - Update Category</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h1>Update Category</h1><br><br>

        <?php

            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM category WHERE id = $id";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        $row = mysqli_fetch_array($res);
                        
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                        
                    }else
                    {
                        header("location:".HOMEURL."admin/manage-category.php");
                    }
                }
            }else
            {
                header("location:".HOMEURL."admin/manage-category.php");
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if ($current_image != "")
                            {
                                ?>

                        <img src="../images/category/<?php echo $current_image;?>" width="170px" alt="">

                        <?php
                            }else
                            {
                                echo "<div class='error'>Not Added Yet</div>";
                            } 
                            
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?=$featured == "Yes" ? "checked" :""?> type="radio" name="featured" value="Yes">
                        Yes
                        <input <?php if($featured == "No"){echo "checked";}?> type="radio" name="featured" value="No">
                        No
                    </td>
                </tr>
                <tr>

                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?=$active == "No" ? "checked" :""?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondry">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include('../admin/parts/footer.php')?>

<?php 

    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // check if the image is selected or not then set the image name and uploding it
        if (isset($_FILES['image']['name'])) 
        {
            $new_image = $_FILES['image']['name'];
            // upload the image if image is selected
            if($new_image != "")
            {
                // auto rename the image
                $exe = end(explode('.', $new_image));

                $new_image = "Food_Category".rand(000,111).'.'.$exe;
                
                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$new_image;

                // now uplode the image
                $upload = move_uploaded_file($source_path,$destination_path);


                // if the image not selected send an error message and if selected then upload
                if ($upload == false) 
                {
                    $_SESSION['upload'] = "<div class='error'>filad to upload the image</div>";
                    header("location:".HOMEURL."admin/manage-category.php");
                    die();
                }

                if ($current_image != "") {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
                }
            }else
            {
                $new_image = $current_image;
            }
        }
        else
        {
            $new_image = $current_image;
        }
        
        $sql2 = "UPDATE category SET 
                                    title = '$title',
                                    image_name = '$new_image',
                                    featured = '$featured',
                                    active = '$active'  
                                    WHERE id = '$id'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2){
            $_SESSION['update'] = "<div class='success'>Update Successfully</div>";
            header("location:".HOMEURL."admin/manage-category.php");

        }else {
            $_SESSION['update'] = "<div class='error'>Failed To Update Category</div>";
            header("location:".HOMEURL."admin/manage-category.php");
        }
        

    } 
    

?>