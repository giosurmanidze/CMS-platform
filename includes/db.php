<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'cms';


$connection = mysqli_connect($host, $username, $password, $db_name);

if (!$connection) {
    echo "We are not connected";
}
