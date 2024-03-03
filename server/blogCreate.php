<?php

require "./conn.php";

if(isset($_POST['blog_create'])) {
    $bTitle = $_POST['blog-title'];
    $bText = $_POST['blog-text'];
    $bDate = $_POST['blog-date'];

    $insertQuery = "INSERT INTO blog_tbl (blog_title, blog_text, blog_date)
    VALUES ('$bTitle', '$bText', '$bDate')";

    if (mysqli_query($conn, $insertQuery)) {
        header("location: ../index.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
