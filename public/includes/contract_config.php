<?php
include_once '../vendor/autoload.php';
define('CONTRACT_ADDRESS','4154a4cb3c2fbbbf41038e0ad715558b574c9c0f34');
//define('TRONGRID_V2_EVENT_API_URL','https://v2.api.trongrid.io/event/contract/');
//define('API_URL','https://api.tronscan.org/api/');
define('TRONSCAN_URL','https://tronscan.org/#/transaction/');
define('SIGNER','TJLwvVtwwHVkKNcMrmtzsr8NgyXRygMuWA');
$signer_pk = getenv("SIGNER_PK");
define('SIGNER_PK', $signer_pk);
//$event_uel = EVENT_API_URL.'contract/'.CONTRACT_ADDRESS;

use IEXBase\TronAPI\Tron;
$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

try {$tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {exit($e->getMessage());}

define('ABI','[{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":true,"inputs":[],"name":"PowerDownPeriod","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"receivers","type":"address[]"},{"name":"amounts","type":"uint256[]"}],"name":"payToken","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"stakePool","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"Membership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"getReward","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"_address","type":"address"}],"name":"isUnstaking","outputs":[{"name":"","type":"uint256"},{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"signer","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"_time","type":"uint256"}],"name":"setPowerDownPeriod","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"manualwithdrawTron","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_value","type":"uint256"}],"name":"burn","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"rewardBlanaces","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"claimStakeOut","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"changeSafeguardStatus","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"tokenBalances","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"stakeIn","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_signer","type":"address"}],"name":"setSigner","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"decrease_allowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"user","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"Boost","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"stakeOut","outputs":[{"name":"","type":"uint256"},{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"_from","type":"address"},{"name":"_value","type":"uint256"}],"name":"burnFrom","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"increase_allowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"TotalPendingUnstakeamount","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"isOwner","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_add","type":"address"}],"name":"checkStake","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"receivers","type":"address[]"},{"name":"amounts","type":"uint256[]"}],"name":"payReward","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"pure","type":"function"},{"constant":false,"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","outputs":[{"name":"success","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"frozenAccount","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"safeguard","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"checkPowerDownPeriod","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"_add","type":"address"}],"name":"checkUnstake","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"_amount","type":"uint256"}],"name":"getToken","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"target","type":"address"},{"name":"freeze","type":"bool"}],"name":"freezeAccount","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"","type":"address"}],"name":"unstakePool","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"TotalStakedAmount","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"tokenAmount","type":"uint256"}],"name":"manualWithdrawTokens","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"payable":true,"stateMutability":"payable","type":"fallback"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Burn","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"name":"target","type":"address"},{"indexed":false,"name":"frozen","type":"bool"}],"name":"FrozenAccounts","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"indexed":false,"name":"time","type":"uint256"}],"name":"mintcommonReward","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"indexed":false,"name":"time","type":"uint256"}],"name":"mintstakeReward","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"indexed":false,"name":"time","type":"uint256"}],"name":"putstake","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"indexed":false,"name":"time","type":"uint256"}],"name":"withdrawStake","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"indexed":false,"name":"time","type":"uint256"}],"name":"unstakeEv","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"}]'); 

//define('ABI','[{"outputs":[{"type":"string"}],"constant":true,"name":"name","stateMutability":"Pure","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"PowerDownPeriod","stateMutability":"View","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"receivers","type":"address[]"},{"name":"amounts","type":"uint256[]"}],"name":"payToken","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"stakePool","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"totalSupply","stateMutability":"View","type":"Function"},{"inputs":[{"name":"_amount","type":"uint256"}],"name":"getReward","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"},{"type":"uint256"},{"type":"bool"}],"constant":true,"inputs":[{"name":"_address","type":"address"}],"name":"isUnstaking","stateMutability":"View","type":"Function"},{"outputs":[{"type":"address"}],"constant":true,"name":"signer","stateMutability":"View","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"decimals","stateMutability":"Pure","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"_time","type":"uint256"}],"name":"setPowerDownPeriod","stateMutability":"Nonpayable","type":"Function"},{"name":"manualwithdrawTron","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_value","type":"uint256"}],"name":"burn","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"rewardBlanaces","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"_amount","type":"uint256"}],"name":"claimStakeOut","stateMutability":"Nonpayable","type":"Function"},{"name":"changeSafeguardStatus","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"tokenBalances","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"_amount","type":"uint256"}],"name":"stakeIn","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"_signer","type":"address"}],"name":"setSigner","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"decrease_allowance","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"user","type":"address"}],"name":"balanceOf","stateMutability":"View","type":"Function"},{"name":"renounceOwnership","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"},{"type":"bool"}],"inputs":[{"name":"_amount","type":"uint256"}],"name":"stakeOut","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_from","type":"address"},{"name":"_value","type":"uint256"}],"name":"burnFrom","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"increase_allowance","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"TotalPendingUnstakeamount","stateMutability":"View","type":"Function"},{"outputs":[{"type":"address"}],"constant":true,"name":"owner","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"isOwner","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"_add","type":"address"}],"name":"checkStake","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"receivers","type":"address[]"},{"name":"amounts","type":"uint256[]"}],"name":"payReward","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"string"}],"constant":true,"name":"symbol","stateMutability":"Pure","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"inputs":[{"type":"address"}],"name":"frozenAccount","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"safeguard","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"checkPowerDownPeriod","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"_add","type":"address"}],"name":"checkUnstake","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","stateMutability":"View","type":"Function"},{"inputs":[{"name":"_amount","type":"uint256"}],"name":"getToken","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"target","type":"address"},{"name":"freeze","type":"bool"}],"name":"freezeAccount","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"unstakePool","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"TotalStakedAmount","stateMutability":"View","type":"Function"},{"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"tokenAmount","type":"uint256"}],"name":"manualWithdrawTokens","stateMutability":"Nonpayable","type":"Function"},{"stateMutability":"Nonpayable","type":"Constructor"},{"payable":true,"stateMutability":"Payable","type":"Fallback"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"Transfer","type":"Event"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"name":"value","type":"uint256"}],"name":"Burn","type":"Event"},{"inputs":[{"name":"target","type":"address"},{"name":"frozen","type":"bool"}],"name":"FrozenAccounts","type":"Event"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"Approval","type":"Event"},{"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"name":"time","type":"uint256"}],"name":"mintcommonReward","type":"Event"},{"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"name":"time","type":"uint256"}],"name":"mintstakeReward","type":"Event"},{"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"name":"time","type":"uint256"}],"name":"putstake","type":"Event"},{"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"name":"time","type":"uint256"}],"name":"withdrawStake","type":"Event"},{"inputs":[{"indexed":true,"name":"user","type":"address"},{"indexed":true,"name":"amount","type":"uint256"},{"name":"time","type":"uint256"}],"name":"unstakeEv","type":"Event"},{"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"Event"}]'); 
?>