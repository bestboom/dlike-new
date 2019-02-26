<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';





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

$sqlt = "SELECT * FROM PostsLikes ORDER BY likes DESC LIMIT 1";
$result = $conn->query($sqlt);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["author"]. " " . $row["permlink"]. " " . $row["likes"]. " " . $row["rating"]. "<br>";
    }
} else {
    echo "0 results";
}

?>