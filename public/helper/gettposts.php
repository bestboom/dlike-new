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

if(isset($_POST['tagname']) && $_POST['tagname'] != "") {
	
	  
    	$sql = "SELECT postid FROM posttags where tagname = '".$_POST['mytag']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$postid = $row['postid'];
		}
		$sql1 = "SELECT * FROM steemposts where id IN (".$postid.")";
		$result1 = $conn->query($sql1);
		if ($result1->num_rows > 0) {
			while($row1 = $result1->fetch_assoc()) {
				
				$select_meta = "SELECT tagname FROM posttags WHERE FIND_IN_SET(".$row1['id'].", `postid`)";
				$result2 = $conn->query($select_meta);
				if ($result2->num_rows > 0) {
					$meta_array = '';
					$counter = 0;
					while($row2 = $result2->fetch_assoc()) {
						if (strpos($row2['tagname'], 'dlike') === false) {
							$meta_array .= '<a href="/tags/';
							$meta_array .= trim($row2['tagname']);
							$meta_array .= '" style="color: #1652f0;">#';
							$meta_array .= trim($row2['tagname']);
							$meta_array .= '</a>';
							if(($counter+1)<($result2->num_rows)) {
								$meta_array .= ',';
							}
							
						}
						++$counter;
					}
				}
				
				$json_metadata = json_decode($row1['json_metadata'],true);
				
				
				$data['username'] = $row1['username'];
				$data['created_at'] = time_elapsed_string($row1['created_at']);
				$data['category'] = $json_metadata['category'];
				$data['permlink'] = $row1['permlink'];
				$data['thumbnail'] = $json_metadata['image'];
				$data['metatags'] = $meta_array;
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


/*
if(isset($_POST['mytag']) && $_POST['mytag'] != "")
{
	$tag = $_POST['mytag'];
	$json = json_decode($_POST["mytag"]);
	/*
		if(!empty($json)) { $strReturn['status'] = 'OK'; $strReturn['tagr'] = $tag; } else {$strReturn['status'] = 'error'; $strReturn['tagr'] = $tag;}
	
  	$sql = "SELECT postid FROM posttags where tagname = '$tag'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
    	{
			$row = $result->fetch_all();
      		echo json_encode($row);
			$postid = $row['postid'];
			$strReturn['tagrs'] = $postid;
			$posts = explode(',', $postid);
			$tag_posts = array_map(function(){ return '?'; }, $posts);
      		$idStr = implode(',', $postid);

			$sqlz = "SELECT * FROM steemposts where id IN ('$idStr') order by created_at DESC";
			//$sqlz = "SELECT * FROM steemposts where `id` IN ('". implode(',', array_map('intval', $postid)) ."') order by created_at DESC";
			$resultz = $conn->query($sqlz);

			if ($resultz->num_rows > 0)
      		{
				while($rowz = $resultz->fetch_assoc())
        		{
					$json_metadata = json_decode($rowz['json_metadata'],true);
					$data['username'] = $rowz['username'];
					$data['permlink'] = $rowz['permlink'];
					$data['title'] = $rowz['title'];
					$data['category'] = $json_metadata['category'];
					$data['created_at'] = timeago($rowz['created_at']);
					$data['imgsrc'] = $json_metadata['image'];

					array_push($strReturn['data_row'], $data);
				}
				$strReturn['status'] = 'OK';
			}
			else
      		{
				$strReturn['status'] = 'posts not coming';
				$strReturn['tagrs'] = $conn->error;
			}
		} else
    	{
		    $strReturn['status'] = 'error';
		}
  	echo json_encode($strReturn);die;
	} */

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
