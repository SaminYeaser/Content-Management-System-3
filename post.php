<?php

include 'includes/header.php';
include "includes/db.php";
ob_start();
session_start();
if(!isset($_SESSION['user_role'])){
    header('Location: home.php');

}
?>

    <!-- Navigation -->
<?php include 'includes/navigation.php'?>

<?php

    if (isset($_POST['liked'])){

//        echo "<h1>It works</h1>";

        //likes query added
        $post_id = $_POST['post_id'];
        $user_id = $_POST['user_id'];
        $searchPostQuery = "SELECT * FROM posts WHERE post_id = $post_id";
        $postResult = mysqli_query($connection, $searchPostQuery);
        $post = mysqli_fetch_array($postResult);
        $likes = $post['likes'];

        if(mysqli_num_rows($postResult)>=1){
            echo $post['post_id'];
        }

        //update post with likes
        mysqli_query($connection, "UPDATE posts SET likes=$likes+1 WHERE post_id = $post_id");

        //create likes for the posts

        mysqli_query($connection, "INSERT INTO likes(user_id, post_id)VALUES($user_id, $post_id)");
        exit();

    }


if (isset($_POST['unliked'])){

//        echo "<h1>It works</h1>";

    //unlikes query added
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $searchPostQuery = "SELECT * FROM posts WHERE post_id = $post_id";
    $postResult = mysqli_query($connection, $searchPostQuery);
    $post = mysqli_fetch_array($postResult);
    $likes = $post['likes'];

    if(mysqli_num_rows($postResult)>=1){
        echo $post['post_id'];
    }
    //delete likes
    mysqli_query($connection, "DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");

    //update post with likes
    mysqli_query($connection, "UPDATE posts SET likes=$likes-1 WHERE post_id = $post_id");
    exit();

}
?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){
                $the_selected_post = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = '{$the_selected_post}'";
            $send_query = mysqli_query($connection, $view_query);
            if(!$send_query){
                die("Query Failed".mysqli_error($connection));
            }

            if(isset($_SESSION['user_role']) && $_SESSION['user_role']=='Admin'){
                $query = "SELECT * FROM posts WHERE post_id = $the_selected_post";
            }else{
                $query = "SELECT * FROM posts WHERE post_id = $the_selected_post AND post_status = 'published'";
            }

            $select_all_from_post = mysqli_query($connection, $query);

            if(mysqli_num_rows($select_all_from_post)<1){
                echo "<h1>No post Available</h1>";
            }else {

                while ($row = mysqli_fetch_assoc($select_all_from_post)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];


                    ?>


                    <h1 class="page-header">
                        Post
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content ?></p>
                    <hr>

<!--                    adding like button-->

                    <div class="row">
                        <p class="pull-right"><a class="<?php echo userLikedPost($the_selected_post)? 'unlike': 'like';?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span><?php echo userLikedPost($the_selected_post)? 'unlike': 'like';?></a></p>
                    </div>

<!--                    <div class="row">-->
<!--                        <p class="pull-right"><a class="unlike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span>Unlike</a></p>-->
<!--                    </div>-->

                    <div class="row">
                        <p class="pull-right">Likes: 10</p>
                    </div>

                    <div class="clearfix"></div>
                    <!-- Blog Comments -->

                    <?php

                    if (isset($_POST['submit'])) {

                        $the_selected_post = $_GET['p_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];


                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status,comment_date)";
                            $query .= "VALUES ($the_selected_post,'{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved',now())";

                            $comment_query = mysqli_query($connection, $query);

                            if (!$comment_query) {
                                die('Failed!' . mysqli_error($connection));
                            }

//                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_selected_post";
//                    $comment_of_the_post = mysqli_query($connection, $query);

                        } else {
                            echo "<script>alert('Feilds can not be empty')</script>";
                        }

                        //header('Location: post.php');
//                exit();

                    }


                    ?>

                    <?php } ?>

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form action="" method="post" role="form">
                            <div class="form-group">
                                <input type="text" placeholder="Your Name" class="form-control" name="comment_author">
                            </div>

                            <div class="form-group">
                                <input type="email" placeholder="Your mail" class="form-control" name="comment_email">
                            </div>

                            <div class="form-group">
                                <textarea name="comment_content" class="form-control" placeholder="comment"
                                          rows="3"></textarea>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->

                    <?php

                    $query = "SELECT * FROM comments WHERE comment_post_id = {$the_selected_post} ";
                    $query .= "AND comment_status = 'approve' ";
                    $query .= "ORDER BY comment_id DESC";

                    $selected_post_comment = mysqli_query($connection, $query);
                    if (!$selected_post_comment) {
                        die("Failed!" . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($selected_post_comment)) {
                        $comment_date = $row['comment_date'];
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];


                        ?>


                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>

                    <?php }
                }

            }
            else {

                header("Location: header/php");

            }


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

        <script>

            // function $(document) {
            //
            // }

            $(document).ready(function () {

                var post_id = <?php echo $the_selected_post;?>;
                    var user_id = 57;
                $('.like').click(function () {
                    $.ajax({
                       url: "post.php?p_id=<?php echo $the_selected_post;?>",
                       type : 'post',
                       data: {
                           'liked': 1,
                           'post_id': post_id,
                           'user_id': user_id
                       }
                    });
                });

                //unlike
                $('.unlike').click(function () {
                    $.ajax({
                        url: "post.php?p_id=<?php echo $the_selected_post;?>",
                        type : 'post',
                        data: {
                            'unliked': 1,
                            'post_id': post_id,
                            'user_id': user_id
                        }
                    });
                });


            });

        </script>
