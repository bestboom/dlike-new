<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
  require '../includes/config.php';
	
  if(isset($_POST['data']) && $_POST['data'] == "users"){
	$sql = "SELECT DISTINCT(sp.username) as author,ut.status FROM steemposts as sp left join userstatus as ut on ut.username=sp.username";
  }
  else if(isset($_POST['data']) && $_POST['data'] == "posts"){
	$sql = "SELECT sp.username as author,sp.title as title,ut.status,sp.json_metadata,sp.permlink FROM steemposts as sp left join poststatus as ut on ut.permlink=sp.permlink";
  }
  	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if(isset($_POST['data']) && $_POST['data'] == "users"){
				$dataset['username'] = $row['author'];
				$dataset['status'] = $row['status'];
				$strReturn['html_data'][] = $dataset;
			}
			else if(isset($_POST['data']) && $_POST['data'] == "posts"){
				$json_metadata = json_decode($row['json_metadata'],true);
				$dataset['title'] = $row['title'];
				$dataset['username'] = $row['author'];
				$dataset['permlink'] = $row['permlink'];
				$dataset['category'] = $json_metadata['category'];
				$dataset['status'] = $row['status'];
				$strReturn['html_data'][] = $dataset;
			}
		}
    		$strReturn['status'] = 'OK';
	} else {
		$strReturn['status'] = 'error';
	}
  	echo json_encode($strReturn);die;
?>
