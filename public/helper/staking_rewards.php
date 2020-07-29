<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
require '../includes/config.php';

$sql_u = $conn->query("SELECT * FROM dlike_staking");

echo $count=$sql_u->num_rows;

for($i=0;$i<$count;$i++)
   {
   	eccho $name=$row_u["username"][$i]
   }


?>