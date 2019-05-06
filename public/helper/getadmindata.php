<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
  require '../includes/config.php';
	
  if(isset($_POST['data']) && $_POST['data'] == "users"){
	$table = "steemposts"; 
	$sql = "SELECT DISTINCT(username) as author,status FROM $table";
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
