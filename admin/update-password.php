<!DOCTYPE html>
<html>

<head>
    <title>food order - Update Password</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>

<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->

<div class="main-content">
    <div class="apper">
        <h1>Update Password</h1>
        <br><br>


        <?php
            $id = $_GET['id'];

        
        ?>




        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Old Password</td>
                    <td><input type="password" name="current-password"></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new-password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm-password"></td>
                </tr>
                <tr>

                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" class="btn-primary" value="Update password">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php 

            // check whether the submit button is clicked or not

            if (isset($_POST['submit'])) {

                // echo 'true';
                
                // 1. get the data from form 
                $id = $_POST['id'];
                $currentpassword = md5($_POST['current-password']);
                $newpassword = md5($_POST['new-password']);
                $confirmpassword = md5($_POST['confirm-password']);


                // 2. check the the current password the user entre is correct or not
                
                $sql = "SELECT * FROM admin WHERE id = '$id' AND password = '$currentpassword'";
                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    
                    $count = mysqli_num_rows($res);
                    // check whether the data is available or not
                    if ($count == 1) {
                        
                        // get the data from databace 
                        $row = mysqli_fetch_assoc($res);

                        // echo 'user found';

                        // check the new password and it confirm is match or not
                        if ($newpassword == $confirmpassword) {
                            // update the password
                            $sql2 = "UPDATE admin SET password = '$newpassword' WHERE id = '$id'";
                            // execute the query
                            $res2 = mysqli_query($conn, $sql2);
                            
                            
                            // message confirm password changed
                            if($res2 == true){
                                $_SESSION['passwordUpdated']= "<div class='success'>Password Changed Sccessfully</div>";
                                // redirect to manage admin page with error message
                                header('location:'.HOMEURL.'admin/manage-admin.php');
                            }else {
                                $_SESSION['passwordfailedUpdated']= "<div class='error'>Failed To Change Password</div>";
                                // redirect to manage admin page with error message
                                header('location:'.HOMEURL.'admin/manage-admin.php');
                            }
                            
                        }else {
                            // error message 
                            echo 'Password Did Not Match';
                            

                        }
                    }
                    else
                    {
                        // error message 
                        $_SESSION['WrongPassword']= "<div class='error'>Wrong current password</div>";
                        // redirect to manage admin page with error message
                        header('location:'.HOMEURL.'admin/manage-admin.php');
                    
                    

                    }

                }


            


                // 3. check the new password and it confirm is match or not

                // 4. change the old password with the new if all above is true
            }

?>



<?php include('parts/footer.php')?>