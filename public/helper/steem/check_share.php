<?php require '../../includes/config.php';
if (isset($_POST["url"])){
    $url = $_POST['url'];
    $sqls = "SELECT ext_url FROM steemposts WHERE ext_url = '$url' and created_at > now() - INTERVAL 100 HOUR";
    $resultAmount = $conn->query($sqls);
        if ($resultAmount->num_rows > 0) {die(json_encode(['error' => true,'message' => 'URL already shared. Can not be shared again!']));
        } else {die(json_encode(['error' => false,'message' => 'Lets Post']));}     
} else { echo 'some issue'; }?>