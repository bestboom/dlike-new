<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../includes/config.php';


if (isset($_POST["steemuser"])){
	$user = $_POST['steemuser'];	
		
		$verify_template = "SELECT * FROM userposttemplates where username = '$user'";
			$resultverify = $conn->query($verify_template);
			if ($resultverify->num_rows > 0) {
				$rowIt = $resultverify->fetch_assoc();	
					$post_content = $rowIt['content'];
					$temp_name = $rowIt['template_name'];
					$post_time = strtotime($rowIt['added_time']);
					$post_time_ago = time_ago($post_time);
				die(json_encode([
			    	'error' => false,
            		'message' => $temp_name, 
            		'data' => $post_time_ago
        		]));
			} else {
				$msg = 'Your username and your templates are this';
				die(json_encode([
			    	'error' => true,
            		'message' => 'Sorry', 
            		'data' => $msg
            		
        		]));
			}
} else { echo 'some issue'; }

?>