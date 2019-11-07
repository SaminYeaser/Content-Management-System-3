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
                        Welcome to Admin
                        <small>Author</small>
                    </h1>


                    <div class="col-xs-6">


<?php

submitForm();

?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input type="text" class="form-control" name="catTitle">
                            </div>

                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat-title">Edit Category</label>

                                <?php

                                    if(isset($_GET['edit'])){
                                    $cat_edit_id = $_GET['edit'];
                                $query = "SELECT * FROM catagories WHERE cat_id ={$cat_edit_id}";
                                $edit_from_catagories = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($edit_from_catagories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                ?>

                                <input value="<?php if(isset($cat_title)){echo $cat_title;}?>" type="text" class="form-control" name="cat_title">
                            </div>
                                <?php } }?>

                            <?php

                            if(isset($_POST['update'])) {
                                $the_cat_id = $_POST['cat_title'];

                                $query = "UPDATE catagories SET cat_title = '{$the_cat_id}' WHERE cat_id = '{$cat_id}' ";
                                $edit_categories = mysqli_query($connection, $query);
                                if (!$edit_categories) {
                                    die("Failed" . mysqli_error($connection));
                                }
                            }
                            ?>


                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Category">
                            </div>
                        </form>
                    </div>


                    <div class="col-xs-6">

                        <?php
                        delete_categories();

                        ?>


                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Title</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>

                                    <?php

                                    $query = "SELECT * FROM catagories";
                                    $select_from_catagories = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_from_catagories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];


                              echo  "<tr>";
                               echo "<td>{$cat_id}</td>";
                               echo "<td>{$cat_title}</td>";
                               echo "<td><a href = 'categories.php?delete={$cat_id}'> Delete</a></td>";
                               echo "<td><a href = 'categories.php?edit={$cat_id}'> Edit</a></td>";
                            echo "</tr>";
                            }
                          ?>





                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include 'includess/footer.php';?>