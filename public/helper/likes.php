<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';







$id = 252;

$sqlw = "DELETE FROM staking WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id2 = 482;

$sqlw = "DELETE FROM staking WHERE id = '$id2'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id3 = 462;

$sqlw = "DELETE FROM staking WHERE id = '$id3'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id4 = 492;

$sqlw = "DELETE FROM staking WHERE id = '$id4'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id5 = 452;

$sqlw = "DELETE FROM staking WHERE id = '$id5'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id6 = 442;

$sqlw = "DELETE FROM staking WHERE id = '$id6'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id7 = 422;

$sqlw = "DELETE FROM staking WHERE id = '$id7'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id8 = 402;

$sqlw = "DELETE FROM staking WHERE id = '$id8'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id9 = 392;

$sqlw = "DELETE FROM staking WHERE id = '$id9'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id10 = 222;

$sqlw = "DELETE FROM staking WHERE id = '$id10'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
<!--
$sqlw = "DELETE FROM `steemposts` 
  WHERE id NOT IN (
    SELECT * FROM (
      SELECT MAX(id) FROM steemposts 
        GROUP BY title
    ) as T
  )";

if ($conn->query($sqlw) === TRUE) {
    echo "Posts DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

-->