<!-- Navbar Section Starts Here -->
<?php include("./parts-front/menu.php")?>
<!-- Navbar Section Ends Here -->


<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        
        $sql = "SELECT * FROM category WHERE active = 'Yes'";
        $res = mysqli_query($conn, $sql);

        
        $count = mysqli_num_rows($res);

        if ($count > 0) {

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
                <img src="images/category/<?=$image_name?>" alt="Pizza" class="img-responsive img-curve">

                <?php
                } else {
                    echo "<div>No Image Added</div>";
                }
                
                
                ?>

                <h3 class="float-text text-white"><?=$title?></h3>
            </div>
        </a>
        <?php
            }
            
        }else{
            echo "<div>No Category Added</div>";
        }
        
        
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->




<!-- footer Section Starts Here -->
<?php include("./parts-front/footer.php")?>
<!-- footer Section Ends Here -->