<?php
require '../includes/config.php';
if (isset($_POST['action']) && $_POST['action'] =='shares_limit' && isset($_POST['user']) && $_POST['user'] != '')
{
    $dlike_username=$_COOKIE['dlike_username'];
    $user_name = $_POST['user'];
    $url = trim(mysqli_real_escape_string($conn, $_POST["added_url"]));
    if(empty($dlike_username)){ $errors = "Seems You are not login!";}
    if($dlike_username != $user_name){ $errors = "Looks like you are not login!";}
    if(in_array($url, $restricted_urls)){ $errors = "phew... Sharing from this url is not allowed";}
    if (empty($errors)) {
        $sql_post_limit = $conn->query("SELECT * FROM dlikeposts WHERE username = '$user_name' and created_at > now() - INTERVAL 24 HOUR");
        if ($sql_post_limit->num_rows >= 5) {die(json_encode(['error' => true, 'message' => 'Phew ... You reached max daily share limit!']));}
    } else {die(json_encode(['error' => true,'message' => $errors]));}
}

if (isset($_POST['action']) && $_POST['action']=='unique_post' && isset($_POST['newurl']) && $_POST['newurl'] !='') {
    $url = trim(mysqli_real_escape_string($conn, $_POST["newurl"]));
    $sql_unique_url = $conn->query("SELECT ext_url FROM dlikeposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 300 HOUR"); 
    if ($sql_unique_url->num_rows > 0) {die(json_encode(['error' => true, 'message' => 'URL already shared. Can not be shared again!']));} 
}
?>