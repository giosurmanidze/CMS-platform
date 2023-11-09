<?php include "includes/header.php";  ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
            }

            $query = "SELECT * FROM `posts` WHERE `category_id`='$category_id'";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $row['author']  ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $row['date']; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $row['image'] ?>" alt="">
                <hr>
                <p><?php echo substr($row['content'], 0, 150); ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php   } ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php" ?>
    </div>
    <!-- /.row -->
    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>