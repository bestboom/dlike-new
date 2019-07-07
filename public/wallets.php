<?php

include('template/header5.php');

if (!isset($_COOKIE['username']) || !$_COOKIE['username']) {
    die('<script>window.location.replace("https://dlike.io","_self")</script>');
} else {
    $user_wallet = $_COOKIE['username'];
}

$sqls         = "SELECT amount FROM wallet where username='$user_wallet'";
$resultAmount = $conn->query($sqls);
$rowIt        = $resultAmount->fetch_assoc();
$dlike_bal    = $rowIt['amount'];

$sqlTip    = "SELECT * FROM TipsWallet where username='$user_wallet'";
$resultTip = $conn->query($sqlTip);

if ($resultTip && $resultTip->num_rows > 0) {
    $rowTip  = $resultTip->fetch_assoc();
    $tip_bal = $rowTip['tip1'];
} else {
    $tip_bal = '0';
}

$sql_st    = "SELECT SUM(amount) As stake_amt FROM staking where username='$user_wallet'";
$result_st = $conn->query($sql_st);
$row_st    = $result_st->fetch_assoc();

$sqlp    = "SELECT * FROM prousers where username='$user_wallet'";
$resultp = $conn->query($sqlp);

if ($resultp->num_rows > 0) {
    echo "<script>let thisuser = 'PRO';</script>";
} else {
    echo "<script>let thisuser = '';</script>";
}

$sqlu     = "SELECT * FROM wallet where username='$user_wallet'";
$resultu  = $conn->query($sqlu);
$rowU     = $resultu->fetch_assoc();
$user_eth = $rowU['eth'];

if ($user_eth == '') {
    echo "<script>let user_eth = '';</script>";
} else {
    echo "<script>let user_eth = 'Exist'; let eth_address = '$user_eth';</script>";
}

