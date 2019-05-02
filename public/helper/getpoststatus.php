<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(0);
    	require '../includes/config.php';
	  
    $sql = "SELECT * FROM poststatus";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$strReturn['permlink'][] = $row['permlink'];
				$strReturn['status'][] = $row['status'];
			}
		} else {
			$strReturn['permlink'] = 0;
		}

  	echo json_encode($strReturn);die;
?>
