<?php require '../includes/config.php';
if (isset($_POST["ath"]) && isset($_POST["plink"]))
{   $saved_ip = $_COOKIE['usertoken'];$userval = $_COOKIE['dlike_username'];$author = $_POST['ath'];$permlink = $_POST['plink'];$newLike = '1';

    if (isset($_COOKIE['dlike_username']) || $_COOKIE['dlike_username'])
    {
        if ($userval == $author){die(json_encode(['error' => true, 'message' => 'You can not recommend your own post!']));}

        $check_unique_like = $conn->query("SELECT * FROM mylikes where username = '$userval' and permlink = '$permlink' and author = '$author'");
        if ($check_unique_like->num_rows > 0){die(json_encode(['done' => true, 'message' => 'You have already recommended this share!']));} 

        $check_max_likes = $conn->query("SELECT * FROM mylikes where username = '$userval' and  like_time > now() - INTERVAL 24 HOUR");
        if ($check_max_likes->num_rows >= 29){die(json_encode(['error' => true, 'message' => 'You reached maximum daily likes limit']));}

        $check_bot_likes = $conn->query("SELECT * FROM dlike_upvotes where ip_addr = '$thisip' and  curation_time > now() - INTERVAL 24 HOUR");
        if ($check_bot_likes->num_rows >= 30){die(json_encode(['error' => true, 'message' => 'Phew ...You can not do more likes!']));}

        $check_time_likes = $conn->query("SELECT like_time FROM mylikes where username = '$userval' and TIMESTAMPDIFF(SECOND, like_time, now()) <= 17");
        if ($check_time_likes->num_rows > 0){die(json_encode(['error' => true, 'message' => 'Are you a Robot? Be patient while recomending posts to community with your Likes!']));}

        $sql_T = $conn->query("SELECT * FROM dlikeposts WHERE username='$author' and permlink='$permlink' and created_at < now() - INTERVAL 42 HOUR");
        //$count_T=$sql_T->num_rows;
        //if (empty($count)){die(json_encode(['error' => true, 'message' => 'Post Does not Exist!']));}
        if ($sql_T && $sql_T->num_rows > 0){die(json_encode(['error' => true, 'message' => 'Curation of old posts not allowed!'])); }

        else {
            $sqlm = $conn->query("INSERT INTO mylikes (username, userip, author, permlink, like_time ) VALUES ('" . $userval . "', '".$ip."', '" .$author. "', '" .$permlink. "', now())");
            if ($sqlm)
            {
                $check_auth_bal = $conn->query("SELECT amount FROM dlike_wallet where username = '$author'");
                $row_auth = $check_auth_bal->fetch_assoc();
                $auth_bal = $row_auth['amount'];
                $update_auth_wallet = $conn->query("UPDATE dlike_wallet SET amount = '$auth_bal' + '$author_reward' WHERE username = '$author'");
                    if ($update_auth_wallet === TRUE) { $type = 'a';
                        $sql_auth = $conn->query("INSERT INTO dlike_transactions (username, amount, type, post_author, reason, trx_time) VALUES ('".$author."', '".$author_reward."', '".$type."', '".$author."', '".$permlink."', now())");
                    }

                $check_cur_bal = $conn->query("SELECT amount FROM dlike_wallet where username = '$userval'");
                $row_cur = $check_cur_bal->fetch_assoc();
                $cur_bal = $row_cur['amount'];
                $update_cur_wallet = $conn->query("UPDATE dlike_wallet SET amount = '$cur_bal' + '$curator_reward' WHERE username = '$userval'");
                    if ($update_cur_wallet === TRUE) { $type = 'b';
                        $sql_cur = $conn->query("INSERT INTO dlike_transactions (username, amount, type, post_author, reason, trx_time) VALUES ('".$userval."', '".$curator_reward."', '".$type."', '".$author."', '".$permlink."', now())");
                    }

                $check_refer_by = "SELECT refer_by FROM dlikeaccounts where username = '$author'";
                $result_refer_by = $conn->query($check_refer_by);
                $row_ref = $result_refer_by->fetch_assoc();
                $referrer = $row_ref['refer_by'];
                if(empty($referrer) || $referrer == 'dlike') { $airdroper = 'dlike_airdrop';
                    $airdrop_bal = $conn->query("SELECT amount FROM dlike_wallet where username = '$airdroper'");
                    $row_adrop = $airdrop_bal->fetch_assoc();$adrop_bal = $row_adrop['amount'];
                    $update_adrop_wallet = $conn->query("UPDATE dlike_wallet SET amount = '$adrop_bal' + '$airdrop_reward' WHERE username = '$airdroper'");
                        if ($update_adrop_wallet === TRUE) { $link = $author.'/'.$permlink;
                            $sql_adrop = $conn->query("INSERT INTO dlike_airdrop_history (to_user, amount, reason, trx_time) VALUES ('dlike', '".$airdrop_reward."', '".$link."', now())");
                        }

                } else {
                    $check_ref_bal = $conn->query("SELECT amount FROM dlike_wallet where username = '$referrer'");
                    $row_ref = $check_ref_bal->fetch_assoc();
                    $ref_bal = $row_ref['amount'];
                    $update_ref_wallet = $conn->query("UPDATE dlike_wallet SET amount = '$ref_bal' + '$affiliate_reward' WHERE username = '$referrer'");
                        if ($update_ref_wallet === TRUE) { 
                            $type = 'c';
                            $sql_ref = $conn->query("INSERT INTO dlike_transactions (username, amount, type, post_author, reason, trx_time) VALUES ('".$referrer."', '".$affiliate_reward."', '".$type."', '".$author."', '".$permlink."', now())");
                        }
                }

                $reward_status = '0';
                $sql_upvotes = $conn->query("INSERT INTO dlike_upvotes (curator, author, permlink, ip_addr, status) VALUES ('".$userval."', '".$author."', '".$permlink."', '".$thisip."', '".$reward_status."')");

                $checkPost = $conn->query("SELECT author, permlink, likes FROM postslikes WHERE author = '$author' and permlink = '$permlink'");
                if ($checkPost->num_rows > 0)
                { while ($row = $checkPost->fetch_assoc())
                    { $old_likes = $row['likes'];
                        $updatePost = $conn->query("UPDATE postslikes SET likes = '$old_likes' + 1 WHERE author = '$author' AND permlink = '$permlink'");
                    }
                } else {
                    $addPost = $conn->query("INSERT INTO postslikes (author, permlink, likes, update_time) VALUES ('".$author."', '".$permlink."', '".$newLike."', now())");
                }

                die(json_encode(['error' => false, 'message' => 'Successfully Recommended!', 'post_income' => $post_reward]));
            }
        }
    } else { die(json_encode(['error' => true, 'message' => 'You must be login with DLIKE username to recomend a share!']));
	}
} else { die(json_encode(['error' => true, 'message' => 'There is some issue. Please try later!']));}
?>