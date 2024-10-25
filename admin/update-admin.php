<!DOCTYPE html>
<html>

<head>
    <title>food order - Update Admin</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>

<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->

<div class="main-content">
    <div class="apper">
        <h2>Update Admin</h2>

        <br><br>

        <?php 
            $id = $_GET['id'];

            $sql="SELECT * FROM admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            // getting the date from databace
            if($res == true){

                $count = mysqli_num_rows($res);
                
                // check whether the data is available or not
                if($count == 1){

                    echo "admin available";

                    // get the data from databace
                    $row = mysqli_fetch_assoc($res);

                    
                    $full_name = $row['full_name'];
                    $username = $row['user_name'];
                
                }
                else
                {
                    header('location:'.HOMEURL.'admin/uptate-admin.php');
                }

            }

        ?>


        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="user_name" value="<?php echo $username;?>"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br />
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondry"></input>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php 

        // check whether the button is clicked or not
    if (isset($_POST['submit'])) {
        
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['user_name'];
    

        $sql = "UPDATE admin SET full_name='$full_name',`user_name`='$username' WHERE id='$id'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error( $conn));

        
        if($res==true) {

            $_SESSION['update'] = "Admin update successfuly";
            
            header("location:".HOMEURL."admin/manage-admin.php");

        }
        else
        {
            $_SESSION['update'] = "Failed to update admin";
            header('location:'.HOMEURL.'admin/manage-admin.php');

        }
    }

?>




<!-- Main Contact Section End -->

<?php include('parts/footer.php') ?>