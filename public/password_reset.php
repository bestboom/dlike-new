<?php include('template/header7.php'); 
	if (isset($_GET['token'])) {
	     $token = $_GET['token'];
	} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}

	echo $token;
echo '<br>';
	$check_email = "SELECT email FROM dlikepasswordreset where token = '$token'";
	$result_email = $conn->query($check_email);
	if ($result_email->num_rows > 0) {
		echo 'this email exist';
	}


?>