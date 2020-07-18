<?php include('head.php'); 
include('../includes/config.php'); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = CURDATE()");

//$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = SUBDATE(CURRENT_DATE(), 1)");
$row_C = $sql_C->fetch_assoc() or die($conn->error);



?>
</div>
<? echo $total_upvotes = $row_C["total"]; ?>