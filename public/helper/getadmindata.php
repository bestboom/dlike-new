<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
  require '../includes/config.php';
	
  if(isset($_POST['data']) && $_POST['data'] == "users"){
	$sql = "SELECT DISTINCT(sp.username) as author,ut.status FROM steemposts as sp left join userstatus as ut on ut.username=sp.username";
  }
  	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if(isset($_POST['data']) && $_POST['data'] == "users"){
				$dataset['username'] = $row['author'];
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
