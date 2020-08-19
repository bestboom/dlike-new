<?php
require '../../includes/config.php';
function validator($data){return htmlspecialchars(strip_tags(trim($data)));}

if (isset($_POST["user"])){
    $user_name = $_POST['user'];
    $sqls = $conn->query("SELECT * FROM prousers WHERE username = '$user_name'"); 
        if ($sqls->num_rows > 0) {
            $sql1 = $conn->query("SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");
                if ($sql1->num_rows >= 3) {die(json_encode([ 'error' => true, 'message' => 'PRO users can share 3 posts in 24 hours!']));
                } else {die(json_encode(['error' => false,'message' => 'Lets Post']));}
        } else  {
            $sql2 = $conn->query("SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");
                if ($sql2->num_rows > 0) { die(json_encode(['error' => true,'message' => 'Only 1 share allowed every 24 hours. To share more become PRO!']));
                } else {die(json_encode(['error' => false, 'message' => 'Lets Post']));}
	    }   
} else { echo 'some issue'; } 
?>