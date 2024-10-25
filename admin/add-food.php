<!DOCTYPE html>
<html>

<head>
    <title>food order - Add Food</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>

<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->

<div class="main-content">
    <div class="apper">
        <h2>Add Food</h2><br><br>

        <?php
            if (isset($_SESSION['uploadimg'])) {
                echo $_SESSION['uploadimg'];
                unset($_SESSION['uploadimg']);
            }
        ?>

        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" id="" cols="35" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" required></td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" id="">
                            <?php
                                $sql = "SELECT * FROM category WHERE active = 'Yes'";
                                $res = mysqli_query($conn, $sql);

                                if ($res) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                            ?>

                            <option value="<?php echo $id?>"><?php echo $title?></option>

                            <?php

                                    }
                                }
                            
                            ?>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" required> Yes
                        <input type="radio" name="featured" value="No" required> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required> Yes
                        <input type="radio" name="active" value="No" required> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        

        /* print_r($_FILES['image']);
        die(); */

        
        // add image 
        if (isset($_FILES['image']['name'])) {
            
            $image_name = $_FILES['image']['name'];
            
            // upload the image if image is selected
            if ($image_name != "") {
                
                // Rename the image
                
                $exe = end(explode('.', $image_name));

                $image_name = "Food Category".rand(000,111).'.'.$exe;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;

                // upload the new image
                $upload = move_uploaded_file($source_path,$destination_path);

                // if the image not selected send an error message and if selected then upload
                if ($upload == false) {
                    $_SESSION['uploadimg'] = "<div class='error'>Failed To Uplode</div>";
                    header("location".HOMEURL."admin/add-food.php");
                    die();
                }               
            }
        } else 
        {
            $image_name = "";
        }
        
        
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        $sql2 = "INSERT INTO food SET
                title = '$title',
                `description` = '$description',
                price = '$price',
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'";

       /*  $sql2 = "INSERT INTO food (`title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) 
                VALUES ('$title','$description','$price','$image_name', '$category_id','$featured','$active'"; */

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            $_SESSION['upload'] = "<div class='success'>Added Successfully</div>";
            header("location:".HOMEURL."admin/manage-food.php");
        }else{
            $_SESSION['upload'] = "<div class='error'>Failed To Uplode</div>";
            header("location:".HOMEURL."admin/manage-food.php");
        }

        
        

    }

?>



<?php include('../admin/parts/footer.php');?>