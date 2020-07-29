<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

$sql_u = $conn->query("SELECT * FROM dlike_staking");
if ($sql_u->num_rows > 0) {
    while($row_u = $sql_u->fetch_assoc()) {
    	echo $users = $row_u["username"];
    	$amount="300";

    	$conn->query("UPDATE dlike_staking_rewards SET amount = '$amount' WHERE username = '$users'");
	} 
}


?>