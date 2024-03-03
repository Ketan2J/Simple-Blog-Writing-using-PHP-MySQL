<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "blog_page";

$conn = new mysqli($server, $username, $password, $dbname);

if (!$conn) {
    echo "Connection Failed!";
}

?>