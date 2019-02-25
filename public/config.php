<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'includes/config.php';

$sql = "DELETE FROM MyLikes";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

/*
$sqlm = "INSERT INTO MyLikes (username, likes, stars, userip)
VALUES ('certseek', 9 , 2, 33323423412)";

if (mysqli_query($conn, $sqlm)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sqlm . "<br>" . mysqli_error($conn);
}
*/


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



$conn->close();
?>
