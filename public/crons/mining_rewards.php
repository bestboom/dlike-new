<?php
require '../includes/config.php';

$sql_D=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    if ($sql_D->num_rows > 0) {$row_D = $sql_D->fetch_assoc();$mining_reward = $row_D["dlike_mining"];
echo $mining_reward;
echo '<br>';
$lp_percentage = '0.9';
$lp_aff_percentage = '0.1';
$lp_reward = $mining_reward * $lp_percentage;
echo $lp_reward;
echo '<br>';
$lp_aff_reward = $mining_reward * $lp_aff_percentage;
echo $lp_aff_reward;
echo '<br>';
echo $lp_aff_reward + $lp_reward;
    } else {die();}
?>