?>
    </div><!-- banner-block -->

    <div class="catagori-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="catagori-content-block">
                        <nav class="catagori-list" style="background: #eee;">
                            <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_wallet" role="tab" data-toggle="tab"
                                       aria-selected="false">
                                        <h4>DLIKE</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#nav_mycelium" role="tab" data-toggle="tab"
                                       aria-selected="true">
                                        <h4>STEEM/SBD</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_exodus" role="tab" data-toggle="tab"
                                       aria-selected="false">
                                        <h4>Tips</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_copay" role="tab" data-toggle="tab"
                                       aria-selected="false">
                                        <h4>Become PRO</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_nano" role="tab" data-toggle="tab"
                                       aria-selected="false">
                                        <h4>Buy Tokens</h4>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="tab-content catagoritab-content" id="nav-tabContent">
                            <div role="tabpanel" class="tab-pane fade" id="nav_wallet">
                                <div class="catagori-content">
                                    <p class="catagori-info"></p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="base-color">DLIKE: </h5>
                                            <p><?php echo(number_format($dlike_bal)); ?> DLIKE</p>
                                        </div>
                                        <p class="coins-detail">
                                            Native Token for DLIKE Platform
                                            <span class="coins-match">
                                                <a href="" data-toggle="modal" data-target="#tk_transfer">Transfer</a>
                                            </span>
                                        </p>
                                        <hr class="wal_hr">
                                        <div class="pros-block">
                                            <h5 class="base-color">STAKING: </h5>
                                            <p>
                                                <?php echo(number_format($row_st['stake_amt'])); ?> DLIKE
                                            </p>
                                        </div>
                                        <p class="coins-detail">
                                            Earn bonus token by staking
                                            <span class="coins-match"><a href="/staking">Stake Now</a></span>
                                        </p>
                                        <hr class="wal_hr">
                                        <div class="pros-block">
                                            <h5 class="base-color">DLIKE Stable Coin: </h5>
                                            <p>0 DLIKE</p>
                                        </div>
                                        <p class="coins-detail">
                                            DLIKE Stable Coin (coming soon)
                                        </p>
                                        <hr class="wal_hr">
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade active show" id="nav_mycelium">
                                <div class="catagori-content">
                                    <div class="st_rewards">
                                        <b>Pending Rewards:</b>
                                        <span class="pending-rewards">
                                            <span class="fas fa-circle-notch fa-spin"></span>
                                        </span>
                                        <button class="btn btn-default cl_rewards claim-rewards-button" disabled>
                                            Claim Rewards
                                        </button>
                                    </div>
                                    <p class="catagori-info"></p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="base-color">STEEM: </h5>
                                            <p>165 STEEM</p>
                                        </div>
                                        <p class="coins-detail">Native Token for STEEM Blockchain<span
                                                    class="coins-match">Transfer</span>
                                        </p>
                                        <hr class="wal_hr">
                                        <div class="pros-block">
                                            <h5 class="base-color">STEEM DOLLAR: </h5>
                                            <p>312 SBD</p>
                                        </div>
                                        <p class="coins-detail">Basic STEEM token valued at dollar<span
                                                    class="coins-match">Transfer</span>
                                        </p>
                                        <hr class="wal_hr">
                                        <div class="pros-block">
                                            <h5 class="base-color">STEEM POWER: </h5>
                                            <p>4523 STEEM</p>
                                        </div>
                                        <p class="coins-detail">STEEM Power is delegated STEEM amount</p>
                                        <hr class="wal_hr">
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_exodus">
                                <div class="catagori-content"><!-- TIPS-content-ends -->
                                    <h5>TIP Rewards - Withdrawable To ETH Address</h5>
                                    <p class="catagori-info">
                                    <div id="eth-msg"></div>
                                    <form action="" class="" method="POST" id="eth_sub">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text mb-deck"> ETH Addr</div>
                                                </div>
                                                <input type="hidden" name="eth_user"
                                                       value="<?php echo $user_wallet; ?>"/>
                                                <input type="text" class="form-control" name="eth_add" id="eth_field"
                                                       placeholder="Enter ETH Addr" value=""/>&nbsp;
                                                <button type="submit" class="btn btn-primary eth_add">ADD</button>
                                            </div>
                                        </div>
                                    </form>
                                    </p>
                                    <div class="pros-cons-block" style="padding-top: 20px;">
                                        <div class="pros-block">
                                            <h5 class="base-color">USDT: </h5>
                                            <p><?php echo $tip_bal; ?> USDT</p>
                                        </div>
                                        <p class="coins-detail">A stable coin by Bitfinex<span class="coins-match"><a
                                                        href="" data-toggle="modal"
                                                        data-target="#tk_withdraw">Withdraw</a></span>
                                        </p>
                                        <hr class="wal_hr">
                                    </div>
                                </div><!-- tips-content-end -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_copay">
                                <div class="catagori-content"><!-- PRO-content-starts -->
                                    <div class="pro-img" style="display: none;">
                                        <center>
                                            <img src="https://steemitimages.com/u/<?php echo $user_wallet; ?>/avatar"
                                                 onerror="this.src='/images/post/authors/8.png'" alt="img"
                                                 class="img-responsive img-wallets">
                                            <div class="img-pro">PRO</div>
                                        </center>
                                    </div>
                                    <div class="pro-data">
                                        <h4 class="bell-bold">Become PRO user - Enjoy Maximum Rewards</h4>
                                        <p class="catagori-info">
                                        <h4 class="bell-bold">What is Pro user?</h4>
                                        <p>
                                            PRO user is the apex user status on DLIKE platform which enjoys maximum
                                            available rewards
                                        </p>
                                        </p>
                                        <h4 class="bell-bold">Advantages for PRO users</h4>
                                        <p>
                                        <li>Allowed upto 3 post shares per day</li>
                                        <li>3X upvotes on all your posts</li>
                                        <li>Daily DLIKE token income through reward pool</li>
                                        <li>TIP to any post and earn 40% TIP share</li>
                                        </p>
                                        <h4 class="bell-bold">How to become PRO?</h4>
                                        <p>
                                            To become PRO user, you need to pay 10,000 DLIKE tokens which will be burnt.
                                        </p>
                                        <div id="pro-msg"></div>
                                        <div class="pros-cons-block">
                                            <form action="" class="" method="POST" id="pro_sub">
                                                <input type="hidden" name="pro_user"
                                                       value="<?php echo $user_wallet; ?>"/>
                                                <button type="submit" class="btn btn-primary pro-bt">Become PRO</button>
                                            </form>
                                        </div>
                                    </div>
                                </div><!-- PRO-content-ends -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_nano">
                                <div class="catagori-content">
                                    <p class="catagori-info">
                                        DLIKE is the native token of DLIKE platform which is purely a utility token. PRO
                                        users cane arn DLIKE tokens on daily basis through reward pool. To become PRO,
                                        users
                                        are required to burn 10,000 DLIKE tokens.
                                    </p>
                                    <p>
                                        DLIKE token is not yet listed on exchanges so it can be purchased here at a
                                        price of
                                        0.025 USD.
                                    </p>
                                    <div class="pros-cons-block">
                                        <button type="submit" class="btn btn-primary">BUY DLIKE Tokens</button>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                        </div>
                    </div><!-- catagori-content-block -->
                </div>
                <div class="col-lg-3">
                    <div class="catagori-vintage">
                        <img src="./images/others/7.png" alt="img" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="explorer-section">
        <div class="new-ticker-block new-ticker-block-section">
            <div class="container">
                <div class="new-ticker-block-wrap">
                    <div class="ticker-head">
                        <ul class="nav nav-tabs ticker-nav" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" href="#dlike_trx" role="tab" data-toggle="tab"
                                   aria-selected="true">
                                    <h5>DLIKE</h5>
                                    <i class="fa fa-stroopwafel"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#steem_trx" role="tab" data-toggle="tab">STEEM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tips_trx" role="tab" data-toggle="tab">TIPS</a>
                            </li>
                            <li class="nav-item nav-item-last">
                            </li>
                        </ul>
                    </div>
                    <div class="market-ticker-block">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active show" id="dlike_trx">
                                <table class="table coin-list table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">TX</th>
                                        <th scope="col">Reason</th>
                                        <th scope="col" style="text-align: right;padding-right: 40px;">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $sqlt   = "SELECT * FROM transactions where username='$user_wallet' OR receiver='$user_wallet' ORDER BY trx_time DESC";
                                    $result = $conn->query($sqlt);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $trx_status = $row["reason"];

                                            ?>
                                            <tr>
                                                <td><span class="btn btn-icon btn-exp">
                                                    <span class="text-dark">Tx</span></span>
                                                </td>
                                                <td class="exp-user">
                                                    For <span><?php echo $trx_status; ?></span>
                                                </td>
                                                <td class="exp-amt">
                                                    <span id="tk-amt">
                                                        <?php echo(number_format($row["amount"])); ?>
                                                    </span>
                                                    DLIKE
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }

                                    ?>
                                    </tbody>
                                </table><!-- coin-list table -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="steem_trx">
                                <table class="table coin-list table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th scope="col">Pair</th>
                                        <th scope="col">Last Price</th>
                                        <th scope="col">24h Change <span class="ti-arrow-down"></span></th>
                                        <th scope="col">24h High</th>
                                        <th scope="col">24h Low</th>
                                        <th scope="col">24h Volume</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="favorite-coin">

                                            </div>
                                        </td>
                                        <td> POA / BTC</td>
                                        <td><span class="color-buy">0.00006822 </span>/$0.48</td>
                                        <td><span class="color-sell">-23.80%</span></td>
                                        <td>0.00007300</td>
                                        <td>0.00005510</td>
                                        <td>7,522.88586112</td>
                                    </tr>
                                    </tbody>
                                </table><!-- coin-list table -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tips_trx">
                                <table class="table coin-list table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">Tip</th>
                                        <th scope="col">By</th>
                                        <th scope="col">For</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    $sql_tip    = "SELECT * FROM TipTop where receiver='$user_wallet' ORDER BY tip_time DESC LIMIT 20";
                                    $result_tip = $conn->query($sql_tip);

                                    if ($result_tip && $result_tip->num_rows > 0) {
                                        while ($row_tip = $result_tip->fetch_assoc()) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="btn btn-icon btn-exp">
                                                        <span class="text-dark">Tx</span>
                                                    </span>
                                                </td>
                                                <td class="exp-user">
                                                    <span><?php echo $row_tip["sender"]; ?></span>
                                                </td>
                                                <td class="exp-amt">
                                                    <span class="color-sell">
                                                        <?php echo '<a href="/post/@'.$user_wallet.'/'.$row_tip["permlink"].'">Link</a>'; ?>
                                                    </span>
                                                </td>
                                                <td class="exp-amt">
                                                    <span>
                                                        <?php echo $row_tip["tip_time"]; ?>
                                                    </span>
                                                </td>
                                                <td class="exp-amt">
                                                    <span>
                                                        <?php echo $row_tip["tip1"]; ?>
                                                    </span> USDT
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }

                                    ?>
                                    </tbody>
                                </table><!-- coin-list table -->
                            </div><!-- market-ticker-block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div><!-- explorer-section -->

    <div class="modal fade" id="tk_transfer" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-custom">
                <?php include('template/modals/tktransfer.php'); ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tk_withdraw" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-custom">
                <?php include('template/modals/tipswithdraw.php'); ?>
            </div>
        </div>
    </div>

