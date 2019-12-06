<?php

include 'includes/header.php';
include "includes/db.php";
ob_start();
session_start();

?>

<?php

    echo loggedInUserID();

    if(userLikedPost(61)){
        echo "USER LIKED IT";
    }else{
        echo "DID NOT LIKE IT";
    }
?>
