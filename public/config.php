<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require 'includes/config.php';

/*

$sql = "CREATE TABLE `PostsLikes` (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
author VARCHAR(255) NOT NULL,
permlink VARCHAR(255) NOT NULL,
likes INT(50),
rating INT(50)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$q = $conn->query('DESCRIBE PostsLikes');
if ($q->num_rows > 0) {
    // output data of each row
    while($row = $q->fetch_assoc()) {
       echo "{$row['Field']} - {$row['Type']}\n";
    }
} else {
    echo "0 results";
}



$sql = "DELETE FROM MyLikes";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

echo '<br>';

$sqlm = "ALTER TABLE `MyLikes` ADD `author` varchar(255) NULL";

if (mysqli_query($conn, $sqlm)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlm . "<br>" . mysqli_error($conn);
}

echo '<br>';

$sqlmt = "ALTER TABLE `MyLikes` ADD `permlink` varchar(255) NULL";

if (mysqli_query($conn, $sqlmt)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlmt . "<br>" . mysqli_error($conn);
}

echo '<br>';

$sql = "SELECT id, username, likes, stars, userip FROM MyLikes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["likes"]. " " . $row["stars"]. " " . $row["userip"]. "<br>";
    }
} else {
    echo "0 results";
}

echo '<br>';

$sqlmp = "ALTER TABLE `MyLikes` DROP COLUMN `likes`";

if (mysqli_query($conn, $sqlmp)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlmp . "<br>" . mysqli_error($conn);
}

echo '<br>';
*/




$conn->close();
?>
