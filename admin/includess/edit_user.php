
<?php

if(isset($_GET['p_id'])){

    $the_edit_user_Id = $_GET['p_id'];

$query = "SELECT * FROM users WHERE user_id=$the_edit_user_Id";
$select_user_by_id = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_user_by_id)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_role = $row['user_role'];
//    $post_tags = $row['post_tag'];
//    $post_comment_count = $row['post_comment_count'];
//    $post_date = $row['post_date'];
//    $post_content = $row['post_content'];
}
}
if(isset($_POST['update_user'])) {

    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];
//    $post_category_id = $_POST['post_category'];
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];

//    move_uploaded_file($post_image_temp, "../images/$post_image");

//    if (empty($post_image)) {
//        $query = "SELECT * FROM posts WHERE post_id ={$the_edit_post_Id}";
//        $image_query = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($image_query)) {
//            $post_image = $row['post_image'];
//        }
//    }


    if (!empty($user_password)) {

        $query_password = "SELECT * FROM users WHERE user_id = $the_edit_user_Id";
        $get_user = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($get_user);
        $db_user_password = $row['user_password'];

        if ($db_user_password != $user_password) {
            $hashed_pass = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }

        $query = "UPDATE users SET ";
        $query .= "user_name ='{$user_name}', ";
        $query .= "user_firstname ='{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email ='{$user_email}',";
        $query .= "user_password ='{$hashed_pass}',";
        $query .= "user_role ='{$user_role}'";
        $query .= "WHERE user_id ='{$the_edit_user_Id}'";
//        $query .= "post_tag ='{$post_tags}',";
//        $query .= "post_content ='{$post_content}',";
//        $query .= "post_image ='{$post_image}' ";
//        $query .= "WHERE post_id = {$the_edit_post_Id}";

        $update = mysqli_query($connection, $query);

        query_check($update);
        header("Location: users.php");

    }





}
?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">User Name</label>
        <input value="<?php echo $user_name;?>" type="text" class="form-control" name="user_name">
    </div>


    <div class="form-class">
        <label for="user_role">User Role</label>
        <select name="user_role" id="">
            <option value="<?php echo $user_role;?>"<?php echo $user_role;?></option>

            <?php
            if($user_role == 'Admin'){
                echo "<option value=\"Subscriber\">Subscriber</option>";
            }else{
                echo "<option value=\"Admin\">Admin</option>";
            }


            ?>

        </select>
    </div>

<!--    --><?php
//
//    $query = "SELECT * FROM users";
//    $select_user= mysqli_query($connection, $query);
//
//    while ($row = mysqli_fetch_assoc($select_user)) {
//        $user_role = $row['user_role'];
//        $user_id = $row['user_id'];
//
//        echo "<option value='{$user_id}'>{$user_role}</option>";
//    }
//    ?>



<!--    <div class="form-group">-->
<!---->
<!--        <select name="post_category" id="">-->
<!---->
<!--            --><?php
//
////            $query = "SELECT * FROM catagories";
////            $select_catagories = mysqli_query($connection, $query);
////
////            while ($row = mysqli_fetch_assoc($select_catagories)) {
////                $cat_id = $row['cat_id'];
////                $cat_title = $row['cat_title'];
////
////                echo "<option value='{$cat_id}'>{$cat_title}</option>";
////
////           }
//            ?>
<!---->
<!--        </select>-->
<!---->
<!---->
<!---->
<!--    </div>-->

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
        <input autocomplete="off" type="password" name="user_password" value="">
    </div>



    <div class="form-group">
        <label for="post_tags">User email</label>
        <input value="<?php echo $user_email;?>" type="email" class="form-control" name="user_email">
    </div>



<!--    <div class="form-group">-->
<!--        <label for="post_content">post content</label>-->
<!--        <textarea  name="post_content" id="" cols="30" rows="10" class="form_control">-->
<!--            --><?php //echo $post_content;?>
<!--        </textarea>-->
<!--    </div>-->

    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>

</form>