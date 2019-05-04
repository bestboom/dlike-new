<?php
if(isset($_POST['tagname']) && $_POST['tagname'] != "") {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	  
    	$sql = "SELECT postid FROM posttags where tagname = '".$_POST['tagname']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$postid = $row['postid'];
		}
		$sql1 = "SELECT * FROM steemposts where id IN (".$postid.")";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				
				$json_metadata = json_decode($row1['json_metadata'],true);
				
				
				$data['username'] = $row1['username'];
				$data['created_at'] = $row1['created_at'];
				$data['category'] = $json_metadata['category'];
				$data['permlink'] = $row1['permlink'];
				$data['thumbnail'] = $json_metadata['image'];
				$data['metatags'] = $row1['username'];
				$data['title'] = $row1['title'];
				$data['exturl'] = $json_metadata['url'];
				
				$strReturn['data_row'][] = $data;
			}
			$strReturn['status'] = 'OK';
		}
		
		
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
}
?>
