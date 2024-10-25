<!DOCTYPE html>
<html>

<head>
    <title>food order - Manage Admin</title>

    <link rel="stylesheet" href="../css/admin.css" />
</head>


<!-- Menu Section Start -->
<?php include('parts/menu.php') ?>
<!-- Menu Section End -->


<!-- Main Contact Section Start -->
<div class="main-content">
    <div class="apper">
        <h1>Manage Admin</h1>
        <br />
        <?php 
            if (isset($_SESSION['add'])) {      
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            } 
            
            if (isset($_SESSION['delete'])) {      
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            } 

            if (isset($_SESSION['update'])) {      
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            } 

            if(isset($_SESSION['WrongPassword'])){
                echo $_SESSION['WrongPassword'];
                unset($_SESSION['WrongPassword']);
            }

            if (isset($_SESSION['passwordUpdated'])) {
                echo $_SESSION['passwordUpdated'];
                unset($_SESSION['passwordUpdated']);
            }

            if (isset($_SESSION['passwordfaliedUpdated'])) {
                echo $_SESSION['passwordfaliedUpdated'];
                unset($_SESSION['passwordfaliedUpdated']);
            }

            
        ?>


        <br /><br />
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /><br />


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>

            <?php 
                // query to get all admin
                $sql = "SELECT * FROM admin";
                // Execute the query
                $res = mysqli_query($conn, $sql);

                // check whatther 
                if ($res == True) 
                {
                    // count rows to check whather we have rows in database or not

                    // count and check the rows
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {

                        // counting the list start from 1
                        $ornum = 1;

                        // get all rows and save it in here
                        while ($row = mysqli_fetch_array($res)) {

                            $id = $row["id"];
                            $full_name = $row["full_name"];
                            $username = $row["user_name"];
                            $password = $row["password"];
                        

                        // display the values in our table
                        ?>
            <tr>
                <td><?php echo $ornum++ ?></td>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username ?></td>
                <td>
                    <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $id?>"
                        class="btn-primary">Update Password</a>
                    <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id?>"
                        class="btn-secondry">Update Admin</a>
                    <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete
                        Admin</a>
                </td>
            </tr>

            <?php


            }


                    }else 
                    {
                        
                    }
                }


            ?>



        </table>
    </div>
</div>
<!-- Main Contact Section End -->

<?php include('parts/footer.php') ?>