<?php include('template/footer3.php'); ?>

    <script type="text/javascript">
        if (thisuser === 'PRO') {
            $('.pro-data').hide();
            $('.pro-img').show();
        }

        if (user_eth === 'Exist') {
            $('.eth_add').hide();
            $('#eth_field').val(eth_address).prop('readonly', true);
        }

        var optionspro = {
            target : '#pro-msg',
            url    : 'helper/addpro.php',
            success: function () {
            },
        };

        $('#pro_sub').submit(function (e) {
            e.preventDefault();
            $(this).ajaxSubmit(optionspro);
            return !1;
        });

        var optionseth = {
            target : '#eth-msg',
            url    : 'helper/addeth.php',
            success: function () {
            },
        };

        $('#eth_sub').submit(function (e) {
            e.preventDefault();
            let ethadd = $("#eth_field").val();

            if (!ethadd) {
                toastr.error('phew... Enter ETH Address');
                return false;
            }

            $(this).ajaxSubmit(optionseth);
            return !1;
        });

        var optionstsf = {
            target : '#tsf-msg',
            url    : 'helper/tk_transfer.php',
            success: function () {
            },
        };

        $('#tsf_sub').submit(function (e) {
            e.preventDefault();
            let reciever = $(".reciever").val();
            let send_amt = parseInt($(".send_amt").val());
            let user_bal = parseInt($("#user_bal").val()) || 0;
            console.log(user_bal);

            if (!reciever) {
                toastr.error('phew... Enter Reciever Name');
                return false;
            }

            if (!send_amt) {
                toastr.error('phew... Enter Amount To Send');
                return false;
            }

            if (send_amt > user_bal || user_bal < '1') {
                toastr.error('phew... Not Enough Balance');
                return false;
            }

            $(this).ajaxSubmit(optionstsf);
            return !1;
        });
    </script>


    <script>
        // read and claim rewards
        (function () {
            const Steem        = new dsteem.Client('https://api.steemit.com');
            const RewardInfos  = document.querySelector('.pending-rewards');
            const ClaimRewards = document.querySelector('.claim-rewards-button');
            const USERNAME     = '<?php echo $_COOKIE['username']; ?>';

            RewardInfos.innerHTML = '';

            Steem.database.call('get_accounts', [[USERNAME]]).then(function (result) {
                const reward_steem = result[0].reward_steem_balance.split(' ')[0];
                const reward_sbd   = result[0].reward_sbd_balance.split(' ')[0];
                const reward_sp    = result[0].reward_vesting_steem.split(' ')[0];
                const reward_vests = result[0].reward_vesting_balance.split(' ')[0];

                if (reward_steem <= 0 &&
                    reward_sbd <= 0 &&
                    reward_sp <= 0 &&
                    reward_vests <= 0
                ) {
                    RewardInfos.innerHTML = '0 SBD and 0 SP';
                    return;
                }

                RewardInfos.innerHTML = `${reward_sbd} SBD and ${reward_sp} SP`;
            });

            // button
            ClaimRewards.addEventListener('click', function () {
                ClaimRewards.innerHTML = '<span class="fas fa-circle-notch fa-spin"></span>';

                Steem.database.call('get_accounts', [[USERNAME]]).then(function (result) {
                    const reward_steem = result[0].reward_steem_balance.split(' ')[0];
                    const reward_sbd   = result[0].reward_sbd_balance.split(' ')[0];
                    const reward_sp    = result[0].reward_vesting_steem.split(' ')[0];
                    const reward_vests = result[0].reward_vesting_balance.split(' ')[0];

                    if (reward_steem <= 0 &&
                        reward_sbd <= 0 &&
                        reward_sp <= 0 &&
                        reward_vests <= 0
                    ) {
                        ClaimRewards.innerHTML = 'Claim Rewards';
                        ClaimRewards.disabled  = true;
                        return;
                    }

                    // const PRIVATE_KEY = dsteem.PrivateKey.fromString(WIF);

                    // claim rewards
                    // let op = ['claim_reward_balance', {
                    //     account     : USERNAME,
                    //     reward_steem: reward_steem + ' STEEM',
                    //     reward_sbd  : reward_sbd + ' SBD',
                    //     reward_vests: reward_vests + ' VESTS',
                    // }];

                    // Steem.broadcast.sendOperations([op], PRIVATE_KEY).then(function () {
                    //     ClaimRewards.innerHTML = 'Claim Rewards';
                    //     ClaimRewards.disabled  = true;
                    // }, function (error) {
                    //     ClaimRewards.innerHTML = 'Claim Rewards';
                    //     ClaimRewards.disabled  = true;
                    // });

                    // via steem connect
                    const link = `https://steemconnect.com/sign/claim-reward-balance?account=${USERNAME}&reward_steem=${reward_steem}&reward_sbd=${reward_sbd}&reward_vests=${reward_vests}`;

                    window.open(link);
                });
            });

            //transactions
            const TX_List = document.querySelector('#steem_trx');
            const TX_Body = TX_List.querySelector('tbody');

            document.querySelector('a[href="#steem_trx"]').addEventListener('click', function () {
                //TX_Body.innerHTML = `<tr><td colspan="7" style="text-align: center"><span class="fas fa-circle-notch fa-spin"></span></td></tr>`;

                Steem.database.call('get_account_history', [USERNAME, -1, 20]).then(function (result) {

                    console.log(result);

                });
            });
        })();

    </script>

<?php