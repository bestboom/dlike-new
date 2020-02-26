<?php
if($_COOKIE['username'] != 'dlike'){die('<script>window.location.replace("https://dlike.io","_self")</script>');};
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

$id = 1152;
$sqlw = "DELETE FROM prousers WHERE id = '$id'";

if ($conn->query($sqlw) === TRUE) {
    echo "Table DELETED successfully";
} else {
    echo "Error deleting table: " . $conn->error;
}
?>