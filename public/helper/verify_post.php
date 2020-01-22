<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

	$req_author = stripslashes($_POST['ath']);
	$req_permlink = stripslashes($_POST['plink']);
	$user_check = $_COOKIE['usertoken'];

	$verifyPost = "SELECT * FROM mylikes where userip = '$ip' and permlink = '$req_permlink' and author = '$req_author'";
		$result = $conn->query($verifyPost);

		if ($result->num_rows > 0) {
			    die(json_encode([
			    	'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'Already Upvoted'
            		
        		]));
		} else { 
			    die(json_encode([
            		'error' => false,
            		'message' => 'Thank You', 
            		'data' => 'Lets Upvote'
        		]));
		}
		$conn->close();
?>