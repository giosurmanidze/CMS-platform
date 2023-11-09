<?php include "includes/header.php";  ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            $query = "SELECT * FROM `posts`";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {

                if ($row['status'] == 'published') {

            ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a>
                    </h2>


                    <?php

                    $query = "SELECT username FROM users WHERE id = {$row['user_id']}";
                    $get_user_username_query = mysqli_query($connection, $query);

                    $user = mysqli_fetch_assoc($get_user_username_query);
                    ?>

                    <p class="lead">
                        by <a href="author_posts.php?user_id=<?php echo $row['user_id'] ?>"><?php echo $user['username']  ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $row['date']; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $row['id'] ?>">
                        <img class="img-responsive" src="images/<?php echo $row['image'] ?>" alt="">
                    </a>
                    <hr>
                    <p><?php echo substr($row['content'], 0, 150); ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $row['id'] ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

            <?php  }
            } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>