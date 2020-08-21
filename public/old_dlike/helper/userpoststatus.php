<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	
if($_COOKIE['username'] != 'dlike') {
		$strReturn['status'] = 'no';	
		$strReturn['message'] = 'only admin can enter.';	
		echo json_encode($strReturn);die;
	}
	if(!isset($_POST['p_username']) || !isset($_POST['p_status'])) {
		$strReturn['status'] = 'Failed';
		$strReturn['message'] = 'Required parameters not passed';
		echo json_encode($strReturn);die;
	} else {
		$strReturn['status'] = 'OK';
		$username = isset($_POST["p_username"]) ? $_POST["p_username"] : "";
		$author = stripslashes( $username );
    
    $p_status = isset($_POST["p_status"])?$_POST["p_status"]:'';
    $checked_by = isset($_COOKIE['username'])?$_COOKIE['username']:"";
    
		$deleteuser = "DELETE FROM userstatus where `username` = '".$author."'";
		$deleteuser_q = $conn->query($deleteuser);
		$message = "Added Successfully!";	
		
		if($deleteuser_q) {
			$message = "Updated Successfully!";	
		}
    
		$adduserstatus = "INSERT INTO userstatus (`username`, `status`  , `set_by` , `set_time` )
													VALUES ('".$author."', '".$p_status."', '".$checked_by."', '".date("Y-m-d H:i:s")."')";
										$adduserstatusQuery = $conn->query($adduserstatus);
                    
    $strReturn['message'] = $message;	
  echo json_encode($strReturn);die;
	}
	
	
?>
