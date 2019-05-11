<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
require '../includes/config.php';

if(isset($_POST['tagname']) && $_POST['tagname'] != "") {
	
	  
    	$sql = "SELECT postid FROM posttags where tagname = '".$_POST['tagname']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$postid = $row['postid'];
		}
		$sql1 = "SELECT * FROM steemposts where id IN (".$postid.") order by created_at DESC";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
			    
				$json_metadata = json_decode($row1['json_metadata'],true);
				$data['username'] = $row1['username'];
				$data['permlink'] = $row1['permlink'];
				$data['metatags'] = $meta_array;

				$strReturn['data_row'][] = $data;
			}
			$strReturn['status'] = 'OK';
		}
		
		
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
}

if(isset($_REQUEST['catname']) && $_REQUEST['catname'] != "") {

	
	$sql1 = 'SELECT json_metadata,username,permlink,created_at FROM steemposts order by id DESC';
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) {
			
			$json_metadata = json_decode($row1['json_metadata'],true);
			if(strtolower($json_metadata['category']) == strtolower($_REQUEST['catname'])) {
				$data['username'] = $row1['username'];
				$data['permlink'] = $row1['permlink'];
				$data['created_at'] = $row1['created_at'];
				$strReturn['data_row'][] = $data;
			}
		}
		$strReturn['status'] = 'OK';
	}
	else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;

}
?>
