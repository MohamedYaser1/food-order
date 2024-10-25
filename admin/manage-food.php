<!DOCTYPE html>
<html>

<head>
    <title>food order - Manage Food</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h2>Manage Food</h2><br>

        <?php
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if (isset($_SESSION['deletefood'])) {
                echo $_SESSION['deletefood'];
                unset($_SESSION['deletefood']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

        
        ?>

        <br />
        <a href="<?php echo HOMEURL?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br /><br /><br />


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            
            $sql = "SELECT * FROM food";

            $res = mysqli_query($conn, $sql);
            $ornum = 1;
            
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    

                    ?>

            <tr>
                <td><?= $ornum++?></td>
                <td><?= $title?></td>
                <td><?= $description?></td>
                <td>$<?= $price?></td>
                <td>
                    <?php
                        if ($image_name != "") {
                            ?>
                    <img src="../images/food/<?=$image_name?>" width="100px" alt="">
                    <?php
                        } else {
                            ?>
                    <div class="error">No Image</div>
                    <?php
                        }
                        
                    ?>
                </td>
                <td><?= $featured?></td>
                <td><?= $active?></td>
                <td>
                    <a href="<?= HOMEURL?>admin/update-food.php?id=<?=$id?>&image_name=<?=$image_name?>"
                        class="btn-secondry">Update Food</a>
                    <a href="<?= HOMEURL?>admin/delete-food.php?id=<?=$id?>&image_name=<?=$image_name?>"
                        class="btn-danger">Delete Food</a>
                </td>
            </tr>

            <?php

                }
                

            }
            ?>

        </table>

    </div>
</div>
<!-- Main Contact Section End -->

<?php include('parts/footer.php') ?>