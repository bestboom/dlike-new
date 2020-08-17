<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../includes/config.php';


if (isset($_POST["steemuser"]) && isset($_POST["template_name"]) && isset($_POST["template_content"])){
	$user = $_POST['steemuser'];
	$content = mysqli_real_escape_string($conn, $_POST['template_content']);
	$template_name = mysqli_real_escape_string($conn, $_POST['template_name']);	
		
		$add_template = "INSERT INTO userposttemplates (username, template_name, content, added_time)
			VALUES ('".$user."', '".$template_name."', '".$content."', '".date("Y-m-d H:i:s")."')";
			$add_templateQuery = $conn->query($add_template);
			if ($add_templateQuery === TRUE) {

				die(json_encode([
			    	'error' => false,
            		'message' => 'Success', 
            		'data' => 'Template Saved'
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