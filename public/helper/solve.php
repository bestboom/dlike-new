<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';


if (isset($_POST["rec_author"]) && isset($_POST["rec_permlink"])){


		$saved_ip = $_COOKIE['usertoken'];	
		$rating = '5';
		$userval = 'dlike';
		$author =  $_POST['rec_author'];
		$permlink =  $_POST['rec_permlink'];
		$newLike = '1';

		$verifyPost = "SELECT * FROM mylikes where userip = '$ip' and permlink = '$permlink' and author = '$author'";
			$resultverify = $conn->query($verifyPost);
			if ($resultverify->num_rows > 0) { 
										die(json_encode([
                                        'error' => true,
                                        'message' => 'Sorry', 
                                        'data' => 'Already Recomended'
                                         ]));
				} else {
				$sqlm = "INSERT INTO mylikes (username, stars, userip, author, permlink)
						VALUES ('".$userval."', '".$rating."', '".$ip."', '".$author."', '".$permlink."')";

						if (mysqli_query($conn, $sqlm)) {

							$checkPost = "SELECT author, permlink, likes, rating FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
								$result = mysqli_query($conn, $checkPost);
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											$old_likes = $row['likes'];
											$old_rating = $row['rating'];
										$updatePost = "UPDATE postslikes SET likes = '$old_likes' + 1, rating = '$old_rating' + '$rating' WHERE author = '$author' AND permlink = '$permlink'";
										$updatePostQuery = $conn->query($updatePost);
											if ($updatePostQuery === TRUE) {} 
   										}			
    								} else {
    									/*echo "post not exists";*/
    									$addPost = "INSERT INTO postslikes (author, permlink, likes, rating, lastUpdatedDate)
													VALUES ('".$author."', '".$permlink."', '".$newLike ."', '".$rating."', '".date("Y-m-d h:m:s")."')";
										$addPostQuery = $conn->query($addPost);
													/*if ($addPostQuery === TRUE) {
   													echo "new Record added successfully"; } else { echo "new Record could not added"; }*/
									}

    														die(json_encode([
                                                                'error' => false,
                                                                'message' => 'Thankk You', 
                                                                'data' => 'Recomending'
                                                                ]));
					} 
			}
	}	
?>