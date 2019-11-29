<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php ">CMS</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php

                    $query = 'SELECT * FROM catagories';
                    $select_all_from_catagories =mysqli_query($connection, $query) ;
                    while ($row = mysqli_fetch_assoc($select_all_from_catagories)){

                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        $category_class = '';
                        $regiestration_class = '';
                        $regiestration = 'registration.php';
                        $contact_us_class = '';
                        $contact_us = 'contact_us.php';
                        $pagename = basename($_SERVER['PHP_SELF']);

                        if(isset($_GET['category']) && $_GET['category']==$cat_id){
                            $category_class = 'active';
                        }else if ($pagename == $regiestration){
                            $regiestration_class = 'active';
                        }else if ($pagename == $contact_us){
                            $contact_us_class = 'active';
                        }
//Activation of the link pages
                        echo "<li class='$category_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    //now all the links can be shown active>>>>
                    }
                ?>

                <li>
                    <a href="admin">Admin</a>
                </li>

                <?php

                if(isset($_SESSION['user_name'])){

                }

                ?>

<!--                <li class="--><?php //echo $regiestration_class?><!--">-->
<!--                    <a href="http://localhost/cms3/registration.php">Registration</a>-->
<!--                </li>-->
<!--All are fixed hahahhaha-->
                <li class="<?php echo $contact_us_class;?>">
                    <a href="http://localhost/cms3/contact_us.php">Contact Us</a>
                </li>
                <?php

                if (isset($_GET['p_id'])) {
                    $the_edit_post_Id = $_GET['p_id'];

                    echo "<li> <a href='admin/posts.php?source=edit_post&p_id={$the_edit_post_Id}'>Edit Post</a></li>";
}
                ?>
<!--               -->

<!--                <li>-->
<!--                    <a href="#">Contact</a>-->
<!--                </li>-->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>