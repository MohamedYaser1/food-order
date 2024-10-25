<!-- Navbar Section Starts Here -->
<?php include("./parts-front/menu.php")?>
<!-- Navbar Section Ends Here -->


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?=HOMEURL?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

?>


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        
            // Getting categories from database that is active and featured
            $sql = "SELECT * FROM category WHERE active = 'Yes' and featured = 'Yes' LIMIT 3 ";
            // execute the query
            $res = mysqli_query($conn, $sql);

            // count to check if there is data in databace
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                // while loop to get the data from databace 
                while ($row = mysqli_fetch_array($res)) {
                    $id = $row['id'];   
                    $title = $row['title'];
                    $image_name = $row['image_name'];                    
        ?>

        <a href="<?=HOMEURL?>category-foods.php?category_id=<?=$id?>">
            <div class="box-3 float-container">
                <?php
                    if ($image_name != "") {
                        ?>
                <img src="<?=HOMEURL?>images/category/<?=$image_name?>" alt="" class="img-responsive img-curve">
                <?php
                    }else{
                        echo "<div class='error'>No image</div>";
                    }
                ?>
                <h3 class="float-text text-white"><?= $title?></h3>
            </div>
        </a>

        <?php
                }
            }else{
                // if there is no data in the databace get the massege
                echo "<div class='error'>No Category Availbale</div>";                   
            }
            
        ?>
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php

            // Getting categories from database that is active and featured
            $sql2 = "SELECT * FROM food WHERE active = 'Yes' and featured = 'Yes' LIMIT 6";
            // execute the query
            $res2 = mysqli_query($conn, $sql2);

            // count to check if there is data in databace
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {

                // while loop to get the data from databace 
                while ($row = mysqli_fetch_array($res2)) {
                    $id = $row['id'];   
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $price = $row['price'];
                    $description = $row['description'];
                    

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

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->


<!-- footer Section Starts Here -->
<?php include("./parts-front/footer.php")?>
<!-- footer Section Ends Here -->