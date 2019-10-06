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
?>
    <?php 
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
                <div style="background: #c8e0bd;border-radius: 5px;width: 95%;padding: 20px;font-weight: bold;">
                    <? echo 'Your Pending Rewards: &nbsp;' . $pending_rewards . '&nbsp;DLIKER'; ?>
                    <button class="btn float-right btn-primary" onclick="claimRewards();">Claim Rewards</button>
                </div>
                <script>
                    function claimRewards() {
                        if(window.steem_keychain) {
                            steem_keychain.requestCustomJson('<?php echo $tokens_claimable[1][2]; ?>', '<?php echo $tokens_claimable[1][0]; ?>', 'posting', '<?php echo $tokens_claimable[1][1]; ?>', 'Claim All SE Rewards', function(response) {
                                if (response.success) {
                                    alert("Rewards Claimed!");
                                } else {
                                    alert("Failed to claim rewards!");
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
                <? if($delegation_in > 0) { echo '(+'.$delegation_in.')'; } ?>
                <br>
                <? if($delegation_out > 0) { echo '(+'.$delegation_out.')'; } ?>
            </span>
        </div>
        <div class="row" style="justify-content: space-between;width: 98%;padding: 12px 18px 12px 8px;">
            <span><b>DLIKER Unstaking:</b> &nbsp;</span>
            <span><? if($pending_unstake > 0) { echo $pending_unstake . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
            <br>
            <span><b>DLIKER Market:</b> &nbsp;</span>
            <span><? if($tokens_in_market > 0) { echo $tokens_in_market . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
        </div> 
        <div class="row" style="justify-content: space-between;width: 98%;background-color: #f4f4f4;padding: 12px 18px 12px 8px;">
            <span><b>Total DLIKER Owned:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">Total tokens owned in all forms.</p>
            </span>
            <span><? echo $total_balance . '&nbsp;<b>DLIKER</b>'; ?></span>
        </div>        
    </div>
</div>


        <div class="card text-center m-3">



                    <div class="card-body">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-balances" role="tabpanel"
                                 aria-labelledby="nav-balances-tab">
                                <div class="container">
                                    <h4>Balances</h4>
                                    <table id="balances" class="datatable table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token</th>
                                            <th>Token Name</th>
                                            <th>Liquid</th>
                                            <th>Market</th>
                                            <th>Staked</th>
                                            <th>Delegations In</th>
                                            <th>Delegations Out</th>
                                            <th>Pending Unstakes</th>
                                            <th>Pending Rewards</th>
                                            <th>Total Owned</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php echo $balance_rows; ?>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token</th>
                                            <th>Token Name</th>
                                            <th>Liquid</th>
                                            <th>Market</th>
                                            <th>Staked</th>
                                            <th>Delegations In</th>
                                            <th>Delegations Out</th>
                                            <th>Pending Unstakes</th>
                                            <th>Pending Rewards</th>
                                            <th>Total Owned</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-market" role="tabpanel" aria-labelledby="nav-market-tab">
                                <div class="container">
                                    <h4>Buys</h4>
                                    <table id="buys" class="datatable table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token Name</th>
                                            <th>Quantity</th>
                                            <th>Symbol</th>
                                            <th>Price</th>
                                            <th>STEEM</th>
                                            <th>Total STEEM</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php echo $buy_rows; ?>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token Name</th>
                                            <th>Quantity</th>
                                            <th>Symbol</th>
                                            <th>Price</th>
                                            <th>STEEM</th>
                                            <th>Total STEEM</th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <h4>Sells</h4>
                                    <table id="sells" class="datatable table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token Name</th>
                                            <th>Quantity</th>
                                            <th>Symbol</th>
                                            <th>Price</th>
                                            <th>STEEM</th>
                                            <th>Total STEEM</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                            <?php echo $sell_rows; ?>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Token Name</th>
                                            <th>Quantity</th>
                                            <th>Symbol</th>
                                            <th>Price</th>
                                            <th>STEEM</th>
                                            <th>Total STEEM</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-rewards" role="tabpanel"
                                 aria-labelledby="nav-rewards-tab">
                                <?php $rewards = json_decode(get_rewards($user_name));
                                    $reward_rows = "";
                                    require_once "./lib/time_string.php";
                                    foreach ($rewards as $reward) {
                                        switch ($reward->type) {
                                            case "mining_reward":
                                                $time_str = epoch_to_time(strtotime($reward->timestamp . "+0000"), false, false);
                                                $reward_rows .= "<tr><td>Mining</td><td>" . ((float)$reward->int_amount / (10 ** $reward->precision)) . "</td><td>$reward->token</td><td>TX: $reward->trx</td><td data-order='$reward->timestamp'><abbr data-toggle='tooltip' title='$reward->timestamp'>$time_str</abbr></td></tr>";
                                                break;
                                            case "author_reward":
                                                $time_str = epoch_to_time(strtotime($reward->timestamp . "+0000"), false, false);
                                                $display_perm = strlen($reward->permlink) > 30 ? substr($reward->permlink,0,30) . "..." : $reward->permlink;
                                                $reward_rows .= "<tr><td>Author</td><td>" . ((float)$reward->int_amount / (10 ** $reward->precision)) ."</td><td>$reward->token</td><td><a href='https://steempeak.com/@$reward->account/$reward->permlink' rel='nofollow'>@$reward->account/$display_perm</a></td><td data-order='$reward->timestamp'><abbr data-toggle='tooltip' title='$reward->timestamp'>$time_str</abbr></td></tr>";
                                                break;
                                            case "staking_reward":
                                                $time_str = epoch_to_time(strtotime($reward->timestamp . "+0000"), false, false);
                                                $reward_rows .= "<tr><td>Staking</td><td>" . ((float)$reward->int_amount / (10 ** $reward->precision)) ."</td><td>$reward->token</td><td>TX: $reward->trx</td><td data-order='$reward->timestamp'><abbr data-toggle='tooltip' title='$reward->timestamp'>$time_str</abbr></td></tr>";
                                                break;
                                            case "curation_reward":
                                                $time_str = epoch_to_time(strtotime($reward->timestamp . "+0000"), false, false);
                                                $display_perm = strlen($reward->permlink) > 30 ? substr($reward->permlink,0,30) . "..." : $reward->permlink;
                                                $reward_rows .= "<tr><td>Curation</td><td>" . ((float)$reward->int_amount / (10 ** $reward->precision)) ."</td><td>$reward->token</td><td><a href='https://steempeak.com/@$reward->author/$reward->permlink' rel='nofollow'>@$reward->author/$display_perm</a></td><td data-order='$reward->timestamp'><abbr data-toggle='tooltip' title='$reward->timestamp'>$time_str</abbr></td></tr>";
                                                break;
                                            case "comment_benefactor_reward":
                                                $time_str = epoch_to_time(strtotime($reward->timestamp . "+0000"), false, false);
                                                $display_perm = strlen($reward->permlink) > 30 ? substr($reward->permlink,0,30) . "..." : $reward->permlink;
                                                $reward_rows .= "<tr><td>Benefactor</td><td>" . ((float)$reward->int_amount / (10 ** $reward->precision)) ."</td><td>$reward->token</td><td><a href='https://steempeak.com/@$reward->author/$reward->permlink' rel='nofollow'>@$reward->author/$display_perm</a></td><td data-order='$reward->timestamp'><abbr data-toggle='tooltip' title='$reward->timestamp'>$time_str</abbr></td></tr>";
                                                break;
                                        }
                                    }
                                ?>
                                <div class="container">
                                    <h4>Rewards</h4>
                                    <table id="rewards" class="datatable table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Symbol</th>
                                            <th>Details</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php echo $reward_rows; ?>
                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Symbol</th>
                                            <th>Details</th>
                                            <th>Time</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <?php
                }
        ?>

    <?php include "./template/footer.php"; ?>