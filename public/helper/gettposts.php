<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
require '../includes/config.php';

function timeago($date) {
   $timestamp = strtotime($date);

   $strTime = array("second", "minute", "hour", "day", "month", "year");
   $length = array("60","60","24","30","12","10");

   $currentTime = time();
   if($currentTime >= $timestamp) {
		$diff     = time()- $timestamp;
		for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
		$diff = $diff / $length[$i];
		}

		$diff = round($diff);
		$addif = "";
		if($diff>1) {
			$addif = "s";
		}
		return $diff . " " . $strTime[$i] . $addif." ago ";
   }
}

if(isset($_POST['mytag']) && $_POST['mytag'] != "") {
	  	$mytag = $_POST['mytag'];

		$sql1 = "SELECT * FROM steemposts where post_tags LIKE CONCAT('%' , '$mytag', '%') ORDER BY created_at DESC Limit 48";
		$result1 = $conn->query($sql1);
			if ($result1->num_rows > 0) {
				
				while($row1 = $result1->fetch_assoc()) 
				{
					$data['username'] = $row1['username'];
					$data['permlink'] = $row1['permlink'];
					$strReturn['data_row'][] = $data;
				}
				$strReturn['status'] = 'OK';	
			} else {
				$strReturn['status'] = $conn->error;
			}
			echo json_encode($strReturn);die;
}			

if(isset($_REQUEST['catname']) && $_REQUEST['catname'] != "") {

	$sql1 = "SELECT * FROM steemposts where parent_ctegory = '".$_REQUEST['catname']."' ORDER BY created_at DESC LIMIT 48";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) 
		{
			//$json_metadata = json_decode($row1['json_metadata'],true);
			//if(strtolower($json_metadata['category']) == strtolower($_REQUEST['catname'])) {

				$data['username'] = $row1['username'];
				$data['permlink'] = $row1['permlink'];
				$strReturn['data_row'][] = $data;
			//}
		}
		$strReturn['status'] = 'OK';
	}
	else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
}
$conn->close();
?>