<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';







$id = 372;

$sqlw = "DELETE FROM staking WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id2 = 342;

$sqlw = "DELETE FROM staking WHERE id = '$id2'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id3 = 852;

$sqlw = "DELETE FROM staking WHERE id = '$id3'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id4 = 872;

$sqlw = "DELETE FROM staking WHERE id = '$id4'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id5 = 932;

$sqlw = "DELETE FROM staking WHERE id = '$id5'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id6 = 1212;

$sqlw = "DELETE FROM staking WHERE id = '$id6'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id7 = 1272;

$sqlw = "DELETE FROM staking WHERE id = '$id7'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id8 = 1282;

$sqlw = "DELETE FROM staking WHERE id = '$id8'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id9 = 1292;

$sqlw = "DELETE FROM staking WHERE id = '$id9'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id10 = 1302;

$sqlw = "DELETE FROM staking WHERE id = '$id10'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id11 = 1382;

$sqlw = "DELETE FROM staking WHERE id = '$id11'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id12 = 1342;

$sqlw = "DELETE FROM staking WHERE id = '$id12'";

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