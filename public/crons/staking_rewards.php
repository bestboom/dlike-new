<?php
require '../includes/config.php';

$sql_D=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    if ($sql_D->num_rows > 0) {$row_D = $sql_D->fetch_assoc();$staking_paid = $row_D["staking_paid"];
        if($staking_paid !== '1'){
            $sql_u = $conn->query("SELECT * FROM dlike_staking order by amount DESC Limit 200");
            if ($sql_u->num_rows > 0) {
                while($row_u = $sql_u->fetch_assoc()) {$users = $row_u["username"];
                    $count = mysqli_num_rows($sql_u);if($count < 200){$receivers = $count;}else{$receivers = '200';}
                    $sql_R=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
                    if ($sql_R->num_rows > 0) {$row_R = $sql_R->fetch_assoc();$staking_reward_amt = $row_R["dlike_staking"];$reward = $staking_reward_amt / $receivers;
                        $sql_st = $conn->query("SELECT * FROM dlike_staking_rewards WHERE username = '$users'");
                        if ($sql_st->num_rows > 0) {$row_st = $sql_st->fetch_assoc(); $user_bal = $row_st["reward"];
                            $new_reward = $reward + $user_bal;
                            $sqlt = $conn->query("UPDATE dlike_staking_rewards SET reward = '$new_reward' WHERE username = '$users'");
                            $sql_N = $conn->query("UPDATE dlike_rewards_history SET staking_paid = '1' WHERE DATE(update_time) = CURDATE()");
                        }
                    }
                } 
            }
        }else{die();}
    } else {die();}
?>