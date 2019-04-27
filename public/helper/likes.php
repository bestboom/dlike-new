<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

$sql = "CREATE TABLE FeaturedPosts (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
category VARCHAR(255) NOT NULL,
title VARCHAR(255) NOT NULL,
img_link VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
add_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table FeaturedPosts created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

/*

$sql = "CREATE TABLE PostStatus (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
category VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
status VARCHAR(255) NOT NULL,
check_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table PostStatus created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
------------
$sql = "CREATE TABLE UserStatus (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
status VARCHAR(255) NOT NULL,
set_by VARCHAR(255) NOT NULL,
set_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table UserStatus created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

--------------

$sqlw = "DELETE FROM PostsLikes";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlm = "DELETE FROM transactions";

if ($conn->query($sqlm) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sqlw = "DELETE FROM wallet";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sql = "CREATE TABLE wallet (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(30) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table wallet created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$sqlm = "CREATE TABLE transactions (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(30) NOT NULL,
reason VARCHAR(250),
trx_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$author = 'sweden2023';
$permlink = 'pentagon-ran-secret-multi-million-dollar-ufo-programme--bbc-news';


$updatePost = "UPDATE PostsLikes SET likes = 6, rating = 28 WHERE author = '$author' AND permlink = '$permlink'";
$updatePostQuery = $conn->query($updatePost);
if ($updatePostQuery === TRUE) {}



/*
$sql = "SELECT id, username, stars, userip, author, permlink, like_date FROM MyLikes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["stars"]. " " . $row["userip"]. " " . $row["author"]. " " . $row["permlink"]. " " . $row["like_date"]. "<br>";
    }
} else {
    echo "0 results";
}

echo '<br>';

$sqlt = "SELECT id, author, permlink, likes, rating FROM PostsLikes";
$result = $conn->query($sqlt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["author"]. " " . $row["permlink"]. " " . $row["likes"]. " " . $row["rating"]. "<br>";
    }
} else {
    echo "0 results";
}
*/
?>