<?php include "includes/header.php";  ?>

<!-- Navigation -->

<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])) {
                $p_id = $_GET['p_id'];

                $view_query = "UPDATE posts SET views_count = views_count + 1 WHERE id='{$p_id}'";
                $send_query = mysqli_query($connection, $view_query);

                if (!$send_query) {
                    die("QUERY FAILED");
                }

                $query = "SELECT * FROM `posts` WHERE `id`=$p_id";
                $select_all_posts_query = mysqli_query($connection, $query);

                $row = mysqli_fetch_assoc($select_all_posts_query);


                $query = "SELECT username FROM users WHERE id = {$row['user_id']}";
                $get_user_username_query = mysqli_query($connection, $query);
                $user = mysqli_fetch_assoc($get_user_username_query);

            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $row['title']; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?user_id=<?php echo $row['user_id'] ?>"><?php echo $user['username']  ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $row['date']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['image'] ?>" alt="">
                <hr>
                <p><?php echo $row['content']; ?></p>
                <hr>
                <?php
                if (isset($_POST['create_comment'])) {

                    $post_id = $_GET['p_id'];

                    $comment_author = $_POST['author'];
                    $comment_email = $_POST['email'];
                    $comment_content = $_POST['content'];

                    if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

                        $query = "INSERT INTO `comments` (post_id,author,email,content,status,date)";
                        $query .= "VALUES ('{$post_id}','{$comment_author}','{$comment_email}','{$comment_content}','unapproved',now())";

                        $create_comment_query = mysqli_query($connection, $query);
                        if (!$create_comment_query) {
                            die("QUERY FAILED" . mysqli_error($connection));
                        }

                        // $query = "UPDATE `posts` SET `comment_count` = `comment_count` + 1 ";
                        // $query .= "WHERE `id`={$post_id}";
                        // $update_comment_count_query = mysqli_query($connection, $query);



                    } else {
                        echo "<p class='bg-danger'>Fields cannot be empty !!!</p>";
                    }
                }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php

                $query = "SELECT * FROM `comments` WHERE `post_id`={$p_id} ";
                $query .= "AND `status` = 'approve' ";
                $query .= "ORDER BY `id` DESC ";
                $select_comment_query = mysqli_query($connection, $query);

                if (!$select_comment_query) {
                    die('QUERY FAILED' . mysqli_error($connection));
                }

                while ($comment_row = mysqli_fetch_array($select_comment_query)) {
                    $comment_content = $comment_row['content'];
                    $comment_author = $comment_row['author'];

                ?>
                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>

            <?php }
            } else {
                header("Location: index.php");
            } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>