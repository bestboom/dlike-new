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


		$sqlm = "INSERT INTO MyLikes (username, stars, userip, author, permlink)
						VALUES ('".$userval."', '".$rating."', '".$saved_ip."', '".$author."', '".$permlink."')";

						if (mysqli_query($conn, $sqlm)) {

							$checkPost = "SELECT * FROM PostsLikes WHERE author = '$author' and permlink = '$permlink'";
                                $result = mysqli_query($conn, $checkPost);
                                    if ($result->num_rows > 0) {
                                        $row = $result->fetch_assoc();
                                            $old_likes = $row['likes'];


                                            $updatePost = "UPDATE PostsLikes SET likes = '$old_likes' + 1  WHERE author = '$author' and permlink = '$permlink'";
                                        	$updatePostQuery = $conn->query($updatePost);

                                            if ($updatePostQuery === TRUE) {
                                                                die(json_encode([
                                                                'error' => false,
                                                                'message' => 'Thankk You', 
                                                                'data' => 'Recomnding'
                                                                ]));

                                            } else {
                                                                die(json_encode([
                                                                'error' => true,
                                                                'message' => 'Sorry', 
                                                                'data' => 'SOme ISSUE'
                                                                ]));
                                         
                                            }
                                        }
                                    } else {die('Some error');}
};

?>
