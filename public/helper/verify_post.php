<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

	echo $req_author = $_POST['ath'];
	echo $req_permlink = $_POST['plink'];
	echo $_COOKIE['usertoken'];

	$verifyPost = "SELECT * FROM myLikes where userip = '$_COOKIE['usertoken']' and permlink = '$req_permlink' and author = '$req_author'";
		$result = $conn->query($verifyPost);

		if ($result->num_rows > 0) {
			echo 'already exist';
		} else { echo '#likes'; }
?>