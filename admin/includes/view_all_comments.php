<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Content</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM `comments`";
        $select_all_comments_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['author']}</td>";
            echo "<td>{$row['content']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['status']}</td>";


            $query = "SELECT * FROM `posts` WHERE `id`={$row['post_id']}";
            $select_post_id_query = mysqli_query($connection, $query);

            while ($post_row = mysqli_fetch_assoc($select_post_id_query)) {
                $post_id = $post_row['id'];
                $post_title = $post_row['title'];

                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
            };


            echo "<td>{$row['date']}</td>";
            echo "<td><a href='comments.php?approve={$row['id']}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$row['id']}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete_id={$row['id']}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>


<?php

if (isset($_GET['unapprove'])) {
    $comment_id = $_GET['unapprove'];
    $query = "UPDATE `comments` SET `status` = 'unapprove' WHERE `id`='$comment_id'";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header('Location: comments.php');
}
if (isset($_GET['approve'])) {
    $comment_id = $_GET['approve'];
    $query = "UPDATE `comments` SET `status` = 'approve' WHERE `id`='$comment_id'";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header('Location: comments.php');
}





if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $query = "DELETE FROM `comments` WHERE `id`='$delete_id'";
    $delete_post_query = mysqli_query($connection, $query);
    header('Location: comments.php');
}
?>