<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';





$id = 2902;

$sqlw = "DELETE FROM staking WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id2 = 2892;

$sqlw = "DELETE FROM staking WHERE id = '$id2'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id3 = 2882;

$sqlw = "DELETE FROM staking WHERE id = '$id3'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id4 = 2872;

$sqlw = "DELETE FROM staking WHERE id = '$id4'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id5 = 2862;

$sqlw = "DELETE FROM staking WHERE id = '$id5'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id6 = 2852;

$sqlw = "DELETE FROM staking WHERE id = '$id6'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id7 = 2802;

$sqlw = "DELETE FROM staking WHERE id = '$id7'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id8 = 2792;

$sqlw = "DELETE FROM staking WHERE id = '$id8'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id9 = 2782;

$sqlw = "DELETE FROM staking WHERE id = '$id9'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}



$id10 = 2772;

$sqlw = "DELETE FROM staking WHERE id = '$id10'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id11 = 2762;

$sqlw = "DELETE FROM staking WHERE id = '$id11'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id12 = 2752;

$sqlw = "DELETE FROM staking WHERE id = '$id12'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id13 = 2742;

$sqlw = "DELETE FROM staking WHERE id = '$id13'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id14 = 2722;

$sqlw = "DELETE FROM staking WHERE id = '$id14'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id15 = 2702;

$sqlw = "DELETE FROM staking WHERE id = '$id15'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id16 = 2692;

$sqlw = "DELETE FROM staking WHERE id = '$id16'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id17 = 4752;

$sqlw = "DELETE FROM staking WHERE id = '$id17'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id18 = 4632;

$sqlw = "DELETE FROM staking WHERE id = '$id18'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$id19 = 4612;

$sqlw = "DELETE FROM staking WHERE id = '$id19'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id20 = 4532;

$sqlw = "DELETE FROM staking WHERE id = '$id20'";

if ($conn->query($sqlw) === TRUE) {
    echo "Row DELETED successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


$id21 = 4502;

$sqlw = "DELETE FROM staking WHERE id = '$id21'";

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