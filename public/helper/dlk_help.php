<?php
require '../includes/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$sql = "ALTER TABLE dlike_rewards_history ADD dlike_mining varchar(255) NOT NULL AFTER dlike_foundation";
if ($conn->query($sql) === TRUE) {
    echo "new field dlike_nodes added to wallet table";
} else {
    echo "Error updating table: " . $conn->error;
}


?>