<?php
include "./template/header5.php"; 
$user_name = $_COOKIE['username'];

require_once "./lib/SteemEngine.php";
require_once "./lib/time_string.php";
use SnaddyvitchDispenser\SteemEngine\SteemEngine;
$_STEEM_ENGINE = new SteemEngine();

function getTokensToClaim($name) {
    $url="https://scot-api.steem-engine.com/@".$name."?v=".time()."000";
    $obj=json_decode(file_get_contents($url));
    $pendingTokens=array();
    foreach ($obj as $data) {
        if ($data->pending_token>0) {
            $pendingTokens[$data->symbol]=$data->pending_token;
        }
    }
    return $pendingTokens;
}
function getClaimDetails($name,$tokens) {
    if (count($tokens)>0) {
        $arr=[];
        foreach ($tokens as $token=>$value) {
            $arr[]=["symbol"=>$token];
        }
        $json=json_encode($arr);
        $url="https://steemconnect.com/sign/custom-json?required_posting_auths=".urlencode("[\"".$name."\"]")."&authority=active&id=scot_claim_token&json=".urlencode($json);
        return [$url,["scot_claim_token", $json, $name]];
    }
    return [];
}

function get_recent_transactions ($account = "null") {
    $recent = file_get_contents("https://api.steem-engine.com/accounts/history?account=$account&limit=100&offset=0&type=user&symbol=DLIKER");
    try {
        $json = json_decode($recent);
        return $json;
    } catch (Exception $exception) {
        return (object) [];
    }
}

        $balances = $_STEEM_ENGINE->get_user_balances($user_name);
        $market_sells = $_STEEM_ENGINE->get_market_sells($user_name);
        $market_buys = $_STEEM_ENGINE->get_market_buys($user_name);
        $token_info_raw = $_STEEM_ENGINE->get_tokens();
        $rewards = getTokensToClaim($user_name);
        
        $precisions = [];
        $market_balances = [];
        foreach ($balances as $balance) {
            foreach ($token_info_raw as $token) {
                $meta = json_decode($token->metadata);
                $precisions[$token->symbol] = $token->precision;
            }
            if (in_array($balance->symbol, ["DLIKER"])) {
                if (isset($rewards[$balance->symbol])) {
                    $pending_rewards = (floatval($rewards[$balance->symbol])/10**$precisions[$balance->symbol]);
                } else {
                    $pending_rewards = 0;
                }
                $my_balance = floatval($balance->balance);
                if (isset($balance->stake)) {
                    $balance_stake = floatval($balance->stake);
                } else  {
                    $balance_stake = 0;
                }  
                if (isset($balance->delegationsIn)) {$balance->receivedStake = $balance->delegationsIn;}
                if (isset($balance->delegationsOut)) {$balance->delegatedStake = $balance->delegationsOut;}  
                if (isset($balance->delegatedStake)) {
                    if ($balance->receivedStake > 0) {
                        $delegation_in = floatval($balance->receivedStake);
                    }
                    else {$delegation_in = 0;}
                }
                if (isset($balance->receivedStake)) {
                    if ($balance->delegatedStake > 0) {
                        $delegation_out = floatval($balance->delegatedStake);
                    }
                    else {$delegation_out = 0;}
                } 
                if (isset($balance->pendingUnstake) and $balance->pendingUnstake) {
                    $pending_unstake = floatval($balance->pendingUnstake);
                } else {
                    $pending_unstake = 0;
                }        
                if (isset($market_balances[$balance->symbol])) {
                    $tokens_in_market = floatval($market_balances[$balance->symbol]);
                } else {
                    $tokens_in_market = 0;
                }                         
                $total_balance = $my_balance + $pending_rewards + $delegation_out + $balance_stake + $pending_unstake + $tokens_in_market;   
            }
        }
?>
</div>
<div class="catagori-section">
    <div class="container">
        <div id="loadings"><img src="/images/loader.svg" width="100"></div>
        <div class="row" id="content">
        </div>
    </div>
</div>
<style>
.row-3 { justify-content: space-between;width: 98%;padding: 12px 18px 6px 8px;}
.row-2 {justify-content: space-between;background-color: #f4f4f4;width: 98%;padding: 12px 18px 12px 8px;}
</style>

<?php
include "./template/footer.php"; 
?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');
    })   
</script>