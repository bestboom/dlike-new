<?php
require '../includes/config.php';
$sql_u = $conn->query("SELECT * FROM dlike_staking order by amount DESC Limit 200");
if ($sql_u->num_rows > 0) {$count = mysqli_num_rows($sql_u);
	if($count < 200){$receivers = $count;}else{$receivers = '200';}
    while($row_u = $sql_u->fetch_assoc()) {$users = $row_u["username"];
    	$sql_R=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    	if ($sql_R->num_rows > 0) {$row_R = $sql_R->fetch_assoc();echo $staking_reward_amt = $row_R["dlike_staking"];$staking_paid = $row_R["staking_paid"];
            if($staking_paid !== '1'){ echo '<br>';
        		echo $reward = $staking_reward_amt / $receivers; echo '<br>';
        		$sql_st = $conn->query("SELECT reward FROM dlike_staking_rewards WHERE username = '$users'");
        		if ($sql_st->num_rows > 0) {$row_st = $sql_st->fetch_assoc(); echo $user_bal = $row_st["reward"];echo '<br>';
                    echo $new_reward = $reward + $user_bal;
        			$sqlt = $conn->query("UPDATE dlike_staking_rewards SET reward = '$new_reward' WHERE username = '$users'");
                    if($sqlt){
                        $sql_N = $conn->query("UPDATE dlike_rewards_history SET staking_paid = '1' WHERE DATE(update_time) = CURDATE()");
                    } else {die($conn->error);}
        		}
            }
    	}
	} 
}
?>