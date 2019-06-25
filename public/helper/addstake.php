<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

if (isset($_POST["stakemaount"]) && isset($_POST["stake_option"]) && isset($_POST["staker"])){

	echo $amount = $_POST["stakemaount"];
	echo $period = $_POST["stake_option"];
	echo $user = $_POST["staker"];

$sqls = "SELECT amount FROM wallet where username='$user'"; 
$resultAmount = $conn->query($sqls);
if ($resultAmount->num_rows > 0) {
$rowIt = $resultAmount->fetch_assoc();	
echo (number_format($rowIt['amount']));
} else {echo '<div class="alert alert-danger">You are not in balance!</div>';}



} else {echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';}

?>