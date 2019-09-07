<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';


$sql = "ALTER TABLE steemposts ADD img_url VARCHAR(500) NOT NULL AFTER ext_url";
if ($conn->query($sql) === TRUE) {
    echo "new field added to posts table";
} else {
    echo "Error updating table: " . $conn->error;
}


?>