<?php include('template/header.php'); 
if (isset($_GET['user'])) {
     $user_wallet = $_GET['user'];
}
$sqls = "SELECT amount FROM wallet where username='$user_wallet'"; 
$resultAmount = $conn->query($sqls);
$rowIt = $resultWallet->fetch_assoc($resultAmount);

?>
        <div class="container explorer-top">
            <div class="col-md-12">
            <?php if(empty($user_wallet)) { ?>
                <div class="banner-content explorer-form">
                    <form class="subs-form">
                        <div class="input-box expl">
                            <input type="text" value="" name="s" class="form-control" id="exp_search" placeholder="Search by steem username for token / transactions" required />
                            <button type="button" class="wallet-search">Search</button>
                        </div>
                    </form>
                </div>
            <? } else { ?>
                <div class="row wallet-profile">
                    <span><img src="https://steemitimages.com/u/<?php echo $user_wallet; ?>/avatar" alt="img" class="img-responsive"></span>
                    <h4><?php echo $user_wallet; ?></h4>       
                    <span><?php echo $rowIt['amount']; ?></span>
                </div>
            <? } ?>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- banner-block -->
<div class="explorer-section">

    <div class="activity-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Top Token Holders</h4></div>
                        </div>
                        <?php
                        $sqlm = "SELECT username, amount FROM wallet ORDER BY amount DESC LIMIT 10";
                        $resultWallet = $conn->query($sqlm);
                        if ($resultWallet->num_rows > 0) {
                            while($row = $resultWallet->fetch_assoc()) { ?>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div><img src="https://steemitimages.com/u/<?php echo $row["username"]; ?>/avatar" alt="img" class="img-responsive"></div>
                                        <div class="exp-user"><?php echo $row["username"]; ?></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo (number_format($row["amount"])); ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Latest Transactions</h4></div>
                        </div>
                        <?php
                        $sqlt = "SELECT username, amount, reason FROM transactions ORDER BY trx_time DESC LIMIT 10";
                        $result = $conn->query($sqlt);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) { ?>
                        <div class="activity-block">
                            <div class="row my-entry">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div><span class="btn btn-icon btn-exp"><span class="text-dark">Tx</span></span></div>
                                        <div class="exp-user"><?php echo $row["username"]; ?></div>
                                        <div class="exp-user">For <span><?php echo $row["reason"]; ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo (number_format($row["amount"])); ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- activity-section -->

                            
</div><!-- explorer-section -->
<?php include('template/footer.php'); ?>