<?php 
    if(isset($_POST['create_post'])) {
        $post_title = mysqli_real_escape_string($connection, $_POST['title']);
        $post_author = mysqli_real_escape_string($connection, $_POST['author']);
        $post_category_id = mysqli_real_escape_string($connection, $_POST['post_category']);
        $post_status = mysqli_real_escape_string($connection, $_POST['status']);
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = mysqli_real_escape_string($connection, $_POST['post_tags']);
        $post_content = mysqli_real_escape_string($connection, $_POST['post_content']);
        $post_date = date('d-m-y');


        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author,
        post_date,post_image,post_content,post_tags,post_status) ";
        $query .= 
        "VALUES({$post_category_id},'{$post_title}','{$post_author}', now(),'{$post_image}','{$post_content}',
        '{$post_tags}','{$post_status}' ) ";

        $create_post_query = mysqli_query($connection, $query);

        confirmQuery($create_post_query);
        $the_post_id = mysqli_insert_id($connection);


        echo "<p class='bg-info'>Post Updated. 
                 Created Post or
                <a href='post.php?p_id{$the_post_id}'> Edit More Posts</a>
            </p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_category">Post Title</label>
        <input class="form-control" type="text" name="title">
    </div>
    <div class="form-group">
        
        <select name="post_category" id="">
            <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($connection,$query); 
                confirmQuery($select_categories);
                while($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title']; 
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_tags">Post Author</label>
        <input class="form-control" type="text" name="author">
    </div>
    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input class="form-control" type="text" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea id="body" class="form-control" name="post_content" id="" cols="30" rows="10">
        </textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>