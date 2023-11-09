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
                        <small>Author</small>
                    </h1>

                    <div class="col-xs-6">

                        <?php insertCategory(); ?>

                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="category-title">Add Category</label>
                                <input class="form-control" type="text" name="category_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                        </form>


                        <?php include "includes/update_categories.php" ?>

                    </div><!-- Add category form -->
                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                                <!-- FIND ALL CATEGORIES QUERY -->
                                <?php findAllCategories(); ?>

                                <!-- DELETE QUERY -->

                                <?php deleteCategory(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php" ?>