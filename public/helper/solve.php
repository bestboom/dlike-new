<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


	require '../lib/solvemedialib.php';
	require '../includes/config.php';


			
		$rating = $_POST['ratingz'];
		$userval = $_POST['likes_user'];
		$author = $_POST['rated_author'];
		$permlink =  $_POST['rated_permlink'];


	if($_POST)
		{ 
			$solvemedia_response=solvemedia_check_answer($privkey,$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],$_POST["adcopy_response"],$hashkey);
			if(!$solvemedia_response->is_valid)
				{ echo '<div class="alert alert-danger">Captcha Enter is Incorrect!</div>'; }
			else { 
				$sqlm = "INSERT INTO MyLikes (username, stars, userip, author, permlink)
						VALUES ('".$userval."', '".$rating."', '".$ip."', '".$author."', '".$permlink."')";

						if (mysqli_query($conn, $sqlm)) {
    					echo '<div class="alert alert-success">Your Upvote is Added</div>';
					} else {
    				echo "Error: " . $sqlm . "<br>" . mysqli_error($conn);
					}


			}
		}
?>