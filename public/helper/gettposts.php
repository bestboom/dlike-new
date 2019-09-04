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
//$strReturn = [];	
if(isset($_POST['mytag']) && $_POST['mytag'] != "") {
	$tag = $_POST['mytag'];
	/*$json = json_decode($_POST["mytag"]);

		if(!empty($json)) { $strReturn['status'] = 'OK'; $strReturn['tagr'] = $tag; } else {$strReturn['status'] = 'error'; $strReturn['tagr'] = $tag;}
	*/
    	$sql = "SELECT postid FROM posttags where tagname = '$tag'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_assoc()) 
			{
				$postid = $row['postid'];
			}	
				//$sql1 = "SELECT * FROM steemposts where id IN (".$postid.") order by created_at DESC";
				$sqlz = "SELECT * FROM steemposts where id IN ('.$postid.')";
				$resultz = $conn->query($sqlz);

				$rowme = $resultz->num_rows;

				//$strReturn['status'] = 'OK';
				//$strReturn['tagrs'] = $rowme;

				if ($resultz->num_rows > 0) {
				
				//$strReturn['tagrs'] = $postid;

					/*
					while($row1 = $result1->fetch_assoc()) {
					    
						$json_metadata = json_decode($row1['json_metadata'],true);
						$data['username'] = $row1['username'];
						$data['permlink'] = $row1['permlink'];
						$data['title'] = $row1['title'];
						$data['category'] = $json_metadata['category'];
						$data['created_at'] = timeago($row1['created_at']);
						$data['imgsrc'] = $json_metadata['image'];

						$strReturn['data_row'][] = $data;
					}
					//$strReturn['status'] = 'OK';*/
				} 
				else { 
					$strReturn['status'] = 'posts not coming';
					$strReturn['tagrs'] = $conn->error;
				}
			 	
		} else {
		$strReturn['status'] = 'error';
		} 
  	echo json_encode($strReturn);die;
}

if(isset($_REQUEST['catname']) && $_REQUEST['catname'] != "") {

	
	$sql1 = "SELECT json_metadata,username,permlink,created_at FROM steemposts where parent_ctegory = '".$_REQUEST['catname']."' ORDER BY id DESC LIMIT 48";
	$result1 = $conn->query($sql1);
	if ($result1->num_rows > 0) {
		while($row1 = $result1->fetch_assoc()) {
			
			$json_metadata = json_decode($row1['json_metadata'],true);
			if(strtolower($json_metadata['category']) == strtolower($_REQUEST['catname'])) {
				
				$data['username'] = $row1['username'];
				$data['permlink'] = $row1['permlink'];
				$data['title'] = $row1['title'];
				$data['category'] = $json_metadata['category'];
				$data['imgsrc'] = $json_metadata['image'];
				
				$data['created_at'] = timeago($row1['created_at']);
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
$conn->close();
?>
