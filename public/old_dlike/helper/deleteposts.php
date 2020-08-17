<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	
  if($_COOKIE['username'] != 'dlike') {
		$strReturn['status'] = 'no';	
		$strReturn['message'] = 'only admin can delete.';	
		echo json_encode($strReturn);die;
	}

	if(!isset($_POST['p_hours'])) {
		$strReturn['status'] = 'Failed';
		$strReturn['message'] = 'Please enter hours';
		echo json_encode($strReturn);die;
	} else {
		$strReturn['status'] = 'OK';
		$updatepost_status = "delete from `steemposts` where created_at < DATE_SUB(now(), INTERVAL ".$_POST['p_hours']." HOUR)";
		$updatepost_statusq = $conn->query($updatepost_status);
		$strReturn['message'] = 'deleted Successfully!';
		
   	
  echo json_encode($strReturn);die;
	}
	
	
?>
