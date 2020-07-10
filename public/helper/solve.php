<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

if (isset($_POST["ath"]) && isset($_POST["plink"]))
{

    $saved_ip = $_COOKIE['usertoken'];
    $rating = '5';
    $userval = $_COOKIE['dlike_username'];
    $author = $_POST['ath'];
    $permlink = $_POST['plink'];
    $newLike = '1';

    if (isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username'])
    {
        if ($userval == $author)
        {die(json_encode(['error' => true, 'message' => 'You can not recommend your own post!']));}

        $check_unique_like = $conn->query("SELECT * FROM mylikes where username = '$userval' and permlink = '$permlink' and author = '$author'");
        if ($check_unique_like->num_rows > 0){die(json_encode(['error' => true, 'message' => 'You have already recommended this share!']));} 

        $check_max_likes = $conn->query("SELECT * FROM mylikes where username = '$userval' and  like_time > now() - INTERVAL 24 HOUR");
        if ($check_max_likes->num_rows >= 50){die(json_encode(['error' => true, 'message' => 'You reached maximum daily likes limit']));}

        else {
            $sqlm = "INSERT INTO mylikes (username, stars, userip, author, permlink)
					VALUES ('" . $userval . "', '" . $rating . "', '" . $ip . "', '" . $author . "', '" . $permlink . "')";
            if (mysqli_query($conn, $sqlm))
            {

                $check_auth_bal = "SELECT amount FROM dlike_wallet where username = '$author'";
                $auth_bal_amount = $conn->query($check_auth_bal);
                $row_auth = $auth_bal_amount->fetch_assoc();
                $auth_bal = $row_auth['amount'];
                $update_auth_wallet = "UPDATE dlike_wallet SET amount = '$auth_bal' + '$author_reward' WHERE username = '$author'";
                $update_auth_wallet_query = $conn->query($update_auth_wallet);
                    if ($update_auth_wallet_query === TRUE) { 
                        $type = 'a';
                        $sql_auth = "INSERT INTO dlike_transactions (username, amount, type, reason, trx_time)
                            VALUES ('".$author."', '".$author_reward."', '".$type."', '".$permlink."', '".date("Y-m-d H:i:s")."')";
                        $add_auth_trx = $conn->query($sql_auth);
                    }


                $check_cur_bal = "SELECT amount FROM dlike_wallet where username = '$userval'";
                $cur_bal_amount = $conn->query($check_cur_bal);
                $row_cur = $cur_bal_amount->fetch_assoc();
                $cur_bal = $row_cur['amount'];
                $update_cur_wallet = "UPDATE dlike_wallet SET amount = '$cur_bal' + '$curator_reward' WHERE username = '$userval'";
                $update_cur_wallet_query = $conn->query($update_cur_wallet);
                    if ($update_cur_wallet_query === TRUE) { 
                        $type = 'b';
                        $sql_cur = "INSERT INTO dlike_transactions (username, amount, type, reason, trx_time)
                            VALUES ('".$userval."', '".$curator_reward."', '".$type."', '".$permlink."', '".date("Y-m-d H:i:s")."')";
                        $add_cur_trx = $conn->query($sql_cur);
                    }

                $check_refer_by = "SELECT refer_by FROM dlikeaccounts where username = '$author'";
                $result_refer_by = $conn->query($check_refer_by);
                $row_ref = $result_refer_by->fetch_assoc();
                $referrer = $row_ref['refer_by'];
                if(empty($referrer) || $referrer == 'dlike') {

                } else {
                    $check_ref_bal = "SELECT amount FROM dlike_wallet where username = '$referrer'";
                    $cur_ref_amount = $conn->query($check_ref_bal);
                    $row_ref = $cur_ref_amount->fetch_assoc();
                    $ref_bal = $row_ref['amount'];
                    $update_ref_wallet = $conn->query("UPDATE dlike_wallet SET amount = '$ref_bal' + '$affiliate_reward' WHERE username = '$referrer'");
                        if ($update_ref_wallet === TRUE) { 
                            $type = 'c';
                            $sql_ref = $conn->query("INSERT INTO dlike_transactions (username, amount, type, reason, trx_time) VALUES ('".$referrer."', '".$affiliate_reward."', '".$type."', '".$permlink."', '".date("Y-m-d H:i:s")."')");
                        }
                }
                

                $reward_status = '0';
                $sql_upvotes = $conn->query("INSERT INTO dlike_upvotes (curator, author, permlink, ip_addr, status, curation_time) VALUES ('".$userval."', '".$author."', '".$permlink."', '".$thisip."', '".$reward_status."', '".date("Y-m-d H:i:s")."')");

                $checkPost = "SELECT author, permlink, likes FROM postslikes WHERE author = '$author' and permlink = '$permlink'";
                $result_post = $conn->query($checkPost);
                if ($result_post->num_rows > 0)
                {
                    while ($row = $result_post->fetch_assoc())
                    {
                        $old_likes = $row['likes'];
                        $updatePost = "UPDATE postslikes SET likes = '$old_likes' + 1 WHERE author = '$author' AND permlink = '$permlink'";
                        $updatePostQuery = $conn->query($updatePost);
                    }
                } else {
                    $addPost = "INSERT INTO postslikes (author, permlink, likes, lastUpdatedDate)
					       VALUES ('" . $author . "', '" . $permlink . "', '" . $newLike . "', '" . date("Y-m-d H:i:s") . "')";
                    $addPostQuery = $conn->query($addPost);
                }

                die(json_encode(['error' => false, 'message' => 'Successfully Recommended!', 'post_income' => $post_reward]));
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