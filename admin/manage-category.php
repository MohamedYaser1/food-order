<!DOCTYPE html>
<html>

<head>
    <title>food order - Manage Category</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h1>Manage Category</h1>

        <br />
        <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['deleted'])) {
                echo $_SESSION['deleted'];
                unset($_SESSION['deleted']);
            }

            if (isset($_SESSION['notremoved'])) {
                echo $_SESSION['notremoved'];
                unset($_SESSION['notremoved']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br>
        <a href="<?php echo HOMEURL?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

                // query to get all admin
                $sql = "SELECT * FROM category";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                if ($res == true) 
                {
                    // count rows to check whather we have rows in database or not
                    // count and check the rows
                    $count = mysqli_num_rows($res);
                    $ornum = 1;

                    if($count > 0)
                    {
                        // this while loop getting data for one item evey time form the databace 
                        while ($row = mysqli_fetch_array($res)) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $new_image = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];

            ?>
            <!-- display the values in our table -->

            <tr>
                <td><?php echo $ornum++ ?></td>
                <td><?php echo $title ?></td>
                <td><?php 
                        if ($new_image != "") {
                            ?>
                    <img src="../images/category/<?php echo $new_image;?>" width="100px" alt="" srcset="">
                    <?php

                        } else 
                        {
                            echo "Image Not Added";
                        }
                        
                    ?>
                </td>
                <td><?php echo $featured?></td>
                <td><?php echo $active?></td>
                <td>
                    <a href="<?php echo HOMEURL?>admin/update-category.php?id=<?php echo $id?>"
                        class="btn-secondry">Update Category</a>
                    <a href="<?php echo HOMEURL?>admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $new_image?>"
                        class="btn-danger">Delete
                        Category</a>
                </td>
            </tr>

            <?php
                  }
                }else {
                    echo "<div class='error'>Category Not Added Yet</div>";
                }
            }

                
                ?>

        </table>
    </div>
</div>



<?php include('parts/footer.php') ?>