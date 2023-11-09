<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $query = "SELECT * FROM `users`";
        $select_all_comments_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_comments_query)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['firstname']}</td>";
            echo "<td>{$row['lastname']}</td>";
            echo "<td>{$row['email']}</td>";
            // echo "<td>{$row['user_image']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><a href='users.php?delete_id={$row['id']}'>Delete</a></td>";
            echo "<td><a href='users.php?source=update_user&update_id={$row['id']}'>Edit</a></td>";
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
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        $delete_id = mysqli_real_escape_string($connection, $_GET['delete_id']);

        $query = "DELETE FROM `users` WHERE `id`='$delete_id'";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
}
?>