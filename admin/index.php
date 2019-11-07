<?php include 'includess/header.php';?>

    <div id="wrapper">


    <?php

   users_online();
?>



        <!-- Navigation -->
        <?php include 'includess/navigation.php'?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
<!--                            <h1>-->
<!---->
<!--                                --><?php
//
//                               // echo "$count_user";
//
//                                ?>
<!---->
<!--                            </h1>-->
                            <small><?php echo $_SESSION['user_name'];?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->




                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <?php

                                            $query = "SELECT * FROM posts";
                                            $all_Selected_post = mysqli_query($connection, $query);
                                            $post_counts = mysqli_num_rows($all_Selected_post);

                                            echo "<div class='huge'>{$post_counts}</div>";
                                        ?>




                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">



                                        <?php

                                        $query = "SELECT * FROM comments";
                                        $all_Selected_comment = mysqli_query($connection, $query);
                                        $comment_counts = mysqli_num_rows($all_Selected_comment);

                                        echo "<div class='huge'>{$comment_counts}</div>";
                                        ?>

                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">


                                        <?php

                                        $query = "SELECT * FROM users";
                                        $all_Selected_user = mysqli_query($connection, $query);
                                        $user_counts = mysqli_num_rows($all_Selected_user);

                                        echo "<div class='huge'>{$user_counts}</div>";
                                        ?>



                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">


                                        <?php

                                        $query = "SELECT * FROM catagories";
                                        $all_Selected_categories = mysqli_query($connection, $query);
                                        $categories_counts = mysqli_num_rows($all_Selected_categories);

                                        echo "<div class='huge'>{$categories_counts}</div>";
                                        ?>

                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


                <?php

                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_post = mysqli_query($connection, $query);
                    $post_draft_counts = mysqli_num_rows($select_all_draft_post);

                ?>
                <?php

                    $query = "SELECT * FROM comments WHERE comment_status ='approve'";
                    $select_all_approve_comments = mysqli_query($connection, $query);
                    $comment_approve_count = mysqli_num_rows($select_all_approve_comments);

                ?>
                <?php

                $query = "SELECT * FROM comments WHERE comment_status ='unapproved'";
                $select_all_unapprove_comments = mysqli_query($connection, $query);
                $comment_unapprove_count = mysqli_num_rows($select_all_unapprove_comments);

                ?>



<div class="row">



    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Data', 'Count'],

                <?php

                $element_text = ['Active Posts','Categories', 'Users', 'Comments','Draft Post','Approve Comment','Unapprove Comment'];
                $element_count = [$post_counts,$categories_counts, $user_counts, $comment_counts, $post_draft_counts, $comment_approve_count, $comment_unapprove_count];

                for($i = 0 ;$i<7; $i++ ){

                    echo "['{$element_text[$i]}'"."," . "{$element_count[$i]}],";

                }


                ?>

       //         ['Post', 1000,],

            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: '',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>


</div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

        <?php include 'includess/footer.php'?>