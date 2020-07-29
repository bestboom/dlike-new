<?php
require '../includes/config.php';
$sql_u = $conn->query("SELECT * FROM dlike_staking order by amount DESC Limit 200");
if ($sql_u->num_rows > 0) {
	echo $count = mysqli_num_rows($sql_u);
	if($count < 200){$receivers = $count;}else{$receivers = '200';}
    while($row_u = $sql_u->fetch_assoc()) {
    	$users = $row_u["username"];
    	echo $receivers;
    	$sql_R=$conn->query("SELECT dlike_staking FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    	if ($sql_R->num_rows > 0) {$row_R = $sql_R->fetch_assoc();$staking_reward_amt = $row_R["dlike_staking"];
    		echo $reward = $staking_reward_amt / $receivers;
    		$sqlt = $conn->query("UPDATE dlike_staking_rewards SET reward = '$reward' WHERE username = '$users'");
    	}
	} 
}
?>