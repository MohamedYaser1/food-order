<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Login</title>
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br>
        <?php
            if (isset($_SESSION['usernotavailable'])) {
                echo $_SESSION['usernotavailable'];
                unset($_SESSION['usernotavailable']);
            }

            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <!-- start form -->
        <form action="" method="POST" class="text-center">
            <p>User Name</p>
            <input type="text" name="username">
            <p>Password</p>
            <input type="password" name="password"><br><br>
            <input type="submit" name="submit" class="btn-primary" value="Login">
        </form>
        <!-- end form -->
        <p class="text-center">Created By <a href="#">Mohamed Yaser</a></p>
    </div>
</body>

</html>


<?php
    if(isset($_POST['submit'])) 
    {

        // get the data from form
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        
        // creat sql to check is user exists or not
        $sql = "SELECT * FROM admin WHERE user_name = '$username' AND password = '$password'";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // count the rows to check if the user is exists or not if 1 it TRUE  if 0 so it FALSE
        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            $_SESSION['useravailable'] = "<div class='success'>Login successfuly</div>";

            // to check is the user is login or not in all pages the logout unset is
            $_SESSION['user'] = $username;

            header('location:'.HOMEURL.'admin');

        }else
        {
            $_SESSION['usernotavailable'] = "<div class='text-center'>Wrong Username Or Password</div>";
            header('location:'.HOMEURL.'admin/login.php');

        }

        
    }
?>