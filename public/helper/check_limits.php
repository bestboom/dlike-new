<?php
require '../includes/config.php';

if (isset($_POST['action']) && $_POST['action'] =='shares_limit' && isset($_POST['user']) && $_POST['user'] != '') {
    $user_name = $_POST['user'];
    $sql_post_limit = $conn->query("SELECT * FROM dlikeposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");
        if ($sql_post_limit->num_rows >= 5) {
            die(json_encode(['error' => true, 'message' => 'Only 5 share allowed every 24 hours']));
        } else {die(json_encode(['error' => false]));}   
}

if (isset($_POST['action']) && $_POST['action'] == 'unique_post' && isset($_POST['url']) && $_POST['url'] != '') {
    $url = $_POST['url'];

    $sql_unique_url = $conn->query("SELECT ext_url FROM dlikeposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 300 HOUR"); 
        if ($sql_unique_url->num_rows > 0) {
            die(json_encode(['error' => true, 'message' => 'URL already shared. Can not be shared again!']));
        } else {die(json_encode(['error' => false]));}  
}
?>