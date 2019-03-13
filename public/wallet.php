<?php include('template/header.php'); 
if (isset($_GET['user'])) {
     $user_wallet = $_GET['user'];
}
$sqls = "SELECT amount FROM wallet where username='$user_wallet'"; 
$resultAmount = $conn->query($sqls);
$rowIt = $resultAmount->fetch_assoc();
$conn->close();
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
                <div class="row d-flex justify-content-around wallet-profile">
                    <div class="row">
                        <span><img src="https://steemitimages.com/u/<?php echo $user_wallet; ?>/avatar" onerror="this.src='./images/post/8.png'" alt="img" class="img-responsive img-wallet"></span>
                        <h4><?php echo $user_wallet; ?></h4>  
                    </div>     
                    <div>
                        <h4>Token Balance: &nbsp;<?php echo (number_format($rowIt['amount'])); ?>&nbsp;Dlikes</h4>
                    </div>
                </div>
            <? } $conn->close(); ?>
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

                <div class="offset-lg-1 col-lg-10 offset-md-1 col-md-10">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Latest Transactions</h4></div>
                        </div>
                        <?php
                        $sqlt = "SELECT username, amount, reason FROM transactions where username='$user_wallet' ORDER BY trx_time DESC";
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