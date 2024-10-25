<!-- Navbar Section Starts Here -->
<?php include("./parts-front/menu.php")?>
<!-- Navbar Section Ends Here -->


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <?php
        
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT title, price, image_name FROM food WHERE id = '$id'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if ($count == 1 ) {
                    $row = mysqli_fetch_array($res);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                }


            }else{
                header("location:".HOMEURL);
            }
        ?>


        <form action="" method="post" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name != "") {
                        ?>
                    <img src="images/food/<?=$image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    }else{
                        echo "<div class='error'>No image</div>";
                    }
                ?>



                </div>

                <div class="food-menu-desc">
                    <h3><?=$title?></h3>
                    <input type="hidden" name="food" value="<?=$title?>">

                    <p class="food-price">$<?=$price?></p>
                    <input type="hidden" name="price" value="<?=$price?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>


        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php
    
    // check if order button is clicked or not
    if (isset($_POST['submit'])) {
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $qty * $price;
        $order_date = date("Y-m-d h:i:sa");
        $status= "ordered"; // ordered, on delivery, delivered, cancelled
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];

        $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'";
        
        $res2 = mysqli_query($conn, $sql2);

        if ($res2) {
            $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully</div>";
            header("location:".HOMEURL);
        }else{
            $_SESSION['order'] = "<div class='error text-center'>Failed To Order Food</div>";
            header("location:".HOMEURL);
        }
    }

?>

<!-- footer Section Starts Here -->
<?php include("./parts-front/footer.php")?>
<!-- footer Section Ends Here -->