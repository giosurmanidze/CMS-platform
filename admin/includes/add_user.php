<?php
if (isset($_POST['create_user'])) {
    $username = escape($_POST['username']);
    $firstname = escape($_POST['firstname']);
    $lastname = escape($_POST['lastname']);
    $email = escape($_POST['email']);
    $password = escape($_POST['password']);
    $role = escape($_POST['role']);
    // $image = $_FILES['image']['name'];
    // $image_temp = $_FILES['image']['tmp_name'];

    // move_uploaded_file($image_temp, "../images/$image");
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $query = "INSERT INTO users(firstname, lastname, username, email,role, password)";
    $query .= "VALUES('{$firstname}','{$lastname}','{$username}','{$email}','{$role}','{$hashed_password}')";

    $create_user_query = mysqli_query($connection, $query);

    confirmQuery($create_user_query);

    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
 }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input class="form-control" type="text" name="firstname">
    </div>
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input class="form-control" type="text" name="lastname">
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <select class="form-control" name="role" id="role">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" type="text" name="username">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" type="email" name="email">
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
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>