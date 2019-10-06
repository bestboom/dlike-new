<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user_name = $_COOKIE['username'];
function get_rewards ($account = "null") {
    return file_get_contents("http://scot-api.steem-engine.com/get_account_history?account=$account");
}
require_once "./lib/SteemEngine.php";
use SnaddyvitchDispenser\SteemEngine\SteemEngine;
$_STEEM_ENGINE = new SteemEngine();

$loki = '$loki';
//require "steemuser.php";
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
        $url="https://steemconnect.com/sign/custom-json?required_posting_auths=".urlencode("[\"".$name."\"]")."&id=scot_claim_token&json=".urlencode($json);
        return [$url,["scot_claim_token", $json, $name]];
    }
    return [];
}

include "./template/header5.php"; 

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
        <div class="row">
            <?php
            $tokens_claimable = getClaimDetails($user_name, getTokensToClaim($user_name));
            if (sizeof($tokens_claimable) > 0) {
                $balances = $_STEEM_ENGINE->get_user_balances($user_name);
                ?>
                <div id="claim_dliker" style="background: #c8e0bd;border-radius: 5px;width: 95%;padding: 20px;font-weight: bold;">
                    <? echo 'Your Pending Rewards: &nbsp;' . $pending_rewards . '&nbsp;DLIKER'; ?>
                    <button class="btn float-right btn-primary" onclick="claimRewards();">Claim Rewards</button>
                </div>
                <script>
                    function claimRewards() {
                        if(window.steem_keychain) {
                            steem_keychain.requestCustomJson('<?php echo $tokens_claimable[1][2]; ?>', '<?php echo $tokens_claimable[1][0]; ?>', 'posting', '<?php echo $tokens_claimable[1][1]; ?>', 'Claim All SE Rewards', function(response) {
                                if (response.success) {
                                    toastr.error("Rewards Claimed!");
                                    $('#claim_dliker').hide();
                                } else {
                                    toastr.error("Failed to claim rewards!");
                                }
                            });
                        } else {
                            var win = window.open('<?php echo $tokens_claimable[0]; ?>', '_blank');
                            win.focus();
                        }
                    }
                </script>
            <?php
            }?>
        </div>
        <div class="row">
            <h3 style="font-size: 24px !important;font-weight: 600;padding: 30px 0px;">Balances</h3>
        </div>
        <div class="row" style="justify-content: space-between;width: 98%;padding: 12px 18px 12px 8px;">
            <span><b>Balance:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">DLIKER Tokens are tradeable, can be transfered to anyone, can be staked to DLIKER POWER.</p>
            </span>
            <span><? echo $my_balance . '&nbsp;<b>DLIKER</b>'; ?></span>
        </div>
        <div class="row" style="justify-content: space-between;background-color: #f4f4f4;width: 98%;padding: 12px 18px 12px 8px;">
            <span><b>DLIKER Power:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">DLIEKR power is the influence to control over post payouts and allow you to earn on curation rewards.</p>
            </span>
            <span><? echo $balance_stake . '&nbsp;<b>DLIKER</b>'; ?>
                <br>
                <? if($delegation_in > 0) { echo '(+'.$delegation_in.'&nbsp; DLIKER)'; } ?>
                <br>
                <? if($delegation_out > 0) { echo '(-'.$delegation_out.'&nbsp; DLIKER)'; } ?>
            </span>
        </div>
        <div class="row" style="justify-content: space-between;width: 98%;padding: 12px 18px 6px 8px;">
            <span><b>DLIKER Unstaking:</b> &nbsp;</span>
            <span><? if($pending_unstake > 0) { echo $pending_unstake . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
        </div>
        <div class="row" style="justify-content: space-between;width: 98%;padding: 6px 18px 12px 8px;">    
            <span><b>DLIKER Market:</b> &nbsp;</span>
            <span><? if($tokens_in_market > 0) { echo $tokens_in_market . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
        </div> 
        <div class="row" style="justify-content: space-between;width: 98%;background-color: #f4f4f4;padding: 12px 18px 12px 8px;">
            <span><b>Total DLIKER Owned:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">Total tokens owned in all forms.</p>
            </span>
            <span><? echo $total_balance . '&nbsp;<b>DLIKER</b>'; ?></span>
        </div>  

        <div class="row">
            <h3 style="font-size: 24px !important;font-weight: 600;padding: 30px 0px;">History</h3>
        </div>

    </div>
</div>
<?php include "./template/footer.php"; ?>