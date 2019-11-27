<?php

include 'includes/header.php';
include "includes/db.php";
?>

    <!-- Navigation -->
<?php include 'includes/navigation.php'?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['category'])){
                $selected_post_category = $_GET['category'];
            }

            $query = "SELECT * FROM posts WHERE post_catagory_id = $selected_post_category AND post_status = 'published'";

            $select_selected_post = mysqli_query($connection, $query);

            if(mysqli_num_rows($select_selected_post)<1){
                echo "<h1>NO post or all the posts are drafted</h1>";
            }else{
            while ($row = mysqli_fetch_assoc($select_selected_post)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date= $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,80);


                ?>


                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>



            <?php                    } }

            ?>






        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include 'includes/sidebar.php'?>

    </div>
    <!-- /.row -->

    <hr>

<?php

include 'includes/footer.php';
?>