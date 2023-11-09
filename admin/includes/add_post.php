<?php
if (isset($_POST['create_post'])) {
    $title = escape($_POST['title']);
    $user_id = $_SESSION['user_id'];
    $category_id = escape($_POST['category_id']);
    $status = escape($_POST['status']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $tag = escape($_POST['tag']);
    $content = escape($_POST['content']);
    $date = date('d-m-y');
    // $comment_count = 4;

    move_uploaded_file($image_temp, "../images/$image");

    $query = "INSERT INTO posts(category_id, title,user_id, date, image, content, tag, status)";
    $query .= "VALUES('{$category_id}','{$title}','{$user_id}',now(),'{$image}','{$content}','{$tag}','{$status}')";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);

    // GET LAST ADDED ID
    $post_id = mysqli_insert_id($connection);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";
}

?>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_title">Title</label>
        <input class="form-control" type="text" name="title">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php

            $query = "SELECT * FROM `categories`";
            $select_all_categories = mysqli_query($connection, $query);

            while ($category = mysqli_fetch_assoc($select_all_categories)) {
                $categoryId = $category['id'];
                $categoryTitle = $category['title'];

                echo "<option value='$categoryId' >$categoryTitle</option>";
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="draft">Select Options</option>
            <option value="draft">draft</option>
            <option value="publish">publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tag">Tags</label>
        <input class="form-control" type="text" name="tag">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" type="text" name="content" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish post">
    </div>
</form>