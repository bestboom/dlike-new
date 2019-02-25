<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

$sqlm = "INSERT INTO MyLikes (username, likes, stars, userip)
VALUES ('certseek', 9 , 2, 33323423412)";

if (mysqli_query($conn, $sqlm)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlm . "<br>" . mysqli_error($conn);
}


?>