<!DOCTYPE html>
<html>

<head>
    <title>food order - Manage Order</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h2>Manage Order</h2><br />
        <?php
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

?>

        <br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>CustomerName</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Action</th>
            </tr>

            <?php
            
            $sql = "SELECT * FROM tbl_order";

            $res = mysqli_query($conn, $sql);
            $ornum = 1;
            
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status= $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    

                    ?>

            <tr>
                <td><?=$ornum++?></td>
                <td><?=$food?></td>
                <td><?=$price?></td>
                <td><?=$qty?></td>
                <td><?=$total?></td>
                <td><?=$order_date?></td>
                <td>
                    <?php
                        if ($status == "ordered") {
                            echo "<label>$status<label>";
                        } elseif ($status == "on delivery") {
                            echo "<label style='color : orange'>$status<label>";
                        } elseif ($status == "delivered") {
                            echo "<label style='color : green'>$status<label>";
                        } elseif ($status == "cancelled") {
                            echo "<label style='color : red'>$status<label>";
                        }
                        
                    ?>
                </td>
                <td><?=$customer_name?></td>
                <td><?=$customer_contact?></td>
                <td><?=$customer_email?></td>
                <td><?=$customer_address?></td>
                <td>
                    <a href="<?=HOMEURL?>admin/Update-order.php?id=<?=$id?>" class="btn-secondry">Update Order</a>

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