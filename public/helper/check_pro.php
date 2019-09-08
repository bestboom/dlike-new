<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

//if (isset($_POST["user_name"])){
//    $user_name = $_POST['user_name'];
$user_name = $_GET['user'];
    $return = array();
    $return['status'] = false;
    $return['message'] = '';

    $sqls = "SELECT * FROM prousers WHERE username = '$user_name'"; 
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {


            $sql1 = "SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR"; 
                $result1 = $conn->query($sql1);

                if ($resultAmount->num_rows >= 3) {

                    $return['status'] = false;
                    $return['message'] = 'PRO users can only share 3 posts in 24 hours!';

                }
        } else {

            $sql1 = "SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR"; 
                $result1 = $conn->query($sql1);

                if ($resultAmount->num_rows >= 1) {

                    $return['status'] = false;
                    $return['message'] = 'Only 1 share allowed every 24 hours. To share more become PRO!';

                }
	    } 
    echo json_encode($return);die;     
//} else {die('Invalid Response on share limit');} 
?>