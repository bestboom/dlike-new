<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

if (isset($_POST["rec_author"]) && isset($_POST["rec_permlink"]))
{

    $saved_ip = $_COOKIE['usertoken'];
    $rating = '5';
    $userval = $_COOKIE['dlike_username'];
    $author = $_POST['rec_author'];
    $permlink = $_POST['rec_permlink'];
    $newLike = '1';

    if (isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username'])
    {

        if ($userval == $author)
        {
            die(json_encode(['error' => true, 'message' => 'You can not recommend your own post!']));
        }

        $verifyPost = "SELECT * FROM mylikes where username = '$userval' and permlink = '$permlink' and author = '$author'";
        $resultverify = $conn->query($verifyPost);
        if ($resultverify->num_rows > 0)
        {
            die(json_encode(['error' => true, 'message' => 'You have already recommended this share!']));
        }
        else
        {
            $sqlm = "INSERT INTO mylikes (username, stars, userip, author, permlink)
					VALUES ('" . $userval . "', '" . $rating . "', '" . $ip . "', '" . $author . "', '" . $permlink . "')";

            if (mysqli_query($conn, $sqlm))
            {
                $checkPost = "SELECT author, permlink, likes FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
                $result_post = mysqli_query($conn, $checkPost);

                if ($result_post->num_rows > 0)
                {
                    while ($row = $result_post->fetch_assoc())
                    {
                        $old_likes = $row['likes'];

                        $updatePost = "UPDATE postslikes SET likes = '$old_likes' + 1 WHERE author = '$author' AND permlink = '$permlink'";
                        $updatePostQuery = $conn->query($updatePost);
                        if ($updatePostQuery === true)
                        {
                        }
                    }
                }
                else
                {
                    $addPost = "INSERT INTO postslikes (author, permlink, likes, lastUpdatedDate)
								VALUES ('" . $author . "', '" . $permlink . "', '" . $newLike . "', '" . date("Y-m-d H:i:s") . "')";
                    $addPostQuery = $conn->query($addPost);
                }

                $sql_C = "SELECT * FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
                $result_C = $conn->query($sql_C);
                if ($result_C && $result_C->num_rows > 0) 
                {
                	$row_C = $result_C->fetch_assoc();
                	$newlikes = $row_C['likes'];
                }
                else
                {
                	$newlikes  = '1';
                }
                $updated_post_income = $newlikes * $post_reward;

                die(json_encode(['error' => false, 'message' => 'Successfully Recommended!', 'data' => $newlikes]));
            }
        }
    }
    else
	{
    	die(json_encode(['error' => true, 'message' => 'You must be login with DLIKE username to recomend a share!']));
	}
}
else
{
    die(json_encode(['error' => true, 'message' => 'There is some issue. Please try later!']));
}

?>