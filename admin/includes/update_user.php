<?php

if (isset($_GET['update_id'])) {

    $user_update_id = escape($_GET['update_id']);

    $query = "SELECT * FROM `users` WHERE `id`='$user_update_id'";
    $select_user_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($select_user_query);
}

if (isset($_POST['update_user'])) {
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $role = escape($_POST['role']);
    $username = escape($_POST['username']);
    $password = escape($_POST['password']);
    $email = escape($_POST['email']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $query = "UPDATE `users` SET firstname='$firstname', lastname='$lastname', role='$role', username='$username', email='$email', password='$hashed_password' WHERE `id`='$user_update_id'";

    $update_user_query = mysqli_query($connection, $query);
    header('Location: users.php');
}



?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input class="form-control" type="text" name="firstname" value="<?php echo $row['firstname'] ?>">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input class="form-control" type="text" name="lastname" value="<?php echo $row['lastname'] ?>">
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
        <input class="form-control" type="text" name="username" value="<?php echo $row['username'] ?>">
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