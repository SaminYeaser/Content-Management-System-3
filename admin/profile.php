
<?php include 'includess/header.php';?>


<?php
    if(isset($_SESSION['user_name'])) {
        $username = $_SESSION['user_name'];
        $query = "SELECT * FROM users WHERE user_name='{$username}'";
        $select_user_for_profile = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($select_user_for_profile)){
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_password = $row['user_password'];
        }
    }
?>
<?php

if(isset($_POST['update_profile'])) {

$user_name = $_POST['user_name'];
$user_firstname = $_POST['user_firstname'];
$user_lastname = $_POST['user_lastname'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$user_role = $_POST['user_role'];




$query = "UPDATE users SET ";
$query .= "user_name ='{$user_name}', ";
$query .= "user_firstname ='{$user_firstname}', ";
$query .= "user_lastname = '{$user_lastname}', ";
$query .= "user_email ='{$user_email}', ";
$query .= "user_password ='{$user_password}', ";
$query .= "user_role ='{$user_role}' ";
$query .=  "WHERE user_id = $user_id";

$update = mysqli_query($connection, $query);

query_check($update);
//header("Location: users.php");

}
?>










    <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includess/navigation.php';?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">

                    <h1 class="page-header">
                        Welcome to your profile
                        <small><?php echo $_SESSION['user_name']?></small>
                    </h1>




                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="title">User Name</label>
                            <input value="<?php echo $user_name;?>" type="text" class="form-control" name="user_name">
                        </div>


                        <div class="form-class">
                            <label for="user_role">User Role</label>
                            <select name="user_role" id="">

                                <?php

                                if($user_role == 'Admin'){
                                    $user_value = 'Admin';
                                }else{
                                    $user_value = 'Subscriber';
                                }

                                ?>


                                <option value="<?php echo $user_value?>"><?php echo $user_role?></option>

                                <?php
                                if($user_role == 'Admin'){
                                    echo "<option value=\"Admin\">Admin</option>";
                                }else{
                                    echo "<option value=\"Subscriber\">Subscriber</option>";
                                }


                                ?>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">User Firstname</label>
                            <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">User Lastname</label>
                            <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
                        </div>



                        <div class="form-group">
                            <label for="password">User Password</label>
                            <input type="password" name="user_password" value="<?php echo $user_password?>">
                        </div>



                        <div class="form-group">
                            <label for="post_tags">User email</label>
                            <input value="<?php echo $user_email;?>" type="email" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">

                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>

                    </form>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    </div>
    <!-- /#page-wrapper -->

<?php include 'includess/footer.php';?>