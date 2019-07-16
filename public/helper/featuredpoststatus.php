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
    
    $title = isset($_POST["title"]) ? $_POST["title"] : "";
		$title = stripslashes( $title );
    
    $img_link = isset($_POST["img_link"]) ? $_POST["img_link"] : "";
		$img_link = stripslashes( $img_link );
		
		$permlink = isset($_POST["p_permlink"]) ? $_POST["p_permlink"] : "";
		$permlink = stripslashes( $permlink );
    
    $p_category = isset($_POST["p_category"]) ? $_POST["p_category"] : "";
		$p_category = stripslashes( $p_category );
    

    $checked_by = isset($_COOKIE['username'])?$_COOKIE['username']:"";
		
		$sql = "SELECT * FROM featuredposts where permlink = '".$permlink."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		
		$updatepost_status = "DELETE FROM featuredposts where permlink = '".$permlink."'";
		$updatepost_statusq = $conn->query($updatepost_status);
		$strReturn['message'] = 'Deleted Successfully!';
		
		$strReturn['insertid'] = null;	           
	}
    	else {
    
		
    $featuredposts = "INSERT INTO featuredposts (`username`, `category`,`title`,`img_link`, `permlink`, `add_time` )
													VALUES ('".$author."', '".$p_category."', '".$title."', '".$img_link."', '".$permlink."', '".date("Y-m-d H:i:s")."')";
										$featuredpostsQuery = $conn->query($featuredposts);
    $strReturn['insertid'] = mysqli_insert_id($conn);	                
    $strReturn['message'] = 'Added Successfully!';	
		
	}
  echo json_encode($strReturn);die;
	}
	
	
?>
