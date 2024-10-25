<!DOCTYPE html>
<html>

<head>
    <title>food order - Home Page</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h2>Dashboard</h2>
        <br>
        <?php 
            if (isset($_SESSION['useravailable'])) {
                echo $_SESSION['useravailable'];
                unset($_SESSION['useravailable']);
            }
        ?>
        <br>

        <?php 

            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);
        
        ?>

        <div class="col-4 text-center">
            <h1><?=$count?></h1>
            Categoriess
        </div>

        <?php 

            $sql2 = "SELECT * FROM food";
            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);
        
        ?>

        <div class="col-4 text-center">
            <h1><?=$count2?></h1>
            Foods
        </div>

        <?php 

            $sql3 = "SELECT * FROM tbl_order";
            $res3 = mysqli_query($conn, $sql3);

            $count3 = mysqli_num_rows($res3);

        ?>

        <div class="col-4 text-center">
            <h1><?=$count3?></h1>
            Total Orders
        </div>

        <?php 

            $sql4 = "SELECT sum(total) AS total FROM tbl_order WHERE status = 'delivered'";
            $res4 = mysqli_query($conn, $sql4);

            $row4 = mysqli_fetch_array($res4);

            $total_revenue = $row4['total']
        ?>

        <div class="col-4 text-center">
            <h1>$<?=$total_revenue?></h1>
            Revenue Generated
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Main Contact Section End -->


<?php include('parts/footer.php') ?>