<?php

    if(isset($_POST['create_post'])){
        $post_title = $_POST['title'];
        $post_author = $_POST['author'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
       // $post_comment_count = 4;

        move_uploaded_file($post_image_temp, '../images/$post_image');

        $query = "INSERT INTO posts(post_catagory_id, post_title, post_author, post_date, post_image,post_content,post_tag,post_status) ";
        $query .= "VALUES('{$post_category_id}','{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";

        $create_post_query = mysqli_query($connection, $query);
        query_check($create_post_query);
        header("Location: posts.php");
        header("Refresh:2");
    }

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">

        <select name="post_category" id="">

            <?php

            $query = "SELECT * FROM catagories";
            $select_catagories = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_catagories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="title">post author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">post status</label>
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">post image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">post tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">post content</label>
        <textarea name="post_content" id="body" cols="30" rows="10" class="form_control"></textarea>
    </div>

    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>