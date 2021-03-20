<?php
require '../includes/config.php';

$sql_D=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    if ($sql_D->num_rows > 0) {$row_D = $sql_D->fetch_assoc();$mining_reward = $row_D["dlike_mining"];
    echo $mining_reward;
    } else {die();}
?>