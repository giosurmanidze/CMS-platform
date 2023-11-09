<?php include "includes/header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $query = "SELECT * FROM `posts`";
                                    $select_all_post_query = mysqli_query($connection, $query);
                                    $posts_count = mysqli_num_rows($select_all_post_query);

                                    echo "<div class='huge'>{$posts_count}</div>";
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $query = "SELECT * FROM `comments`";
                                    $select_all_comment_query = mysqli_query($connection, $query);
                                    $comments_count = mysqli_num_rows($select_all_comment_query);

                                    echo "<div class='huge'>{$comments_count}</div>";
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM `users`";
                                    $select_all_user_query = mysqli_query($connection, $query);
                                    $users_count = mysqli_num_rows($select_all_user_query);

                                    echo "<div class='huge'>{$users_count}</div>";
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM `categories`";
                                    $select_all_category_query = mysqli_query($connection, $query);
                                    $categories_count = mysqli_num_rows($select_all_category_query);

                                    echo "<div class='huge'>{$categories_count}</div>";
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $query = "SELECT * FROM `posts` WHERE `status`='draft'";
            $select_draft_post_query = mysqli_query($connection, $query);
            $post_draft_count = mysqli_num_rows($select_draft_post_query);

            $query = "SELECT * FROM `posts` WHERE `status`='published'";
            $select_published_post_query = mysqli_query($connection, $query);
            $post_published_count = mysqli_num_rows($select_published_post_query);

            $query = "SELECT * FROM `comments` WHERE `status`='unapprove'";
            $unapproved_comments_query = mysqli_query($connection, $query);
            $unapproved_comment_count = mysqli_num_rows($unapproved_comments_query);

            $query = "SELECT * FROM `users` WHERE `role`='subscriber'";
            $select_all_subscribers_query = mysqli_query($connection, $query);
            $subscriber_count = mysqli_num_rows($select_all_subscribers_query);
            ?>

            <div class="row">
                <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['bar']
                });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Data', 'count'],
                        <?php
                            $data = [
                                'All Posts' => $posts_count,
                                'Active Posts' => $post_published_count,
                                'Draft Posts' => $post_draft_count,
                                'Comments' => $comments_count,
                                'Pending Comments' => $unapproved_comment_count,
                                'Subscribers' => $subscriber_count,
                                'Users' => $users_count,
                                'Categories' => $categories_count
                            ];

                            foreach ($data as $label => $count) {
                                echo "['$label', $count],";
                            }
                            ?>
                    ]);

                    var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>

                <div id="columnchart_material" style="width: auto; height: 400px;"></div>
            </div>