<?php include('includes/config.php'); include('template/header.php'); ?>
<div style="padding-top: 60px;background: #220f58;">
    <div class="col-md-12"><div class="container banner-content explorer-form" style="padding: 15px;">
        <form class="subs-form">
            <div class="input-box expl">
                <input type="text" value="" name="user" class="form-control" id="exp_search" placeholder="Search by dlike username" required />
                <button type="button" class="wallet-search">Search</button>
            </div>
        </form>
    </div></div>
</div>
</div><!-- banner-block -->
<div class="explorer-section" style="margin-bottom: 40px;"><div class="new-ticker-block new-ticker-block-section"><div class="container">
    <div class="new-ticker-block-wrap">
        <div class="ticker-head">
            <ul class="nav nav-tabs ticker-nav" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#favorite_ticker" role="tab" data-toggle="tab">
                        <h5>Latest Transactions</h5>
                        <i class="fa fa-stroopwafel"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#BNB_markets" role="tab" data-toggle="tab">Staking Transactions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#BTC_markets" role="tab" data-toggle="tab">Withdrawals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ETH_markets" role="tab" data-toggle="tab">Top Staking Accounts</a>
                </li>
                <li class="nav-item nav-item-last">
                </li>
            </ul>
        </div>
        <div class="market-ticker-block">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active show" id="favorite_ticker">
                    <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                    <tbody>
                        <?php 
                        $sql_T = $conn->query("SELECT * FROM dlike_transactions ORDER BY trx_time DESC LIMIT 30");
                        if ($sql_T && $sql_T->num_rows > 0) {
                            while ($row_T = $sql_T->fetch_assoc()) {
                                $start_time = strtotime($row_T["trx_time"]); 
                                $dlike_user = $row_T["username"];
                                $tx_type = $row_T["type"];
                                if($tx_type == 'a'){$trx_type = '<i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;author';}elseif($tx_type == 'b'){$trx_type = '<i class="fas fa-coffee"></i>&nbsp;&nbsp;curation';}elseif($tx_type == 'c'){$trx_type = '<i class="fas fa-user"></i>&nbsp;&nbsp;affiliate';}

                                $sql_W = $conn->query("SELECT * FROM dlikeaccounts where username = '$dlike_user'");
                                if ($sql_W && $sql_W->num_rows > 0) { $row_W=$sql_W->fetch_assoc();
                                    $profile_pic = $row_W["profile_pic"];} ?>
                                <tr>
                                    <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $trx_type; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://dlike.io/post/'.$row_T["reason"].'"><i class="fas fa-globe"></i></a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><?php echo time_ago($start_time); ?></td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="BNB_markets">
                    <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                    <tbody>
                        <?php 
                        $sql_T = $conn->query("SELECT * FROM dlike_staking_transactions ORDER BY trx_time DESC LIMIT 30");
                        if ($sql_T && $sql_T->num_rows > 0) {
                            while ($row_T = $sql_T->fetch_assoc()) {
                                $start_time = strtotime($row_T["trx_time"]);$dlike_user = $row_T["username"];$tx_type = $row_T["type"];

                                $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                                if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                                <tr>
                                    <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $tx_type; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://tronscan.org/#/transaction/'.$row_T["tron_trx"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><?php echo time_ago($start_time); ?></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="BTC_markets">
                    <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                    <tbody>
                        <?php 
                        $sql_T = $conn->query("SELECT * FROM dlike_withdrawals ORDER BY req_on DESC LIMIT 30");
                        if ($sql_T && $sql_T->num_rows > 0) {
                            while ($row_T = $sql_T->fetch_assoc()) {
                                $start_time = strtotime($row_T["req_on"]);$dlike_user = $row_T["username"];
                                $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                                if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                                <tr>
                                    <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo '<a href="https://tronscan.org/#/transaction/'.$row_T["status"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad">
                                        <?php echo time_ago($start_time); ?></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="ETH_markets">
                    <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                    <tbody>
                        <?php 
                        $sql_T = $conn->query("SELECT * FROM dlike_staking ORDER BY amount DESC LIMIT 200");
                        if ($sql_T && $sql_T->num_rows > 0) {
                            while ($row_T = $sql_T->fetch_assoc()) {$dlike_user = $row_T["username"];
                                $sql_F=$conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
                                if ($sql_F && $sql_F->num_rows > 0){$row_F=$sql_F->fetch_assoc();$profile_pic=$row_F["profile_pic"];} ?>
                                <tr>
                                    <td class="exp-user wid_2 ex_pad"><span style="justify-content: left;"><?php echo '<img src="'.$profile_pic.'" class="img-fluid ex_img"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span></td>
                                    <td class="exp-amt wid_2 ex_pad"><span><?php echo $row_T["amount"]; ?></span></td>
                                </tr>
                            <?php } 
                        } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div></div></div>
<script type="text/javascript">    $('.wallet-search').click(function() {let user_wallet = $('#exp_search').val();let wallet_url = "https://dlike.io/explorer/" + user_wallet;window.open(wallet_url, "_self");});</script>
<?php include('template/footer.php'); ?>