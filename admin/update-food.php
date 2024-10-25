<!DOCTYPE html>
<html>

<head>
    <title>food order - Update Food</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h2>Update Food</h2><br>

        <?php
        
            if (isset($_GET['id']) and isset($_GET['image_name'])) {
                $id = $_GET['id'];
                $image_name = $_GET['image_name'];
                
                $sql = "SELECT * FROM food WHERE id = $id";
                $res = mysqli_query($conn, $sql);

                if ($res) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_array($res);
                        
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                }

            } else {
                header("location:".HOMEURL."admin/manage-category.php");
            }
            
        
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?= $title?>" required></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" id="" cols="35" rows="5"><?= $description?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" value="<?= $price?>" required></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                ?>
                        <img src="../images/food/<?=$current_image?>" width="170px" alt="">
                        <?php
                            }else{
                                echo "No Image";
                            }
                        ?>

                    </td>
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
                                $sql2 = "SELECT * FROM category WHERE active = 'Yes'";
                                $res2 = mysqli_query($conn, $sql2);

                                if ($res2) {
                                    while ($row = mysqli_fetch_assoc($res2)) {
                                        $category_id = $row['id'];
                                        $title = $row['title'];
                            ?>

                            <option value="<?php echo $category_id?>"><?php echo $title?></option>

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
                        <input <?= $featured == "Yes" ? "checked" : "" ?> type="radio" name="featured" value="Yes"
                            required> Yes
                        <input <?= $featured == "No" ? "checked" : ""?> type="radio" name="featured" value="No"
                            required> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?= $active == "Yes" ? "checked" : ""?> type="radio" name="active" value="Yes" required>
                        Yes
                        <input <?= $active == "No" ? "checked" : ""?> type="radio" name="active" value="No" required> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $id?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>


<?php

    if (isset($_POST['submit'])) {
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // check if image selected 
        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            // check if image is selected or not 
            if ($image_name != "") {

                // Rename image 
                $exe = end(explode(".", $image_name));
                $image_name = "Food Category".rand(000, 111).".".$exe;

                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if ($upload == false) {
                    $_SESSION['upload'] = "<div class='error'>filad to upload the image</div>";
                    header("location:".HOMEURL."admin/manage-food.php");
                    die();
                }

                if ($current_image != "") {
                    $remove_path = "../images/food/".$current_image;
                    $remove = unlink($current_image);
                    
                }

            } else {
                $image_name = $current_image;
            }
            
            
        } else {
            $image_name = $current_image;
        }
        

        $sql2 = "UPDATE food SET title = '$title',
                                description = '$description',
                                price = '$price',
                                image_name = '$image_name',
                                category_id = '$category',
                                featured = '$featured',
                                active = '$active'
                                WHERE id = '$id'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2){
            $_SESSION['update'] = "<div class='success'>Update Successfully</div>";
            header("location:".HOMEURL."admin/manage-food.php");

        }else {
            $_SESSION['update'] = "<div class='error'>Failed To Update food</div>";
            header("location:".HOMEURL."admin/manage-food.php");
        }

    } 
?>





<!-- Main Contact Section End -->

<?php include('parts/footer.php') ?>