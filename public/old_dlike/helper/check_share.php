<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

if (isset($_POST["url"])){
    $url = $_POST['url'];

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

    $sqls = "SELECT ext_url FROM steemposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 100 HOUR"; 
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {
                $return['status'] = false;
                $return['message'] = 'URL already shared. Can not be shared again!';
        } else {
			    $return['status'] = true;
                $return['message'] = 'Unique URL';
	    } 
    echo json_encode($return);die;     
} else {die('Invalid Response on URL check. Try Later');} 
?>