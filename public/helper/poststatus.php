<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	
	$strReturn = [];
	if(!isset($_POST['p_username']) || !isset($_POST['p_permlink']) || !isset($_POST['p_category'])) {
		$strReturn['status'] = 'Failed';
		$strReturn['reason'] = 'Required parameters not passed';
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
    
		
    $addWallet = "INSERT INTO poststatus (`username`, `category`, `permlink`, `status` , `checked_by` , `check_time` )
													VALUES ('".$author."', '".$p_category."', '".$permlink."', '".$p_status."', '".$checked_by."', '".date("Y-m-d H:i:s")."')";
										$addWalletQuery = $conn->query($addWallet);
                    
    $strReturn['message'] = 'Added Successfully!';	
  
	}
	
	echo json_encode($strReturn);die;
?>
