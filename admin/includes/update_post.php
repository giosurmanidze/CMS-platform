<?php

if (isset($_GET['update_id'])) {
    $update_id = escape($_GET['update_id']);

    $query = "SELECT * FROM `posts` WHERE `id`='$update_id'";
    $select_post_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($select_post_query);
}

if (isset($_POST['update_post'])) {
    $title = escape($_POST['title']);
    $author = escape($_POST['author']);
    $category_id = escape($_POST['category_id']);
    $status = escape($_POST['status']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $tag = escape($_POST['tag']);
    $content = escape($_POST['content']);
    $date = date('d-m-y');

    if (empty($image)) {
        $image = $row['image'];
    }

    move_uploaded_file($image_temp, "../images/$image");

    $query = "UPDATE `posts` SET title='$title', author='$author', category_id='$category_id', status='$status', image='$image', tag='$tag', content='$content', date='$date' WHERE `id`='$update_id'  ";
    $update_post_query = mysqli_query($connection, $query);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$update_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="category_title">Title</label>
        <input class="form-control" type="text" name="title" value="<?php echo $row['title']; ?>">
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select class="form-control" name="category_id" id="category_id">
            <?php
            $query = "SELECT * FROM `categories`";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while ($category = mysqli_fetch_assoc($select_categories)) {
                $categoryId = $category['id'];
                $categoryTitle = $category['title'];
                $selected = ($categoryId == $row['category_id']) ? 'selected' : '';

                echo "<option value='$categoryId' $selected>$categoryTitle</option>";
            }
            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="author">Author</label>
        <input class="form-control" type="text" name="author" value="<?php echo $row['author']; ?>">
    </div>
    <div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" name="status" id="status">
            <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
            <?php
            if ($row['status'] == 'draft') {
                echo "<option value='published'>published</option>";
            } else {
                echo "<option value='draft'>draft</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <img width="200" src="../images/<?php echo $row['image']  ?>" alt="image">
        <input class="form-control" type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tag">Tags</label>
        <input class="form-control" type="text" name="tag" value="<?php echo $row['tag']; ?>">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" type="text" name="content" id="body" cols="30"
            rows="10"><?php echo $row['content']; ?></textarea>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish post">
    </div>
</form>