<?php

include 'includes/header.php';
include "includes/db.php";
ob_start();
session_start();
?>
<div class="row">
    <div class="container">
<div class="col-6">
<div class="well">
    <h4 class="text-center">You have to Login or Register first </h4>
    <h4>Login</h4>
    <form action="includes/login.php" method="post">
        <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Username">
        </div>
        <div class="input-group">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                </span>
        </div>
</div>
</div>
        <h5>Don't have Account?</h5>
        <a href="registration.php">Register</a>
    </div>

    </form>
    <!-- /.input-group -->

</div>

<?php

include 'includes/footer.php';
?>