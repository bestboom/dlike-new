<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

$sqlw = "DELETE FROM prousers WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



/*'


/*


$id = 562;

$sqlw = "DELETE FROM prousers WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}






$sql = "ALTER TABLE steemposts ADD img_url VARCHAR(500) NOT NULL AFTER ext_url";
if ($conn->query($sql) === TRUE) {
    echo "new field added to posts table";
} else {
    echo "Error updating table: " . $conn->error;
}




$sql = "ALTER TABLE steemposts ADD ext_url VARCHAR(500) NOT NULL AFTER post_tags";
if ($conn->query($sql) === TRUE) {
    echo "new field added to posts table";
} else {
    echo "Error updating table: " . $conn->error;
}



$sql = "ALTER TABLE steemposts ADD post_tags VARCHAR(255) NOT NULL AFTER permlink";
if ($conn->query($sql) === TRUE) {
    echo "new field added to posts table";
} else {
    echo "Error updating table: " . $conn->error;
}



$result = $conn->query("SHOW COLUMNS FROM posttags");
if (!$result) {
    echo 'Could not run query: ' . $conn->error;
    exit;
}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}



$sql = "ALTER TABLE dailyRewards ADD distribute_time TIMESTAMP";
if ($conn->query($sql) === TRUE) {
    echo "Table timer added";
} else {
    echo "Error updating table: " . $conn->error;
}



$result = $conn->query("SHOW COLUMNS FROM prousers");
if (!$result) {
    echo 'Could not run query: ' . $conn->error;
    exit;
}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}




$sql = "ALTER TABLE prousers ADD last_points_update_time TIMESTAMP";
if ($conn->query($sql) === TRUE) {
    echo "Table timer added";
} else {
    echo "Error updating table: " . $conn->error;
}



$sqlm = "CREATE TABLE dailyRewards (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
total_points float(8) NOT NULL,
created_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table dailyRewards created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "ALTER TABLE dailyRewards ADD tokens float(8) NOT NULL";
if ($conn->query($sql) === TRUE) {
    echo "Table field added";
} else {
    echo "Error updating table: " . $conn->error;
}


$sql = "ALTER TABLE prousers ADD total_points float(8) NOT NULL";
if ($conn->query($sql) === TRUE) {
    echo "Table rece added";
} else {
    echo "Error updating table: " . $conn->error;
}




$sqlw = "DELETE FROM wallet WHERE username = 'adme2it'";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$updatePost = "UPDATE wallet SET phone_number = '5044fe7c6c4ddc09898d876f921ca1d2' WHERE username = 'certseek'";
$updatePostQuery = $conn->query($updatePost);
if ($updatePostQuery === TRUE) {
        echo "phone number added";
} else {
    echo "Error updating table: " . $conn->error;
}


$sqlm = "CREATE TABLE Referrals (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
refer_by VARCHAR(250) NOT NULL,
entry_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table Referral created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}






$sql = "ALTER TABLE wallet ADD phone_number VARCHAR(255) NOT NULL AFTER amount";
if ($conn->query($sql) === TRUE) {
    echo "Table colms added";
} else {
    echo "Error updating table: " . $conn->error;
}





$sqlw = "DELETE FROM TipsWallet";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}




$sqlw = "DELETE FROM TokWithdraw";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}



$sqlm = "CREATE TABLE TokWithdraw (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount float(8) NOT NULL,
token VARCHAR(250) NOT NULL,
eth_addr VARCHAR(250) NOT NULL,
paid BOOLEAN,
with_time TIMESTAMP
)";

if ($conn->query($sqlm) === TRUE) {
    echo "Table TokWithdraw created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}







$updatePost = "UPDATE transactions SET amount = 7000 WHERE username = 'lays' and reason='delegation'";
$updatePostQuery = $conn->query($updatePost);
if ($updatePostQuery === TRUE) {}



$sql = "CREATE TABLE TipsWallet (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
tip1 float(8) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TipsWallet created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sql = "ALTER TABLE transactions ADD receiver VARCHAR(255) NOT NULL AFTER reason";
if ($conn->query($sql) === TRUE) {
    echo "Table rece added";
} else {
    echo "Error updating table: " . $conn->error;
}





$sql = "ALTER TABLE wallet ADD eth VARCHAR(255) NOT NULL AFTER amount";
if ($conn->query($sql) === TRUE) {
    echo "Table colms added";
} else {
    echo "Error updating table: " . $conn->error;
}


$sqlw = "DELETE FROM prousers";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}



$sql = "CREATE TABLE prousers (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(11) NOT NULL,
buy_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table prousers created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sqlw = "DELETE FROM staking";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}

$sql = "CREATE TABLE staking (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(255) NOT NULL,
amount INT(11) NOT NULL,
period INT(11) NOT NULL,
start_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table staking created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sql = "ALTER TABLE TipTop ADD tip1 float(8) NOT NULL, ADD tip2 float(8) NOT NULL AFTER permlink";
if ($conn->query($sql) === TRUE) {
    echo "Table colms added";
} else {
    echo "Error creating table: " . $conn->error;
}



$sql = "CREATE TABLE TotalPostViews (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
author VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
totalviews INT(11) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TotalPostViews created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$sql = "CREATE TABLE PostViews (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
author VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
views INT(11) NOT NULL,
userip VARCHAR(255) NOT NULL,
view_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table PostViews created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}




$sql = "CREATE TABLE TipTop (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
sender VARCHAR(255) NOT NULL,
receiver VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
userip VARCHAR(255) NOT NULL,
tip_time TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table TipTop created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



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

-----------------

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