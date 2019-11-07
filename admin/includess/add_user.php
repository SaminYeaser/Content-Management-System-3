<?php

    if(isset($_POST['create_user'])){
        $user_name = $_POST['username'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];



        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 12));

        $query = "INSERT INTO users(user_firstname, user_lastname, user_name, user_email,user_password, user_role) ";
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_name}','{$user_email}','{$user_password}','{$user_role}')";

        $create_user_query = mysqli_query($connection, $query);
        query_check($create_user_query);
        header("Location: users.php");
        header("Refresh:2");
    }

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">

        <select name="user_role" id="">
            <option value="subsciber">Select Options</option>
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>

        </select>
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" name="user_email">
    </div>

    <div class="form-group">
        <label for="password">password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

<!--    <div class="form-group">-->
<!--        <label for="post_content">post content</label>-->
<!--        <textarea name="post_content" id="" cols="30" rows="10" class="form_control"></textarea>-->
<!--    </div>-->

    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>

</form>