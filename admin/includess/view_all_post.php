
<?php

    if(isset($_POST['checkBoxArray'])){
        foreach ($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options = $_POST['bulkOption'];

            switch ($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id ='{$checkBoxValue}'";
                    $newly_update_post_for_draft = mysqli_query($connection, $query);
                    break;

                case 'draft':
                    $query = "UPDATE posts SET post_status ='{$bulk_options}' WHERE post_id ='{$checkBoxValue}'";
                    $newly_update_post_for_published = mysqli_query($connection, $query);
                    break;

                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id='{$checkBoxValue}'";
                    $newly_update_post_for_delete = mysqli_query($connection, $query);
                    break;
            }

        }
    }

?>


<form action="" method="post">

<table class="table table-bordered table-hover">

    <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulkOption" id="">
            <option value="">Select Option</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-primary" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <thead>
    <tr>
        <th><input id="selectAllBoxes" type="checkbox" class="checkbox"></th>
<!--        <th>Id</th>-->
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Images</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Dates</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>This post Have been viewed</th>
        <th>Reset Post Views</th>
    </tr>
    </thead>
    <tbody>

    <?php

    $query = "SELECT * FROM posts ORDER BY post_id DESC ";
    $select_post = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_post)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_catagory_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tag'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        $post_view_count = $row['post_view_count'];

        echo "<tr>";

        ?>

        <td><input type="checkbox" class="checkbox" name="checkBoxArray[]" value="<?php echo $post_id?>"></td>

        <?php
      //  echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";


        $query = "SELECT * FROM catagories WHERE cat_id={$post_category_id}";
        $select_from_catagories = mysqli_query($connection, $query);

         while ($row = mysqli_fetch_assoc($select_from_catagories)) {
             $cat_id = $row['cat_id'];
             $cat_title = $row['cat_title'];

             echo "<td>$cat_title</td>";
         }



        echo "<td>$post_status</td>";
        echo "<td><img src='../images/$post_image' width='100' alt='image'</td>";
        echo "<td>$post_tags</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $comment_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($comment_query);
        $comment_id = $row['comment_id'];
        $comment_count = mysqli_num_rows($comment_query);


        echo "<td><a href='comment.php?id=$post_id'>$comment_count</a></td>";
        echo "<td>$post_date</td>";
        echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to delete this post?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td>$post_view_count</td>";
        echo "<td><a onclick=\"javascript: return confirm('Are you sure you want to reset?');\" href='posts.php?reset={$post_id}'>Reset</a></td>";
        echo "</tr>";

    }

    ?>

    </tbody>
</table>
</form>
<?php

    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id ={$the_post_id}";
        $delete_post = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = $the_post_id";
    $reset_post = mysqli_query($connection, $query);
    header("Location: posts.php");
}

?>