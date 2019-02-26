<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

	$req_author = $_POST['ath'];
	$req_permlink = $_POST['plink'];
	$user_check = $_COOKIE['usertoken'];

	$verifyPost = "SELECT * FROM myLikes where userip = '$user_check' and permlink = '$req_permlink' and author = '$req_author'";
		$result = $conn->query($verifyPost);

		if ($result->num_rows > 0) {
			    die(json_encode([
            		'error' => false
        		]));
		} else { 
			    die(json_encode([
            		'error' => true
        		]));
		}
?>