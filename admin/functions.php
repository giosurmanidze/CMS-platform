<?php


function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}


function users_online()
{

    if (isset($_GET['online_users'])) {

        global $connection;


        if (!$connection) {
            session_start();
            include("../includes/db.php");


            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session='$session'";
            $send_query = mysqli_query($connection, $query);

            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session = '$session'");
            }
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '{$time_out}'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } //get request isset()
}
users_online();


function confirmQuery($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED:" . mysqli_error($connection));
    }
}

function insertCategory()
{
    global $connection;

    if (isset($_POST['submit'])) {

        $category_title = $_POST['category_title'];

        $message = ($category_title == "" || empty($category_title)) ? "This field should not be empty" : "";

        if (!empty($message)) {
            echo $message;
        } else {
            $query = "INSERT INTO categories(title) VALUE ('$category_title')";

            $create_category = mysqli_query($connection, $query);
            if (!$create_category) {
                die("QUERY FAILED: " . mysqli_error($connection));
            }
        }
    }


    function findAllCategories()
    {
        global $connection;

        $query = "SELECT * FROM `categories`";
        $select_all_categories = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_categories)) {
            $category_id = $row['id'];
            $category_title = $row['title'];
            echo "<tr>";
            echo "<td>{$category_id}</td>";
            echo "<td>{$category_title}</td>";
            echo "<td><a href='categories.php?delete_id={$row['id']}'>Delete</a></td>";
            echo "<td><a href='categories.php?edit_id={$row['id']} ?>'>Edit</a></td>";
            echo "<tr>";
        }
    }

    function deleteCategory()
    {
        global $connection;

        if (isset($_GET['delete_id'])) {
            $delete_id = $_GET['delete_id'];
            $query = "DELETE FROM `categories` WHERE `id`=$delete_id";
            $delete_category_query = mysqli_query($connection, $query);
            if (!$delete_category_query) {
                echo "QUERY FAILED: " . mysqli_error($connection);
            }
            header("Location: categories.php");
        }
    }
}
