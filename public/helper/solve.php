<?php require 'includes/config.php';
	require 'lib/solvemedialib.php';
	if($_POST)
		echo $_POST['myRate'];
		echo $_POST['likes_user'];
		{ $solvemedia_response=solvemedia_check_answer($privkey,$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],$_POST["adcopy_response"],$hashkey);
			if(!$solvemedia_response->is_valid)
				{ echo 'looks good'; }
			else { echo 'bad';}
		}
?>