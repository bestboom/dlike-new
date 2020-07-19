<?php
require '../includes/config.php';

$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = CURDATE()");


$row_C = $sql_C->fetch_assoc() or die($conn->error);
$total_upvotes = $row_C["total"]; 

$staking_percentage = '0.2';
$charity_percentage = '0.01';
$dao_percentage = '0.025';
$team_percentage = '0.04';
$foundation_percentage = '0.025';

$staking_reward = $total_upvotes * $staking_percentage;
$charity_reward = $total_upvotes * $charity_percentage;
$dao_reward = $total_upvotes * $dao_percentage;
$team_reward = $total_upvotes * $team_percentage;
$foundation_reward = $total_upvotes * $foundation_percentage;


$sql_data = $conn->query("INSERT INTO dlike_daily_rewards (yesterday_upvotes, dlike_staking, dlike_dao, dlike_charity, dlike_team, dlike_foundation, dlike_airdrop, update_time) VALUES ('".$total_upvotes."', '".$staking_reward."', '".$dao_reward."', '".$charity_reward."', '".$team_reward."', '".$foundation_reward."', '".$airdrop_reward."', '".date("Y-m-d H:i:s")."')");


?>