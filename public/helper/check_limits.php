<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/config.php';

if (isset($_POST['action']) && $_POST['action'] =='shares_limit' && isset($_POST['user']) && $_POST['user'] != '') {
//if (isset($_POST["user"])){
    $user_name = $_POST['user'];
    //$user_name = $_GET['user'];
    $return = array();
    $return['status'] = true;
    $return['message'] = '';

    $sql_post_limit = $conn->query("SELECT * FROM steemposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");
        if ($sql_post_limit->num_rows >= 5) {

            $return['status'] = false;
            $return['message'] = 'Only 5 share allowed every 24 hours.';

        } else {
            $return['status'] = true;
        }
    echo json_encode($return);die;     
}

if (isset($_POST['action']) && $_POST['action'] == 'shares_limit' && isset($_POST['url']) && $_POST['url'] != '') {
    $url = $_POST['url'];

    $sql_unique_url = $conn->query("SELECT ext_url FROM dlikeposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 300 HOUR"); 
        if ($sql_unique_url->num_rows > 0) {
            die(json_encode(['error' => true, 'message' => 'URL already shared. Can not be shared again!']));
        } else {die(json_encode(['error' => false]));}  
}
?>