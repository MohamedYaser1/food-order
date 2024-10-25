<!DOCTYPE html>
<html>

<head>
    <title>food order - Update Food</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->

<?php

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM tbl_order WHERE id = $id";
                $res = mysqli_query($conn, $sql);

                if ($res) {
                    $count = mysqli_num_rows($res);
                    if ($count == 1) {
                        $row = mysqli_fetch_array($res);

                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $status= $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                    }
                }
    }else{
        header("location:".HOMEURL."admin/manage-order.php");
    }

?>

<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h2>Update Order</h2><br><br>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?=$food?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td>
                        <b>
                            $<?=$price?>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Qty.</td>
                    <td><input type="number" name="qty" value="<?= $qty?>" required></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?=$status == "ordered" ? "selected" : "" ;?> value="ordered">Ordered</option>
                            <option <?=$status == "on delivery" ? "selected" : "" ;?> value="on delivery">On Delivery
                            </option>
                            <option <?=$status == "delivered" ? "selected" : "" ;?> value="delivered">Delivered</option>
                            <option <?=$status == "cancelled" ? "selected" : "" ;?> value="cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td><input type="text" name="customer_name" value="<?= $customer_name?>" required></td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td><input type="text" name="customer_contact" value="<?= $customer_contact?>" required></td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td><input type="text" name="customer_email" value="<?= $customer_email?>" required></td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td><textarea name="customer_address" id="" cols="35" rows="5"><?= $customer_address?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?= $id?>">
                        <input type="hidden" name="price" value="<?= $price?>">
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
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $status= $_POST['status']; 
        $customer_name = $_POST['customer_name'];
        $customer_contact = $_POST['customer_contact'];
        $customer_email = $_POST['customer_email'];
        $customer_address = $_POST['customer_address'];
        

        $sql2 = "UPDATE tbl_order SET
                                qty = '$qty',
                                status = '$status',
                                total = '$total',
                                customer_name = '$customer_name',
                                customer_contact = '$customer_contact',
                                customer_email = '$customer_email',
                                customer_address = '$customer_address'
                                WHERE id = '$id'";

        $res2 = mysqli_query($conn, $sql2);

        if($res2){
            $_SESSION['update'] = "<div class='success'>Update Successfully</div>";
            header("location:".HOMEURL."admin/manage-order.php");

        }else {
            $_SESSION['update'] = "<div class='error'>Failed To Update Order</div>";
            header("location:".HOMEURL."admin/manage-order.php");
        }

    } 
?>







<!-- Main Contact Section End -->

<?php include('parts/footer.php') ?>