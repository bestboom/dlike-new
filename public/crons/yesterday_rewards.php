<?php
require '../includes/config.php';
//$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = CURDATE()");
$sql_C = $conn->query("SELECT count(*) as total FROM dlike_upvotes where DATE(curation_time) = SUBDATE(CURRENT_DATE(), 1)");

$row_C = $sql_C->fetch_assoc() or die($conn->error);
$total_upvotes = $row_C["total"]; 


$staking_val = $total_upvotes * $staking_reward;
$charity_val = $total_upvotes * $charity_reward;
$dao_val = $total_upvotes * $dao_reward;
$team_val = $total_upvotes * $team_reward;
$foundation_val = $total_upvotes * $foundation_reward;

$sql_T = $conn->query("SELECT count(*) as yesterday_aff_rewards FROM dlike_transactions WHERE type='c' and DATE(trx_time) = SUBDATE(CURRENT_DATE(), 1)");
    if ($sql_T->num_rows > 0){$row_T = $sql_T->fetch_assoc();$total_aff_gen = $row_T["yesterday_aff_rewards"];}
    else{$total_aff_gen = '0';}

$affiliate_val = $total_aff_gen * $affiliate_reward;
$airdrop_val = ($total_upvotes - $total_aff_gen) * $airdrop_reward;

$sql_data = $conn->query("INSERT INTO dlike_rewards_history (yesterday_upvotes, dlike_staking, dlike_dao, dlike_charity, dlike_team, dlike_foundation, dlike_airdrop, data_time, update_time) VALUES ('".$total_upvotes."', '".$staking_val."', '".$dao_val."', '".$charity_val."', '".$team_val."', '".$foundation_val."', '".$airdrop_val."', '".subdate(NOW(), 1)."', now())");
?>