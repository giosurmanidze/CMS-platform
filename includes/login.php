<?php include 'db.php' ?>
<?php session_start() ?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM `users` WHERE `username`='$username'";
    $select_user_query = mysqli_query($connection, $query);

    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {

        $db_user_firstname = $row['firstname'];
        $db_user_lastname = $row['lastname'];
        $db_user_username = $row['username'];
        $db_user_password = $row['password'];
        $db_user_role = $row['role'];
        $db_user_id = $row['id'];
        
        $verify_password = password_verify($password, $db_user_password);
    }
    if ($username === $db_user_username &&  $verify_password) {

        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['username'] = $db_user_username;
        $_SESSION['role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;

        header('Location: ../admin');
    } else {
        header('Location: ../index.php');
    }
}