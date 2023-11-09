<?php include "includes/header.php";  ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            }

            $query = "SELECT * FROM posts WHERE `user_id` = '$user_id'";
            $select_all_user_related_posts = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_user_related_posts)) {

            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $row['date']; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $row['id'] ?>">
                    <img class="img-responsive" src="images/<?php echo $row['image'] ?>" alt="">
                </a>
                <hr>
                <p><?php echo $row['content']; ?></p>
                <hr>

            <?php } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>