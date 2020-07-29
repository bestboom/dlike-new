<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

$sql_u = $conn->query("SELECT * FROM dlike_staking");

//echo $count=$sql_u->num_rows;

echo $count=mysqli_num_rows($sql_u);
$row_u = $sql_u->fetch_assoc();
for($i=0;$i<$count;$i++)
   {
   	echo $name=$row_u["username"][$i];
   }


?>