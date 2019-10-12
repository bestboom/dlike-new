<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "./template/header5.php"; 
$user_name = $_COOKIE['username'];
?>
<style>
.row-3 { justify-content: space-between;width: 98%;padding: 12px 18px 6px 8px;}
.row-2 {justify-content: space-between;background-color: #f4f4f4;width: 98%;padding: 12px 18px 12px 8px;}
</style>
<?php
function get_recent_transactions ($account = "null") {
    $recent = file_get_contents("https://api.steem-engine.com/accounts/history?account=$account&limit=100&offset=0&type=user&symbol=DLIKER");
    try {
        $json = json_decode($recent);
        return $json;
    } catch (Exception $exception) {
        return (object) [];
    }
}

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
        $url="https://steemconnect.com/sign/custom-json?required_posting_auths=".urlencode("[\"".$name."\"]")."&id=scot_claim_token&json=".urlencode($json);
        return [$url,["scot_claim_token", $json, $name]];
    }
    return [];
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
        <div class="row">
            <?php
            $tokens_claimable = getClaimDetails($user_name, getTokensToClaim($user_name));
            if ($pending_rewards > 0) {
                $balances = $_STEEM_ENGINE->get_user_balances($user_name);
                ?>
                <div id="claim_dliker" style="background: #c8e0bd;border-radius: 5px;width: 95%;padding: 20px;font-weight: bold;">
                    <?php echo 'Your Pending Rewards: &nbsp;' . $pending_rewards . '&nbsp;DLIKER'; ?>
                    <button class="btn float-right btn-primary" onclick="claimRewards();">Claim Rewards</button>
                </div>
                <script>
                    function claimRewards() {
                        if(window.steem_keychain) {
                            steem_keychain.requestCustomJson('<?php echo $tokens_claimable[1][2]; ?>', '<?php echo $tokens_claimable[1][0]; ?>', 'posting', '<?php echo $tokens_claimable[1][1]; ?>', 'Claim All SE Rewards', function(response) {
                                if (response.success) {
                                    toastr.success("Rewards Claimed!");
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
            <span><?php echo $my_balance . '&nbsp;<b>DLIKER</b>'; ?>
                <br>
                <span style="float:right;">
                    <a href="" data-toggle="modal" data-target="#dlk_transfer"><i class="fas fa-share-square" title="transfer" style="cursor: pointer;"></i></a>&nbsp; &nbsp;
                    <a href="" data-toggle="modal" data-target="#dlk_stake"><i class="fas fa-lock" title="stake" style="cursor: pointer;"></i></a>&nbsp; &nbsp;
                    <a href="" data-toggle="modal" data-target="#dlk_delegate"><i class="fas fa-minus-circle" title="delegate" style="cursor: pointer;"></i></a>
                </span>
            </span>
        </div>
        <div class="row row-2">
            <span><b>DLIKER Power:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">DLIEKR power is the influence to control over post payouts and allow you to earn on curation rewards.</p>
            </span>
            <span><?php echo $balance_stake . '&nbsp;<b>DLIKER</b>&nbsp; &nbsp;<a href="" data-toggle="modal" data-target="#dlk_unstake"><i class="fas fa-unlock" title="unstake" style="cursor: pointer;"></i></a>'; ?>
                <br>
                <span style="float: right;">
                    <?php if($delegation_in > 0) { echo '(+'.$delegation_in.'&nbsp; DLIKER) &nbsp;<a href="" data-toggle="modal" data-target="#dlk_delegation_in"><i class="fas fa-eye" style="color:grey;cursor: pointer;"></i></a>'; } ?>
                    <br>
                    <?php if($delegation_out > 0) { echo '(-'.$delegation_out.'&nbsp; DLIKER) &nbsp;<a href="" data-toggle="modal" data-target="#dlk_delegation_out"><i class="fas fa-eye" style="color:grey;cursor: pointer;"></i></a>'; } ?>
                </span>
            </span>
        </div>
        <div class="row row-3">
            <span><b>DLIKER Unstaking:</b> &nbsp;</span>
            <span><?php if($pending_unstake > 0) { echo $pending_unstake . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
        </div>
        <div class="row" style="justify-content: space-between;width: 98%;padding: 6px 18px 12px 8px;">    
            <span><b>DLIKER Market:</b> &nbsp;</span>
            <span><?php if($tokens_in_market > 0) { echo $tokens_in_market . '&nbsp;<b>DLIKER</b>'; } else { echo '0.000 <b>DLIKER</b>';} ?></span>
        </div> 
        <div class="row row-2">
            <span><b>Total DLIKER Owned:</b> &nbsp;<br>
                <p style="margin-bottom: 5px;">Total tokens owned in all forms.</p>
            </span>
            <span>
                <?php echo $total_balance . '&nbsp;<b>DLIKER</b>'; ?>
            </span>
        </div>  
        <div class="row row-3">
            <span><b>DLIKER Market Price:</b> &nbsp;</span>
            <span>
                <?php echo '0.00123 <b>STEEM</b> &nbsp;&nbsp;<a href="https://steem-engine.com/?p=market&t=DLIKER" target="_blank"><i class="fas fa-exchange-alt" title="market" style="color: #c51d24;"></i></a>'; ?>
            </span>
        </div>
        <div class="row" style="width: 98%;">
            <h3 style="font-size: 24px !important;font-weight: 600;padding: 30px 0px;">History</h3>
            <table class='table table-striped table-bordered table-condensed' style="width: 100%;">
                <thead>
                    <tr><th>From</th><th>Amount</th><th>To</th><th>Memo</th><th>Time</th></tr>
                </thead>
            <?php
                $data = get_recent_transactions($user_name);
                foreach ($data as $datum) {
                    print("<tr><td>$datum->from</td><td>$datum->quantity $datum->symbol</td><td>$datum->to</td><td>$datum->memo</td><td>" . epoch_to_time(strtotime($datum->timestamp), false, false) . "</td></tr>");
                }
            ?>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="dlk_transfer" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_transfer.php'); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="dlk_stake" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_stake.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="dlk_delegate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_delegate.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="dlk_unstake" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_unstake.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="dlk_delegation_in" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_delegate_in.php'); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="dlk_delegation_out" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/dliker_delegate_out.php'); ?>
        </div>
    </div>
</div>
<?php include "./template/footer.php"; ?>
<script>
    $('.unstake_btn').click(function(clickEvent) {
        let unstake_amount = $('#unstake_amt').val();
        let staked_amount = $('#dliker_unstake').val();
        console.log(unstake_amount);
        console.log(staked_amount);
        if(parseFloat(unstake_amount) > parseFloat(staked_amount)){
            $('#unstake-msg').html('Entered value is more than available amount').show();
            return false;
        } else {
            if(window.steem_keychain) {
                steem_keychain.requestCustomJson("<?php echo $user_name; ?>", "ssc-mainnet1", "active", '{"contractName":"tokens","contractAction":"unstake","contractPayload":{"symbol":"DLIKER","quantity":"'+unstake_amount+'"}}', "Unstake DLIKER Tokens", function(response) {
                    if (response.success) {
                        toastr.success("Tokens Unstaked Success!");
                        $('#dlk_unstake').modal('hide');
                    } else {
                        toastr.error("Failed to Unstake!");
                        $('#dlk_unstake').modal('hide');
                    }
                });
            } else {
                var win = window.open('<?php echo $tokens_claimable[0]; ?>', '_blank');
                win.focus();
            }
        }
    })

    $('.stake_btn').click(function(clickEvent) {
        let stake_amount = $('#stake_amt').val();
        let dliker_bal = $('#dliker_bal').val();
        console.log(stake_amount);
        console.log(dliker_bal);
        if(parseFloat(stake_amount) > parseFloat(dliker_bal)){
            $('#stake-msg').html('Entered value is more than available amount').show();
            return false;
        } else {
            if(window.steem_keychain) {
                steem_keychain.requestCustomJson("<?php echo $user_name; ?>", "ssc-mainnet1", "active", '{"contractName":"tokens","contractAction":"stake","contractPayload":{"to":"<?php echo $user_name; ?>","symbol":"DLIKER","quantity":"'+stake_amount+'"}}', "Stake DLIKER Tokens", function(response) {
                    if (response.success) {
                        toastr.success("Tokens Staked Successfully!");
                        $('#dlk_stake').modal('hide');
                    } else {
                        toastr.error("Failed to Stake!");
                        $('#dlk_stake').modal('hide');
                    }
                });
            } else {
                var win = window.open('<?php echo $tokens_claimable[0]; ?>', '_blank');
                win.focus();
            }
        }
    })  

    $('.delegate_btn').click(function(clickEvent) {
        let delegate_amount = $('#delegate_amt').val();
        let staked_bal = $('#dliker_staked_bal').val();
        console.log(delegate_amount);
        console.log(staked_bal);
        if(parseFloat(delegate_amount) > parseFloat(staked_bal)){
            $('#delegate-msg').html('Entered value is more than available amount').show();
            return false;
        } else {
            if(window.steem_keychain) {
                steem_keychain.requestCustomJson("<?php echo $user_name; ?>", "ssc-mainnet1", "active", '{"contractName":"tokens","contractAction":"stake","contractPayload":{"to":"<?php echo $user_name; ?>","symbol":"DLIKER","quantity":"'+delegate_amount+'"}}', "Stake DLIKER Tokens", function(response) {
                    if (response.success) {
                        toastr.success("Tokens Delegated Successfully!");
                        $('#dlk_stake').modal('hide');
                    } else {
                        toastr.error("Failed to Delegate!");
                        $('#dlk_stake').modal('hide');
                    }
                });
            } else {
                var win = window.open('<?php echo $tokens_claimable[0]; ?>', '_blank');
                win.focus();
            }
        }
    })        
</script>