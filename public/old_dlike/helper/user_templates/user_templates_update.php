<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../includes/config.php';


if (isset($_POST["steemuser"]) && isset($_POST["my_template_name"]) && isset($_POST["updated_template_content"])){
	$user = $_POST['steemuser'];
	$content = mysqli_real_escape_string($conn, $_POST['updated_template_content']);
	$template_name = mysqli_real_escape_string($conn, $_POST['my_template_name']);	

		$updat_template = "UPDATE userposttemplates SET content = '$content',  added_time = '".date("Y-m-d H:i:s")."' WHERE username = '$user' and template_name = '$template_name'";
		$update_template_query = $conn->query($updat_template);
		if ($update_template_query === TRUE) {
				die(json_encode([
			    	'error' => false,
            		'message' => 'Success', 
            		'data' => 'Template Updated'
        		]));
			} else {
				die(json_encode([
			    	'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'There is some issue'	
        		]));
			}
} else { echo 'some issue'; }

?>