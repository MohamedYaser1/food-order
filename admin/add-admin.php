<!DOCTYPE html>
<html>

<head>
    <title>food order - Add Admin</title>
    <link rel="stylesheet" href="../css/admin.css" />


</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<div class="main-content">
    <div class="apper">
        <h2>Add Admin</h2>

        <?php 
            if (isset($_POST['add'])){
                
                echo $_POST['add'];
                unset($_POST['add']);
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder=""></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user_name" placeholder=""></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder=""></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br />
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondry"></input>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>



<?php include('parts/footer.php') ?>



<?php 
    // check whether the submin button in clicked or not

    if (isset($_POST['submit'])) {
        # check is clicked
        #echo "button clicked";

        // get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['user_name'];
        $password = md5($_POST['password']); // password is encrypted with md5


        // SQL query to save the data into database
        $sql = "INSERT INTO admin SET
            full_name = '$full_name',
            user_name = '$username',
            password = '$password'
        
        ";


        

        //$conn = mysqli_connect("localhost","root","",);
        //$db_select = mysqli_select_db($conn, "food-order");


        $res = mysqli_query($conn, $sql) or die(mysqli_error( $conn));

        if ($res == true) {
            
            // start session variable to display massege
            $_SESSION["add"] = "Admin Add Successfully";

            // redirect oage
            header("location:".HOMEURL."admin/manage-admin.php");

        }else{

            // start session variable to display massege
            $_SESSION["add"] = "Fuiled to Add Admin";

            // redirect oage
            header("location:".HOMEURL."admin/add-admin.php");
        }

        

    }
    
?>