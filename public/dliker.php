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
function GetDomainName($url)
{
    $host = @parse_url($url, PHP_URL_HOST);
    // If the URL can't be parsed, use the original URL
    // Change to "return false" if you don't want that
    if (!$host) {
        return "";
    }
    // The "www." prefix isn't really needed if you're just using
    // this to display the domain to the user
    if (substr($host, 0, 4) == "www.") {
        $host = substr($host, 4);
    }
    // You might also want to limit the length if screen space is limited
    if (strlen($host) > 50) {
        $host = substr($host, 0, 47) . '...';
    }
    return $host;
}
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
//$user = [];
//preg_match('/@([A-z0-9\.\-]{3,16})/', $_SERVER["REQUEST_URI"], $user);
//if (isset($user[1])) {
//    $user_name = strtolower($user[1]);
//} else {
//    $user_name = "null";
//}
?>
<!DOCTYPE HTML>
<html>
    <head lang="en">
        <?php include "../additions/styles.php"; ?>
        <title>Profile of @<?php echo $user_name; ?></title>
        <meta name="description" content="View your profile and see balances, market orders and rewards!" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">
        <meta name="author" content="@CADawg">
        <link href="user_profile.css" rel="stylesheet" type="text/css" />
        <?php include "./template/header5.php"; ?>
    </head>

    <body>
        <?php include "../navagation.php"; ?>
        <div class="card flex-row flex-wrap p-3 m-3">
            <div class="card-head">

            </div>
            <div class="card-body px-3 py-0">
                <?php
                $tokens_claimable = getClaimDetails($user_name, getTokensToClaim($user_name));
                if (sizeof($tokens_claimable) > 0) {
                    ?>
                    <button class="btn float-right btn-primary" onclick="claimRewards();">Claim Rewards</button>
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
                <?php
                    if (isset($user_profile->user->json_metadata->profile->name)) {
                        echo "<h2 class='mb-0'>" . $user_profile->user->json_metadata->profile->name . "</h2>";
                        echo "<h5>@$user_name</h5>";
                    } else {
                        echo "<h2>" . $user_name . "</h2>";
                    }
                    if (isset($user_profile->user->json_metadata->profile->about)) {
                        echo "<p class='mb-1'>" . $user_profile->user->json_metadata->profile->about . "</p>";
                    } else {
                        echo "<p class='mb-1'></p>";
                    }
                    if (isset($user_profile->user->json_metadata->profile->website)) {
                        echo "<p class='mb-1'><a rel='nofollow' href='" . $user_profile->user->json_metadata->profile->website . "'>" . GetDomainName($user_profile->user->json_metadata->profile->website) . "</a></p>";
                    } else {
                        echo "<p class='mb-1'></p>";
                    }
                    if ($user_name == "cadawg") {
                        echo('<p class="badge user-badge badge-primary"><i class="fas fa-star"></i> Owner</p>');
                    } elseif (in_array($user_name, ["soyrosa", "pouchon"])) {
                        echo('<p class="badge user-badge badge-info"><i class="fas fa-dollar-sign"></i> Early Donor</p>');
                    } elseif (in_array($user_name, ["gerber", "mermaidvampire"])) {
                        echo('<p class="badge user-badge badge-success"><i class="fas fa-users"></i> Supporter</p>');
                    } elseif ($user_name == "definethedollar") {
                        echo('<p class="badge user-badge badge-warning"><i class="fas fa-fish"></i> <em>Ugh. Herrings.</em></p>');
                    } elseif ($user_name == "khaleelkazi") {
                        echo('<p class="badge user-badge badge-warning"><i class="fas fa-user"></i> I guess he\'s okay-ish!</p>');
                    } ?>
            </div>
        </div>

        <div class="card text-center m-3">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#nav-balances" id="nav-balances-tab" aria-controls="nav-balances" aria-selected="true">Balances</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#nav-market" id="nav-market-tab" aria-selected="false" aria-controls="nav-market">Market Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#nav-rewards" id="nav-rewards-tab" aria-selected="false" aria-controls="nav-rewards">Rewards</a>
                    </li>
                </ul>
            </div>

            <?php
                $balances = $_STEEM_ENGINE->get_user_balances($user_name);
                $market_sells = $_STEEM_ENGINE->get_market_sells($user_name);
                $market_buys = $_STEEM_ENGINE->get_market_buys($user_name);
                $token_info_raw = $_STEEM_ENGINE->get_tokens();
                $rewards = getTokensToClaim($user_name);
                $market_balances = [];
                $precisions = [];
                if ($balances !== false and $market_sells !== false and $market_buys !== false and $token_info_raw !== false) {
                    $token_info = [];
                    foreach ($token_info_raw as $token) {
                        $meta = json_decode($token->metadata);
                        $precisions[$token->symbol] = $token->precision;
                        if (isset($meta->icon)) {
                            $icon = $meta->icon;
                        } else {
                            $icon = "";
                        }
                        $token_info[$token->symbol] = [$token->name, $icon];
                    }
                    $sell_rows = "";
                    $total_sells = 0;
                    foreach ($market_sells as $sell) {
                        $amt = round($sell->quantity * $sell->price, 8);
                        $total_sells += $amt;
                        $sell_rows .= "<tr>";
                        $metadata = $token_info[$sell->symbol];
                        if ($metadata[1] != "") {
                            $sell_rows .= "<td><img style='width: 40px; height: 40px;' src='$metadata[1]' alt='Logo of $metadata[0]'></td></td>";
                        } else {
                            $sell_rows .= "<td></td>";
                        }
                        $sell_rows .= "<td>$metadata[0]</td>";
                        $sell_rows .= "<td>$sell->quantity</td>";
                        $sell_rows .= "<td>$sell->symbol</td>";
                        $sell_rows .= "<td><strong>$sell->price</strong></td>";
                        $sell_rows .= "<td>$amt</td>";
                        $sell_rows .= "<td>$total_sells</td>";
                        $sell_rows .= "</tr>";
                        if (isset($market_balances[$sell->symbol])) {
                            $market_balances[$sell->symbol] += $sell->quantity;
                        } else {
                            $market_balances[$sell->symbol] = $sell->quantity;
                        }
                    }
                    $buy_rows  = "";
                    $total_buys = 0.0;
                    foreach ($market_buys as $buy) {
                        $amt = round((float)$buy->tokensLocked, 8);
                        $total_buys += $amt;
                        $buy_rows .= "<tr>";
                        $metadata = $token_info[$buy->symbol];
                        if ($metadata[1] != "") {
                            $buy_rows .= "<td><img style='width: 40px; height: 40px;' src='$metadata[1]' alt='Logo of $metadata[0]'></td></td>";
                        } else {
                            $buy_rows .= "<td></td>";
                        }
                        $buy_rows .= "<td>$metadata[0]</td>";
                        $buy_rows .= "<td>$buy->quantity</td>";
                        $buy_rows .= "<td>$buy->symbol</td>";
                        $buy_rows .= "<td><strong>$buy->price</strong></td>";
                        $buy_rows .= "<td>$amt</td>";
                        $buy_rows .= "<td>$total_buys</td>";
                        $buy_rows .= "</tr>";
                        if (isset($market_balances["STEEMP"])) {
                            $market_balances["STEEMP"] += $buy->tokensLocked;
                        } else {
                            $market_balances["STEEMP"] = $buy->tokensLocked;
                        }
                    }
                    $balance_rows = "";
                    foreach ($balances as $balance) {
                        $balance_row = "<tr>";
                        $total = 0.0;
                        $metadata = $token_info[$balance->symbol];
                        if ($metadata[1] != "") {
                            $balance_row .= "<td><img style='width: 40px; height: 40px;' src='$metadata[1]' alt='Logo of $metadata[0]'></td></td>";
                        } else {
                            $balance_row .= "<td></td>";
                        }
                        $balance_row .= "<td>$balance->symbol</td>";
                        $balance_row .= "<td>$metadata[0]</td>";
                        $balance_row .= "<td>" . floatval($balance->balance) . "</td>";
                        $total += floatval($balance->balance);
                        if (isset($market_balances[$balance->symbol])) {
                            $balance_row .= "<td>" . floatval($market_balances[$balance->symbol]) . "</td>";
                            $total += floatval($market_balances[$balance->symbol]);
                        } else {
                            $balance_row .= "<td></td>";
                        }
                        /* Polyfill for old version data*/
                        if (isset($balance->delegationsIn)) {$balance->receivedStake = $balance->delegationsIn;}
                        if (isset($balance->delegationsOut)) {$balance->delegatedStake = $balance->delegationsOut;}
                        if (isset($balance->stake)) {
                            $balance_row .= "<td>" . floatval($balance->stake) . "</td>";
                            $total += floatval($balance->stake);
                        } else  {
                            $balance_row .= "<td></td>";
                        }
                        if (isset($balance->delegatedStake) and isset($balance->receivedStake)) {
                            $total += floatval($balance->delegatedStake);
                            if ($balance->receivedStake > 0) {
                                $balance_row .= "<td><em>" . floatval($balance->receivedStake) . "</em></td>";
                            } else {
                                $balance_row .= "<td></td>";
                            }
                            if ($balance->delegatedStake > 0) {
                                $balance_row .= "<td>" . floatval($balance->delegatedStake) . "</td>";
                            } else {
                                $balance_row .= "<td></td>";
                            }
                        } else {
                            $balance_row .= "<td></td><td></td>";
                        }
                        if (isset($balance->pendingUnstake) and $balance->pendingUnstake) {
                            $balance_row .= "<td>" . floatval($balance->pendingUnstake) . "</td>";
                            $total += floatval($balance->pendingUnstake);
                        } else {
                            $balance_row .= "<td></td>";
                        }
                        if (isset($rewards[$balance->symbol])) {
                            $pending_rewards = (floatval($rewards[$balance->symbol])/10**$precisions[$balance->symbol]);
                            $balance_row .= "<td>" . $pending_rewards . "</td>";
                            $total += floatval($pending_rewards);
                        } else {
                            $balance_row .= "<td></td>";
                        }
                        $balance_row .= "<td>$total</td>";
                        $balance_row .= "</tr>";
                        if ($total > 0) {
                            $balance_rows .= $balance_row;
                        }
                    }
                    ?>

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
        } else {
            echo "<h2>This user doesn't exist =(</h2>";
        }
        ?>

    <?php require "../additions/scripts.php"; ?>
    <script>
        $(document).ready(function() {
            $('#balances').DataTable({"order": [[10, "desc"]]});
            $('#buys').DataTable({"order": [[6, "asc"]]});
            $('#sells').DataTable({"order": [[6, "asc"]]});
            $('#rewards').DataTable({"order": [[4, "desc"]]});
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        } );
    </script>
    </body>
</html>