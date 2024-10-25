<!-- Navbar Section Starts Here -->
<?php include("./parts-front/menu.php")?>
<!-- Navbar Section Ends Here -->

<?php

    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM category WHERE id = '$category_id'";
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];

    }

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">


        <h2>Foods on <a href="#" class="text-white">"<?=$title?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        
            $sql2 = "SELECT * FROM food WHERE category_id = '$category_id'";
            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {

                // while loop to get the data from databace 
                while ($row2 = mysqli_fetch_array($res2)) {
                    $id = $row2['id'];   
                    $title = $row2['title'];
                    $image_name = $row2['image_name'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    

                    ?>
        <div class="food-menu-box">
            <div class="food-menu-img">
                <?php
                    if ($image_name != "") {
                        ?>
                <img src="<?=HOMEURL?>images/food/<?=$image_name?>" alt="" class="img-responsive img-curve">
                <?php
                    }else{
                        echo "<div class='error'>No image</div>";
                    }
                ?>
            </div>

            <div class="food-menu-desc">
                <h4><?=$title?></h4>
                <p class="food-price">$<?=$price?></p>
                <p class="food-detail">
                    <?=$description?>
                </p>
                <br>

                <a href="<?=HOMEURL?>order.php?id=<?=$id?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>
        <?php

                }
            } else {
                // if there is no data in the databace get the massege
                echo "<div class='error'>No Food Availbale</div>"; 
            }
            
        ?>


        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->



<!-- footer Section Starts Here -->
<?php include("./parts-front/footer.php")?>
<!-- footer Section Ends Here -->