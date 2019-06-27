<?php include('template/header.php'); 
if (isset($_GET['user'])) {
     $user_wallet = $_GET['user'];
}
$sqls = "SELECT amount FROM wallet where username='$user_wallet'"; 
$resultAmount = $conn->query($sqls);
$rowIt = $resultAmount->fetch_assoc();
?>
        <div class="container explorer-top">
            <div class="col-md-12">
            <?php if(empty($user_wallet)) { ?>
                <div class="banner-content explorer-form">
                    <form action="/wallet.php" class="subs-form">
                        <div class="input-box expl">
                            <input type="text" value="" name="user" class="form-control" id="exp_search" placeholder="Search by steem username for token / transactions" required />
                            <button type="button" class="wallet-search">Search</button>
                        </div>
                    </form>
                </div>
            <? } else { ?>
                <div class="row d-flex justify-content-around wallet-profile">
                    <div class="row">
                        <span><img src="https://steemitimages.com/u/<?php echo $user_wallet; ?>/avatar" onerror="this.src='/images/post/authors/8.png'" alt="img" class="img-responsive img-wallet"></span>
                        <h4><?php echo $user_wallet; ?></h4>  
                    </div>     
                    <div>
                        <h4>Token Balance: &nbsp;<?php echo (number_format($rowIt['amount'])); ?>&nbsp;Dlikes</h4>
                    </div>
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



<div class="catagori-section" style="margin-top: 100px;"">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="catagori-content-block">
                        <nav class="catagori-list" style="background: #eee;">
                            <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_wallet" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>DLIKE</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active show" href="#nav_mycelium" role="tab" data-toggle="tab" aria-selected="true">
                                        <h4>STEEM/SBD</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_exodus" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Tips</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_copay" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Become PRO</h4>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#nav_nano" role="tab" data-toggle="tab" aria-selected="false">
                                        <h4>Buy Tokens</h4>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="tab-content catagoritab-content" id="nav-tabContent">
                            <div role="tabpanel" class="tab-pane fade" id="nav_wallet">
                                <div class="catagori-content">
                                    <img src="./images/others/6.png" alt="img" class="img-responsive">
                                    <p class="catagori-info">
                                        Advanced users searching for a Bitcoin mobile digital wallet, should look no further than mycelium. 
                                        The Mycelium mobile wallet allows iPhone and Android users to send and receive bitcoins and keep 
                                        complete control over bitcoins. No third party can freeze or lose your funds! With enterprise-level 
                                        security superior to most other apps and features like cold storage and encrypted PDF backups, 
                                        an integrated QR-code scanner receive bitcoins and keep.
                                    </p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="cp_level">Pros: </h5>
                                            <p>Good privacy, advanced security, feature-rich, open source Software, free</p>
                                        </div>
                                        <div class="cons-block">
                                            <h5 class="cp_level">Cons: </h5>
                                            <p>No web or desktop interface, hot wallet, not for beginners</p>
                                        </div>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade active show" id="nav_mycelium">
                                <div class="catagori-content">
                                	<div style="background: #eee;padding: 12px;display: flex;justify-content: space-between;border-radius: 4px;"><b>Pending Rewards:</b> 0.228 SBD and 1.798 SP<button class="btn btn-default">Claim Rewards</button></div>
                                    <p class="catagori-info"></p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEEM: </h5><p>165 STEEM</p>
                                        </div>
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEM DOLLAR: </h5><p>312 SBD</p>
                                        </div>
                                        <div class="pros-block" style="justify-content: space-between;">
                                            <h5 class="base-color">STEM POWER: </h5><p>4523 STEEM</p>
                                        </div>
                                        <div class="text-center">
                            				<button class="btn download-btn" style="width: 150px;height: 50px;"">Transfer</button>
                        				</div>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_exodus">
                                <div class="catagori-content">
                                    <img src="./images/others/6.png" alt="img" class="img-responsive">
                                    <p class="catagori-info">
                                        Advanced users searching for a Bitcoin mobile digital wallet, should look no further than mycelium. 
                                        The Mycelium mobile wallet allows iPhone and Android users to send and receive bitcoins and keep 
                                        complete control over bitcoins. No third party can freeze or lose your funds! With enterprise-level 
                                        security superior to most other apps and features like cold storage and encrypted PDF backups, 
                                        an integrated QR-code scanner receive bitcoins and keep.
                                    </p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="base-color">Pros: </h5>
                                            <p>Good privacy, advanced security, feature-rich, open source Software, free</p>
                                        </div>
                                        <div class="cons-block">
                                            <h5 class="base-color">Cons: </h5>
                                            <p>No web or desktop interface, hot wallet, not for beginners</p>
                                        </div>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_copay">
                                <div class="catagori-content">
                                    <img src="./images/others/6.png" alt="img" class="img-responsive">
                                    <p class="catagori-info">
                                        Advanced users searching for a Bitcoin mobile digital wallet, should look no further than mycelium. 
                                        The Mycelium mobile wallet allows iPhone and Android users to send and receive bitcoins and keep 
                                        complete control over bitcoins. No third party can freeze or lose your funds! With enterprise-level 
                                        security superior to most other apps and features like cold storage and encrypted PDF backups, 
                                        an integrated QR-code scanner receive bitcoins and keep.
                                    </p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="base-color">Pros: </h5>
                                            <p>Good privacy, advanced security, feature-rich, open source Software, free</p>
                                        </div>
                                        <div class="cons-block">
                                            <h5 class="base-color">Cons: </h5>
                                            <p>No web or desktop interface, hot wallet, not for beginners</p>
                                        </div>
                                    </div>
                                </div><!-- catagori-content -->
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="nav_nano">
                                <div class="catagori-content">
                                    <img src="./images/others/6.png" alt="img" class="img-responsive">
                                    <p class="catagori-info">
                                        Advanced users searching for a Bitcoin mobile digital wallet, should look no further than mycelium. 
                                        The Mycelium mobile wallet allows iPhone and Android users to send and receive bitcoins and keep 
                                        complete control over bitcoins. No third party can freeze or lose your funds! With enterprise-level 
                                        security superior to most other apps and features like cold storage and encrypted PDF backups, 
                                        an integrated QR-code scanner receive bitcoins and keep.
                                    </p>
                                    <div class="pros-cons-block">
                                        <div class="pros-block">
                                            <h5 class="base-color">Pros: </h5>
                                            <p>Good privacy, advanced security, feature-rich, open source Software, free</p>
                                        </div>
                                        <div class="cons-block">
                                            <h5 class="base-color">Cons: </h5>
                                            <p>No web or desktop interface, hot wallet, not for beginners</p>
                                        </div>
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

    <div class="activity-section">
        <div class="container">
            <div class="row wallet-trx">

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
                                        <div class="exp-user"></div>
                                        <div class="exp-user">For <span><?php echo $row["reason"]; ?></span></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="exp-amt"><span id="tk-amt"><?php echo (number_format($row["amount"])); ?></span> Dlikes</div>
                                </div>
                            </div>
                        </div>
                        <? }
                        } $conn->close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- activity-section -->
          
</div><!-- explorer-section -->
<?php include('template/footer.php'); ?>