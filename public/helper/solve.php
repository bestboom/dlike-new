<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


	require '../lib/solvemedialib.php';
	require '../includes/config.php';


			
		echo $_POST['ratingz'];
		echo '<br>';
		echo $_POST['likes_user'];
		echo '<br>';
		echo $_POST['rated_author'];
		echo '<br>';
		echo $_POST['rated_permlink'];


	if($_POST)
		{ 
			$solvemedia_response=solvemedia_check_answer($privkey,$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],$_POST["adcopy_response"],$hashkey);
			if(!$solvemedia_response->is_valid)
				{ echo '<div class="alert alert-danger">Captcha Enter is Incorrect!</div>'; }
			else { echo 'its ok';}
		}
?>