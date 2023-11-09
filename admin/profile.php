<?php include "includes/header.php" ?>

<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM `users` WHERE `username`='$username'";
    $select_user_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($select_user_query);
}
?>

<?php
if (isset($_POST['update_user'])) {
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $username = escape($_POST['username']);
    $email = escape($_POST['email']);
    $role = escape($_POST['role']);
    $password = escape($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE `users` SET firstname='$firstname', lastname='$lastname',username='$username',email='$email',role='$role', password='$hashed_password' WHERE username='$username'";
    $update_user_query = mysqli_query($connection, $query);
    header('Location: profile.php');

    if (!$update_user_query) {
        die("QUERY FAILED:" . mysqli_error($connection));
    }
}

?>


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


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input class="form-control" type="text" name="firstname"
                                value="<?php echo $row['firstname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input class="form-control" type="text" name="lastname"
                                value="<?php echo $row['lastname'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role">
                                <option value="<?php echo $row['role'] ?>"><?php echo $row['role'] ?></option>
                                <?php
                                if ($row['role'] == 'admin') {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }
                                ?>

                            </select>
                        </div>
                        <div class=" form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" name="username"
                                value="<?php echo $row['username'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" value="<?php echo $row['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Passowrd</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <!-- <div class="form-group">
        <label for="user_image">User Image</label>
        <input class="form-control" type="file" name="user_image">
    </div> -->
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
                        </div>
                    </form>
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