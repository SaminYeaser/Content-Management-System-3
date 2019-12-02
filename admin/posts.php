<?php ob_start();?>
<?php include 'includess/header.php';?>

    <div id="wrapper">

    <!-- Navigation -->
    <?php include 'includess/navigation.php';?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12 col-xs-12">

                    <h1 class="page-header">
                        Welcome to post dashboard
                        <small><?php echo $_SESSION['user_name']?></small>
                    </h1>
                    <?php

                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source ='';
                        }
                        switch ($source){
                            case 'add_post';
                                include "includess/add_post.php";
                            break;

                            case 'edit_post';
                                include "includess/edit_post.php";
                                break;

                            case 'view_post';
                                echo "./post.php";
                                break;

                            default:
                                include "includess/view_all_post.php";
                                break;
                        }


                    ?>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include 'includess/footer.php';?>