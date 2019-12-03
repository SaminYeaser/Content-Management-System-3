<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>



<?php

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_role = $_POST['role'];


        if(user_exist()){

            echo "This username existed";

        }


        if(!empty($username) && !empty($email) && !empty($password) && !empty($user_role)){
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection,$email);
            $password = mysqli_real_escape_string($connection,$password);
            $user_role = mysqli_real_escape_string($connection,$user_role);

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=> 10));

//            $query = "SELECT randSalt FROM users";
//            $select_randSalt_query = mysqli_query($connection, $query);
//            if(!$select_randSalt_query){
//                die('Query Failed'. mysqli_error($connection));
//            }
//            $row = mysqli_fetch_assoc($select_randSalt_query);
//                 $salt = $row['randSalt'];
//
//                 $password = crypt($password,$salt);

            $query = "INSERT INTO users (user_name, user_password,user_email,user_role) ";
            $query .="VALUES('{$username}','{$password}','{$email}','{$user_role}')";
            $regiestration = mysqli_query($connection, $query);

            if(!$regiestration){
                die('Query Failed'. mysqli_error($connection));
            }
            $message = "Completed Registration!";
        }else{
            $message = "From Can not be Empty!";
    }
    }else{
        $message = "";
    }

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <h2 class="text-center"><?php echo $message;?></h2>
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>


                        <div class="form-group">
                            <label for="user_role" class="sr-only">User Role</label>
                            <select name="role" id="">
                                <option name="role" value="Subscriber">Subscriber</option>
                            </select>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
