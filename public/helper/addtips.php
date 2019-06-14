<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '/includes/config.php';

	$saved_ip = $_COOKIE['usertoken'];
	$receiver =  $_POST['tipauthor'];	
	$sender =  $_COOKIE['username'];	
	$permlink =  $_POST['tippermlink'];	

	$sqlm = "INSERT INTO TipTop (sender, receiver, permlink, userip, tip_time)
						VALUES ('".$sender."', '".$receiver."', '".$permlink."', '".$saved_ip."', '".date("Y-m-d h:m:s")."')";


						if (mysqli_query($conn, $sqlm)) {

						
    					//echo '<script>document.getElementById("tipsubmit").reset(); setTimeout(function(){location.reload();}, 1000);</script>';
    					echo '<div class="alert alert-success">Your Tip is Added</div>';
						} else {
    					echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
						}

?>