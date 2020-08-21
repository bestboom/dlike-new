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



	if(!isset($_POST['p_username']) || !isset($_POST['p_permlink']) || !isset($_POST['p_category'])) {
		$strReturn['status'] = 'Failed';
		$strReturn['message'] = 'Required parameters not passed';
		echo json_encode($strReturn);die;
	} else {
		$strReturn['status'] = 'OK';
		$username = isset($_POST["p_username"]) ? $_POST["p_username"] : "";
		$author = stripslashes( $username );
		
		$permlink = isset($_POST["p_permlink"]) ? $_POST["p_permlink"] : "";
		$permlink = stripslashes( $permlink );
    
    $p_category = isset($_POST["p_category"]) ? $_POST["p_category"] : "";
		$p_category = stripslashes( $p_category );
    
    $p_status = isset($_POST["p_status"])?$_POST["p_status"]:'';
    $checked_by = isset($_COOKIE['username'])?$_COOKIE['username']:"";
		
		
		$sql = "SELECT * FROM poststatus where permlink = '".$permlink."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
		$updatepost_status = "UPDATE poststatus set `status` = '".$p_status."' where permlink = '".$permlink."' and username = '".$author."'";
		$updatepost_statusq = $conn->query($updatepost_status);
		$strReturn['message'] = 'Updated Successfully!';
	}
    	else {
		$addWallet = "INSERT INTO poststatus (`username`, `category`, `permlink`, `status` , `checked_by` , `check_time` ) VALUES ('".$author."', '".$p_category."', '".$permlink."', '".$p_status."', '".$checked_by."', '".date("Y-m-d H:i:s")."')";
		$addWalletQuery = $conn->query($addWallet);
                    
    		$strReturn['message'] = 'Added Successfully!';
	}
		
   	
  echo json_encode($strReturn);die;
	}
	
	
?>
