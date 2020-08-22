<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	  
    	$sql = "SELECT * FROM userstatus where username = '".$_POST['author']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$strReturn['setstatus'] = $row['status'];
			$strReturn['status'] = 'OK';
		}
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
?>