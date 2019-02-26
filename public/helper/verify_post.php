<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

	echo $req_author = $_POST['ath'];
	echo $req_permlink = $_POST['plink'];
?>