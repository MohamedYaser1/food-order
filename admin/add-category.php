<!DOCTYPE html>
<html>

<head>
    <title>food order - Add Category</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>

<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<div class="main-content">
    <div class="apper">
        <h1>Add Category</h1><br><br>

        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <!-- Add category form -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" required>
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required> Yes
                        <input type="radio" name="featured" value="No" required> No
                    </td>
                </tr>
                <tr>

                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required> Yes
                        <input type="radio" name="active" value="No" required> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Category" class="btn-secondry">
                    </td>
                </tr>

            </table>
        </form>
        <!-- end category form -->

    </div>
</div>

<?php
    if (isset($_POST['submit'])) 
    {
        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];


        /* if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }
        if (isset($_POST['active'])) 
        {
            $active = $_POST['active'];
        }else{
            $active = "No";
        } */

        // print_r($_FILES['image']);
        // die();

        // check if the image is selected or not then set the image name and uploding it

        if (isset($_FILES['image']['name'])) {
            
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
                    header("location:".HOMEURL."admin/add-category.php");
                    die();
                }
            }
        }
        else
        {
            $new_image = "";
        }

        $sql = "INSERT INTO category SET
                title = '$title',
                image_name = '$new_image',
                featured = '$featured',
                active = '$active'";
        
        $res = mysqli_query($conn ,$sql);

        if ($res == true) {
            $_SESSION['add'] = "<div class='success'>Category Add Successfully</div>";
            header("location:".HOMEURL."admin/manage-category.php");
        }else
        {
            $_SESSION['add'] = "<div class='error   '>Failed To Add Category</div>";
            header("location:".HOMEURL."admin/manage-category.php");
        }
    }
?>



<?php include('../admin/parts/footer.php');?>