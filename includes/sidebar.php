<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        

        <h4>Blog Search</h4>


        <form action="search.php" method="post">
        <div class="input-group">
            <input name="search" type="text" class="form-control">
            <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
        </div>
        </form>
        <!-- /.input-group -->
    </div>


    <div class="well">
        <?php

            if(isset($_SESSION['user_name'])){ ?>

                <h4>Logged in as <?php echo $_SESSION['user_name'] ?> </h4>
                <h5><?php echo $_SESSION['user_role']?></h5>

                <a href="includes/logout.php" class="btn btn-primary">Logout</a>
            <?php }else{ ?>

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
        </form>
        <!-- /.input-group -->


            <?php } ?>

    </div>

    
    
    
    
    

    <!-- Blog Categories Well -->
    <div class="well">


        <?php

        $query = 'SELECT * FROM catagories';
        $select_from_catagories =mysqli_query($connection, $query) ;

        ?>




        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">

                    <?php

                    while ($row = mysqli_fetch_assoc($select_from_catagories)){

                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category.php?category=$cat_id'> {$cat_title}</a></li>";
                    }

                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->
<!--            <div class="col-lg-6">-->
<!--                <ul class="list-unstyled">-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                    <li><a href="#">Category Name</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>



<?php include 'includes/widget.php';?>



</div>