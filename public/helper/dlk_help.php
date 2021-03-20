<?php
require '../includes/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql = "CREATE TABLE dlike_mining_rewards (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
trx_id VARCHAR(255) NOT NULL,
amount FLOAT(12,2) NOT NULL,
trx_time TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table income_transactions created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}


/*
$sql = "ALTER TABLE dlike_rewards_history ADD dlike_nodes varchar(255) NOT NULL AFTER dlike_mining";
if ($conn->query($sql) === TRUE) {
    echo "new field dlike_nodes added to wallet table";
} else {
    echo "Error updating table: " . $conn->error;
}

*/
?>