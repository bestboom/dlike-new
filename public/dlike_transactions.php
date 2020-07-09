<?php include('template/header5.php'); ?>
<div class="container explorer-top">
    <div class="col-md-12">
        <div class="banner-content explorer-form">
            <form action="/wallets.php" class="subs-form">
                <div class="input-box expl">
                    <input type="text" value="" name="user" class="form-control" id="exp_search" placeholder="Search by steem username for token / transactions" required />
                    <button type="button" class="wallet-search">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- banner-block -->
<div class="explorer-section">
    <div class="support-category-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="support-category-block">
                        <h4>Max Tokens Supply</h4>
                        <h5>800M</h5>
                        <hr>
                        <h4>Available Tokens Supply</h4>
                        <h5>400M</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    $sql = "SELECT sum(amount) as total FROM wallet";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) { ?>
                        <div class="support-category-block">
                            <h4>Total Distributed</h4>
                            <h5><?php echo (number_format($row['total'])); ?></h5>
                        <? }?>
                        <hr>
                        <?php
                        $sqlu = "SELECT COUNT(username) as users FROM wallet";
                        $resultIt = $conn->query($sqlu);
                        while($row = $resultIt->fetch_assoc()) { ?>
                            <h4>Total Token holders</h4>
                            <h5><?php echo (number_format($row['users'])); ?></h5>
                        <? } ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="support-category-block">
                        <h4>Looking For Free Tokens</h4>
                        <h5>Promote Dlike</h5>
                        <h5></h5>
                        <h5>Contact With Support</h5>
                        <a class="sup-icon" href="https://discord.gg/JYSkBFk"><i class="fab fa-discord"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="activity-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-title"><h4>Latest Transactions</h4></div>
                        </div>
                        <table class="table coin-list table-hover" style="border: 1px solid #eee;">
                        <!--<thead>
                            <tr>
                                <th scope="col" class="cent_me wid_2">Username</th>
                                <th scope="col" class="cent_me wid_2">Type</th>
                                <th scope="col" class="cent_me wid_2">Amount</th>
                                <th scope="col" class="cent_me wid_2">For</th>
                                <th scope="col" class="cent_me wid_2">Time</th>
                            </tr>
                        </thead>-->
                        <tbody>
                            <?php 
                            $sql_T = "SELECT * FROM dlike_transactions ORDER BY trx_time DESC LIMIT 30";
                            $result_T = $conn->query($sql_T);
                            if ($result_T && $result_T->num_rows > 0) {
                                while ($row_T = $result_T->fetch_assoc()) {
                                    $start_time = strtotime($row_T["trx_time"]); 
                                    $dlike_user = $row_T["username"];
                                    $tx_type = $row_T["type"];
                                    if($tx_type == 'a'){$trx_type = '<i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;author';}elseif($tx_type == 'b'){$trx_type = '<i class="fas fa-coffee"></i>&nbsp;&nbsp;curation';}elseif($tx_type == 'c'){$trx_type = '<i class="fas fa-user"></i>&nbsp;&nbsp;affiliate';}


                                    $sql_W = "SELECT * FROM dlikeaccounts where username = '$dlike_user'";
                                    $result_W = $conn->query($sql_W);
                                    if ($result_W && $result_W->num_rows > 0)
                                    {
                                        $profile_pic = $row_W["profile_pic"];
                                        if (!empty($profile_pic))
                                        { $user_profile_pic = $profile_pic; } else { $user_profile_pic = 'https://i.postimg.cc/rwbTkssy/dlike-user-profile.png';}
                                    }
                                    ?>
                                    <tr>
                                        <td class="exp-user wid_2" style="padding: 12px 22px;">
                                            <span style="justify-content: left;"><?php echo '<img src="'.$user_profile_pic.'" style="padding-right:10px;width: 32px;"><a href="/profile/'. $dlike_user.'">'. $dlike_user.'</a>'; ?></span>
                                        </td>
                                        <td class="exp-amt wid_2" style="padding: 12px 22px;">
                                            <span><?php echo $trx_type; ?></span>
                                        </td>
                                        <td class="exp-amt wid_2" style="padding: 12px 22px;">
                                            <span><?php echo $row_T["amount"]; ?></span>
                                        </td>
                                        <td class="exp-amt wid_2" style="padding: 12px 22px;">
                                            <span><?php echo '<a href="https://dlike.io/post/'.$row_T["reason"].'"><i class="fas fa-globe"></i></a>'; ?></span>
                                        </td>
                                        <td class="exp-amt wid_2" style="padding: 12px 22px;">
                                            <?php echo time_ago($start_time); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>

            </div>
        </div>
    </div><!-- activity-section -->

</div><!-- explorer-section -->
<?php include('template/dlike_footer.php'); ?>