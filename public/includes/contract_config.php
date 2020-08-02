<?php
include_once '../vendor/autoload.php';
define('CONTRACT_ADDRESS','412189e1a476caa562c11641a6d7c78044cd339835');
define('CONTRACT_ADDRESS_HEX','41d1b0bb8d4d17d39153f7e0c536502ec8756a86fe');
define('TRONGRID_V2_EVENT_API_URL','https://v2.api.shasta.trongrid.io/event/contract/');
define('API_URL','https://api.shasta.tronscan.org/api/');
define('TRONSCAN_URL','https://shasta.tronscan.org/#/transaction/');
define('SIGNER','TBi9uevWfsKtVUup7GDEeGDy3GHcu6UiPF');
define('SIGNER_PK','AD3675543AFE55B1FA10B318E4E028DAD74D2105A2FCE4827B4EB2DBC3AE8A7E');

//$event_uel = EVENT_API_URL.'contract/'.CONTRACT_ADDRESS;

use IEXBase\TronAPI\Tron;

$fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
$solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');
$eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.shasta.trongrid.io');

try {
    $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
} catch (\IEXBase\TronAPI\Exception\TronException $e) {
    exit($e->getMessage());
}

define('ABI','[{"inputs":[{"name":"newSellPrice","type":"uint256"},{"name":"newBuyPrice","type":"uint256"}],"name":"setPrices","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"string"}],"constant":true,"name":"name","stateMutability":"Pure","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_spender","type":"address"},{"name":"_value","type":"uint256"}],"name":"approve","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"stakePool","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"passiveAirdropTokensAllocation","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"inputs":[{"name":"_address","type":"address"}],"name":"isContract","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"totalSupply","stateMutability":"View","type":"Function"},{"outputs":[{"type":"address"}],"constant":true,"name":"signer","stateMutability":"View","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_from","type":"address"},{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transferFrom","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"decimals","stateMutability":"Pure","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"dividentPool","stateMutability":"View","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_value","type":"uint256"}],"name":"burn","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"payable":true,"name":"claimPassiveAirdrop","stateMutability":"Payable","type":"Function"},{"inputs":[{"name":"userAddress","type":"address"}],"name":"whitelistUser","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"sellPrice","stateMutability":"View","type":"Function"},{"name":"changeSafeguardStatus","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"passiveAirdropTokensAllocation_","type":"uint256"},{"name":"airdropAmount_","type":"uint256"}],"name":"startNewPassiveAirDrop","stateMutability":"Nonpayable","type":"Function"},{"name":"manualWithdrawEther","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"amount","type":"uint256"}],"name":"sellTokens","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"passiveAirdropTokensSold","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"decrease_allowance","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"user","type":"address"}],"name":"balanceOf","stateMutability":"View","type":"Function"},{"name":"renounceOwnership","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"userAddresses","type":"address[]"}],"name":"whitelistManyUsers","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"target","type":"address"},{"name":"mintedAmount","type":"uint256"}],"name":"mintToken","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_from","type":"address"},{"name":"_value","type":"uint256"}],"name":"burnFrom","stateMutability":"Nonpayable","type":"Function"},{"name":"changeWhitelistingStatus","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"increase_allowance","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"address"}],"constant":true,"name":"stakeAddress","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"buyPrice","stateMutability":"View","type":"Function"},{"outputs":[{"type":"address"}],"constant":true,"name":"owner","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"isOwner","stateMutability":"View","type":"Function"},{"inputs":[{"name":"newAmount","type":"uint256"}],"name":"changePassiveAirdropAmount","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"newFee","type":"uint256"}],"name":"updateAirdropFee","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"string"}],"constant":true,"name":"symbol","stateMutability":"Pure","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"airdropFee","stateMutability":"View","type":"Function"},{"outputs":[{"name":"success","type":"bool"}],"inputs":[{"name":"_to","type":"address"},{"name":"_value","type":"uint256"}],"name":"transfer","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"inputs":[{"name":"recipients","type":"address[]"},{"name":"tokenAmount","type":"uint256[]"}],"name":"airdropACTIVE","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"_signer","type":"address"}],"name":"changeSigner","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"inputs":[{"type":"address"}],"name":"frozenAccount","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"safeguard","stateMutability":"View","type":"Function"},{"name":"stopPassiveAirDropCompletely","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"passiveAirdropStatus","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"name":"whitelistingStatus","stateMutability":"View","type":"Function"},{"name":"withdrawStake","stateMutability":"Nonpayable","type":"Function"},{"payable":true,"name":"buyTokens","stateMutability":"Payable","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"inputs":[{"type":"uint256"},{"type":"address"}],"name":"airdropClaimed","stateMutability":"View","type":"Function"},{"outputs":[{"type":"bool"}],"constant":true,"inputs":[{"type":"address"}],"name":"whitelisted","stateMutability":"View","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","stateMutability":"View","type":"Function"},{"inputs":[{"name":"target","type":"address"},{"name":"freeze","type":"bool"}],"name":"freezeAccount","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"_amount","type":"uint256"}],"name":"addStake","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"inputs":[{"type":"address"}],"name":"stakeDuration","stateMutability":"View","type":"Function"},{"inputs":[{"name":"newOwner","type":"address"}],"name":"transferOwnership","stateMutability":"Nonpayable","type":"Function"},{"inputs":[{"name":"tokenAmount","type":"uint256"}],"name":"manualWithdrawTokens","stateMutability":"Nonpayable","type":"Function"},{"outputs":[{"type":"uint256"}],"constant":true,"name":"airdropAmount","stateMutability":"View","type":"Function"},{"stateMutability":"Nonpayable","type":"Constructor"},{"payable":true,"stateMutability":"Payable","type":"Fallback"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"name":"value","type":"uint256"}],"name":"Transfer","type":"Event"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"name":"value","type":"uint256"}],"name":"Burn","type":"Event"},{"inputs":[{"name":"target","type":"address"},{"name":"frozen","type":"bool"}],"name":"FrozenAccounts","type":"Event"},{"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"Approval","type":"Event"},{"inputs":[{"indexed":true,"name":"previousOwner","type":"address"},{"indexed":true,"name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"Event"}]'); 
?>