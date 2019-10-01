<?php 
include 'google.php';
$data = json_decode(file_get_contents('php://input'));
$resp = array();
$resp['input'] = $data->text;
header('Content-type: application/json');
if(is_unique($data->text)) {
    $resp['unique'] = true;
    echo json_encode($resp);
} else {
    $resp['unique'] = false;
    echo json_encode($resp);
}
?>