<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


	require '../lib/solvemedialib.php';
	


			
		echo $_POST['myRate1'];
		echo '<br>';
		echo $_POST['likes_user'];

require '../includes/config.php';
	if($_POST)
		{ 
			$solvemedia_response=solvemedia_check_answer($privkey,$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],$_POST["adcopy_response"],$hashkey);
			if(!$solvemedia_response->is_valid)
				{ echo 'captcha not solved'; }
			else { echo 'its ok';}
		}
?>