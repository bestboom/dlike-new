<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../lib/solvemedialib.php';
	require '../includes/config.php';

		$saved_ip = $_COOKIE['usertoken'];	
		$rating = $_POST['ratingz'];
		$userval = $_POST['likes_user'];
		$author =  $_POST['rated_author'];
		$permlink =  $_POST['rated_permlink'];
		$newLike = '1';

		/*$checkupvote = "SELECT * from MyLikes where userip ='$saved_ip' and author = '$author' and permlink = '$permlink'";
		$result = $conn->query($checkupvote);
		if(mysqli_num_rows($result) > 0) {
			echo 'exist'; 
		} else {  echo "Doesn't exist"; }*/



	if($_POST)
		{ 
			$solvemedia_response=solvemedia_check_answer($privkey,$_SERVER["REMOTE_ADDR"],
			$_POST["adcopy_challenge"],$_POST["adcopy_response"],$hashkey);
			if(!$solvemedia_response->is_valid)
				{ echo '<div class="alert alert-danger">Captcha Enter is Incorrect!</div>'; }
			else { 
				echo '<script>$("#upvote").html("upvoting ...").prop("disabled",true);</script>';
				$sqlm = "INSERT INTO MyLikes (username, stars, userip, author, permlink)
						VALUES ('".$userval."', '".$rating."', '".$saved_ip."', '".$author."', '".$permlink."')";

						if (mysqli_query($conn, $sqlm)) {

							$checkPost = "SELECT author, permlink, likes, rating FROM PostsLikes WHERE author = '$author' and permlink = '$permlink'";
								$result = mysqli_query($conn, $checkPost);
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											$old_likes = $row['likes'];
											$old_rating = $row['rating'];
										$updatePost = "UPDATE PostsLikes SET likes = '$old_likes' + 1, rating = '$old_rating' + '$rating' WHERE author = '$author' AND permlink = '$permlink' AND lastUpdatedDate = '".date("Y-m-d h:m:s")."'";
										$updatePostQuery = $conn->query($updatePost);
											/*if ($updatePostQuery === TRUE) {
   													echo "Record updated successfully"; } else { echo "Record could not updated some error"; }*/
   										}			
    								} else {
    									/*echo "post not exists";*/
    									$addPost = "INSERT INTO PostsLikes (author, permlink, likes, rating, lastUpdatedDate)
													VALUES ('".$author."', '".$permlink."', '".$newLike ."', '".$rating."', '".date("Y-m-d h:m:s")."')";
										$addPostQuery = $conn->query($addPost);
													/*if ($addPostQuery === TRUE) {
   													echo "new Record added successfully"; } else { echo "new Record could not added"; }*/
									}

    					echo '<div class="alert alert-success">Your Recomendation is Added</div>';
    					echo '<script>document.getElementById("logsubmit").reset(); setTimeout(function(){location.reload();}, 1000);</script>';
					} else {
    				echo '<div class="alert alert-danger">There is some issue. Please Try Later!</div>';
					}
			}
		}
?>
