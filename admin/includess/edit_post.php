
<?php

if(isset($_GET['p_id'])){

    $the_edit_post_Id = $_GET['p_id'];

}


$query = "SELECT * FROM posts WHERE post_id=$the_edit_post_Id";
$select_post_by_id = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_post_by_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_catagory_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tag'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_content = $row['post_content'];
}

if(isset($_POST['update_post'])) {

    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_category_id = $_POST['post_category'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id ={$the_edit_post_Id}";
        $image_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($image_query)) {
            $post_image = $row['post_image'];
        }
    }

        $query = "UPDATE posts SET ";
        $query .= "post_title ='{$post_title}', ";
        $query .= "post_catagory_id ='{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author ='{$post_author}',";
        $query .= "post_status ='{$post_status}',";
        $query .= "post_tag ='{$post_tags}',";
        $query .= "post_content ='{$post_content}',";
        $query .= "post_image ='{$post_image}' ";
        $query .= "WHERE post_id = {$the_edit_post_Id}";

        $update = mysqli_query($connection, $query);

        query_check($update);
        echo "<p>Post Updated.<a href='../post.php?p_id={$the_edit_post_Id}'>View the post</a></p>";
}

?>




<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
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
        <input value="<?php echo $post_author;?>" type="text" class="form-control" name="author">
    </div>



    <div class="form-group">

        <select name="post_status" id="">

            <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
            <?php

                if($post_status == 'published'){
                    echo "<option value='draft'>Draft</option>";
                }else{
                    echo "<option value='published'>Published</option>";
                }

            ?>

        </select>



    </div>

    <!--    <div class="form-group">-->
<!--        <label for="post_status">post status</label>-->
<!--        <input value="--><?php //echo $post_status;?><!--" type="text" class="form-control" name="post_status">-->
<!--    </div>-->

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">post tags</label>
        <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">post content</label>
        <textarea  name="post_content" id="body" cols="30" rows="10" class="form_control">
            <?php echo $post_content;?>
        </textarea>
    </div>

    <div class="form-group">

        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>

</form>