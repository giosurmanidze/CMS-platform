<?php

if (isset($_GET['edit_id'])) {
    $edit_id = escape($_GET['edit_id']);
    $query = "SELECT * FROM `categories` WHERE `id` = '$edit_id'";
    $select_specific_category_query = mysqli_query($connection, $query);

    if (!$select_specific_category_query) {
        die("Query failed: " . mysqli_error($connection));
    }
    $row = mysqli_fetch_assoc($select_specific_category_query);
}


if (isset($_POST['update_submit'])) {
    $category_title = escape($_POST['category_title']);

    $query = "UPDATE `categories` SET title = '$category_title' WHERE `id` = $edit_id";
    $update_category_query = mysqli_query($connection, $query);

    confirmQuery($update_category_query);

    header("Location: categories.php");
}

if (isset($_GET['edit_id'])) {
    echo
    "<form action='categories.php?edit_id={$row['id']}' method='post'>
       <div class='form-group'>
        <label for='category-title'>Update Category</label>
        <input class='form-control' type='text' name='category_title' value='{$row['title']}'>
        </div>
        <div class='form-group'>
            <input class='btn btn-primary' type='submit' name='update_submit' value='Update'>
        </div>
    </form>";
}