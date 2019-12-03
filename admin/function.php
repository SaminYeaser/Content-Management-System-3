<?php
include "../includes/db.php";

function users_online(){

    global $connection;

    $session = session_id();
    $time = time();
    $time_out_of_second = 10;
    $time_out = $time - $time_out_of_second;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if($count== null){
        mysqli_query($connection, "INSERT INTO users_online(session , time) VALUE ('$session','$time')");
    }else{
        mysqli_query($connection, "UPDATE users_online SET time = '$time' where session ='$session'");
    }
    $users_online =  mysqli_query($connection, "SELECT * FROM users_online WHERE time>'$time_out'");
    $count_user = mysqli_num_rows($users_online);

    echo $count_user;

}



function submitForm(){

    global $connection;

    if (isset($_POST['submit'])){

        $catas = $_POST['catTitle'];

        if($catas == '' || empty($catas)){
            echo "Its Empty!";
        }else{
            $query = "INSERT INTO catagories(cat_title) VALUE ('{$catas}')";
            $select_categories = mysqli_query($connection, $query);
            if(!$select_categories){
                die("Failed!". mysqli_error($connection));
            }
        }

    }



}

function delete_categories(){
global $connection;
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM catagories WHERE cat_id = {$the_cat_id}";
        $delete_categories = mysqli_query($connection, $query);
        header("location: categories.php");
    }

}

//function update(){
//global $connection;
////    if(isset($_POST['update'])) {
////        $the_cat_id = $_POST['cat_title'];
////        //$cat_id = $_POST['cat_id'];
////        $query = "UPDATE catagories SET cat_title = '{$the_cat_id}' WHERE cat_id = '{$cat_id}' ";
////        $edit_categories = mysqli_query($connection, $query);
////        if(!$edit_categories){
////            die("Failed". mysqli_error($connection));
//        }
//    }
//
//}

function query_check($result)
{
    global $connection;
    if (!$result) {
        die("Query Failed." . mysqli_error($connection));
    }
}

function user_exist(){

    global $connection;

    $query = "SELECT user_name FROM users";
    $select_from_user = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_array($select_from_user)){
        $user_name = $row['user_name'];
    }

    if (mysqli_num_rows($select_from_user)){
        return true;
    }else{
        return false;
    }
}
?>