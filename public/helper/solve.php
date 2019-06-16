
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


        $checkPost = "SELECT likes FROM PostsLikes WHERE author = '$author' and permlink = '$permlink'";
                                $result = mysqli_query($conn, $checkPost);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $old_likes = $row['likes'];

                                        $updatePost = "UPDATE PostsLikes SET likes = '$old_likes' + 1, rating = '$old_rating' + '$rating' WHERE author = '$author' and permlink = '$permlink'";
                                        $updatePostQuery = $conn->query($updatePost);
                                            if ($updatePostQuery === TRUE) {
                                                $addPost = "INSERT INTO PostsLikes (author, permlink, likes, rating, lastUpdatedDate)
													VALUES ('".$author."', '".$permlink."', '".$newLike ."', '".$rating."', '".date("Y-m-d h:m:s")."')";
                                                     $addPostQuery = $conn->query($addPost);
                                                                die(json_encode([
                                                                'error' => false,
                                                                'message' => 'Thankk You', 
                                                                'data' => 'Recomending'
                                                                ]));

                                            } else {
                                                                die(json_encode([
                                                                'error' => true,
                                                                'message' => 'Sorry', 
                                                                'data' => 'Already Recomended'
                                                                ]));
                                         
                                            }
                                        }
                                    } else {die('Some error');}
};
?>