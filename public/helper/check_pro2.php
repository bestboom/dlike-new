<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST["user"])){
    $user_name = $_POST['user'];
    //$user_name = $_GET['user'];

    $sqls = "SELECT * FROM prousers WHERE username = '$user_name'"; 
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {

            $sql1 = "SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR"; 
                $result1 = $conn->query($sql1);

                if ($result1->num_rows >= 3) {

                    die(json_encode([
                        'error' => true,
                        'message' => 'Can not post',
                        'data' => 'PRO users can share 3 posts in 24 hours!'
                    ]));

                } else {
                    die(json_encode([
                        'error' => false,
                        'message' => 'Lets Post'
                    ]));
                }
        } else  {

            $sql2 = "SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR"; 
                $result2 = $conn->query($sql2);

                if ($result2->num_rows > 0) {

                    die(json_encode([
                        'error' => true,
                        'message' => 'Can not post',
                        'data' => 'Only 1 share allowed every 24 hours. To share more become PRO!'
                    ]));

                } else {
                    die(json_encode([
                        'error' => false,
                        'message' => 'Lets Post'
                    ]));
                }
	    }   
} else { echo 'some issue'; } 
?>