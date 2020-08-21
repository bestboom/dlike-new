<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

	if (isset($_POST["ath"]) && isset($_POST["plink"])){

		$req_author = stripslashes($_POST['ath']);
		$req_permlink = stripslashes($_POST['plink']);
		$user_check = $_COOKIE['usertoken'];
		$userval = $_COOKIE['dlike_username'];

		$verifyPost = "SELECT * FROM mylikes where username = '$userval' and permlink = '$req_permlink' and author = '$req_author'";
		$result = $conn->query($verifyPost);

		if ($result->num_rows > 0) {
			    die(json_encode([
			    	'error' => true,
	        		'message' => 'You have already recomended this share!'
	    		]));
		} else { 
			    die(json_encode([
	        		'error' => false,
	        		'message' => 'Recommending...'
	    		]));
		}
	} else{
		die(json_encode([
	    	'error' => true,
    		'message' => 'There is some issue. Please try later!'
		]));
	}
?>