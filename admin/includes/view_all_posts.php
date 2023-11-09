<?php

if (isset($_POST['checkBoxArray'])) {

    foreach ($_POST['checkBoxArray'] as $postValueId) {

        $bulk_options = $_POST['bulk_options'];


        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET status='$bulk_options' WHERE id='$postValueId'";
                $update_to_publish_status = mysqli_query($connection, $query);
                confirmQuery($update_to_publish_status);
                break;
            case 'draft':
                $query = "UPDATE posts SET status='$bulk_options' WHERE id='$postValueId'";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE id='$postValueId'";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirmQuery($update_to_delete_status);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE id='{$postValueId}'";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title = $row['title'];
                    $post_category_id = $row['category_id'];
                    $post_date = $row['date'];
                    $post_status = $row['status'];
                    $post_image = $row['image'];
                    $post_tags = $row['tag'];
                    $post_content = $row['content'];
                    $post_user_id = $row['user_id'];
                    $post_views_count = $row['views_count'];
                }

                $query = "INSERT INTO posts(title,user_id,views_count, category_id,  date, status, image, tag, content) ";
                $query .= "VALUES('{$post_title}','{$post_user_id}','{$post_views_count}','{$post_category_id}','{$post_date}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                $copy_post_query = mysqli_query($connection, $query);


                if (!$copy_post_query) {
                    die("QUERY FAILED " . mysqli_error($connection));
                }
        }
    }
}

?>

<form action="" method="post">

    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>


        <thead>
            <tr>
                <th><input id="checkAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Categories</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $query = "SELECT * FROM posts ORDER BY id DESC";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                $query = "SELECT username FROM users WHERE id = {$row['user_id']}";
                $get_user_username_query = mysqli_query($connection, $query);
                $user = mysqli_fetch_assoc($get_user_username_query);

                echo "<tr>";

            ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $row['id'] ?>'>
                </td>
            <?php


                echo "<td>{$row['id']}</td>";
                echo "<td>{$user['username']}</td>";
                echo "<td>{$row['title']}</td>";

                $query = "SELECT * FROM `categories` WHERE `id`={$row['category_id']}";
                $select_categories = mysqli_query($connection, $query);

                while ($row2 = mysqli_fetch_assoc($select_categories)) {
                    echo "<td>{$row2['title']}</td>";
                }

                echo "<td>{$row['status']}</td>";
                echo "<td><img width='100' src='../images/{$row['image']}' alt='image'/></td>";
                echo "<td>{$row['tag']}</td>";


                $query = "SELECT * FROM comments WHERE post_id='{$row['id']}'";
                $send_comment_query = mysqli_query($connection, $query);
                $count_comments = mysqli_num_rows($send_comment_query);

                echo "<td>{$count_comments}</td>";

                echo "<td>{$row['date']}</td>";
                echo "<td><a href='../post.php?p_id={$row['id']}'>View Post</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='posts.php?delete_id={$row['id']}'>Delete</a></td>";
                echo "<td><a href='posts.php?source=update_post&update_id={$row['id']}'>Edit</a></td>";
                echo "<td>{$row['views_count']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>


<?php
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $query = "DELETE FROM `posts` WHERE `id`='$delete_id'";
    $delete_post_query = mysqli_query($connection, $query);
    header('Location: posts.php');
}
?>