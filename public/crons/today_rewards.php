<?php
require '../includes/config.php';
$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = CURDATE()");

$row_C = $sql_C->fetch_assoc() or die($conn->error);
$total_upvotes = $row_C["total"]; 

$staking_val = $total_upvotes * $staking_reward;
$charity_val = $total_upvotes * $charity_reward;
$dao_val = $total_upvotes * $dao_reward;
$team_val = $total_upvotes * $team_reward;
$foundation_val = $total_upvotes * $foundation_reward;
$mining_val = $total_upvotes * $mining_reward;
$witness_val = $total_upvotes * $witness_reward;

$sql_W = $conn->query("SELECT * FROM dlike_daily_rewards where DATE(update_time) = CURDATE()");

if ($sql_W->num_rows > 0){
	$update_R = $conn->query("UPDATE dlike_daily_rewards SET today_upvotes = '$total_upvotes', dlike_staking = '$staking_val', dlike_dao = '$dao_val', dlike_charity = '$charity_val', dlike_team = '$team_val', dlike_foundation = '$foundation_val', dlike_mining = '$mining_val', dlike_nodes = '$witness_val', dlike_airdrop = '$airdrop_val', update_time = now() WHERE DATE(update_time) = CURDATE()");
} else {
$sql_data = $conn->query("INSERT INTO dlike_daily_rewards (today_upvotes, dlike_staking, dlike_dao, dlike_charity, dlike_team, dlike_foundation, dlike_airdrop, update_time) VALUES ('".$total_upvotes."', '".$staking_val."', '".$dao_val."', '".$charity_val."', '".$team_val."', '".$foundation_val."', '".$mining_val."', '".$witness_val."', '".$airdrop_val."', now())");
}
?>