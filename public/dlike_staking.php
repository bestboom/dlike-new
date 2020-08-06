<?php  include('template/header7.php');
?> </div>
<?php if(isset($_COOKIE['dlike_username']) && !empty($_COOKIE['dlike_username'])) { $dlike_user =  $_COOKIE['dlike_username']; } else {$dlike_user='';}
if($dlike_user == '') { ?>
<div id="profile_miss">
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">   
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block"><p style="font-size: 3rem;">ooops!</p></div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                        <center><i class="fas fa-frown" style="color: #ffff008a;font-size: 4rem;"></i></center>
                        <div class="share-block"><p>You must login with your DLIKE username<br><b><a href="/welcome">Login</a></b></p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<? } else {
$sql_C = $conn->query("SELECT count(*) as total_stakers, SUM(amount) as total_staked_amount FROM dlike_staking");
if ($sql_C->num_rows > 0){$row_C = $sql_C->fetch_assoc();
$total_stakers = $row_C["total_stakers"]; $total_staked_amount = $row_C["total_staked_amount"];
} else {$total_stakers = '0'; $total_staked_amount = '0';}

$sql_Y = $conn->query("SELECT * FROM dlike_rewards_history order by update_time desc limit 1");
if ($sql_Y->num_rows > 0){$row_Y = $sql_Y->fetch_assoc();$yesterday_distribution = $row_Y["dlike_staking"];} else {$yesterday_distribution = '0';}

$sql_M = $conn->query("SELECT * FROM dlike_staking where username='$dlike_user'");
if ($sql_M->num_rows > 0){$row_M = $sql_M->fetch_assoc();$my_staking=$row_M["amount"];$my_staking_wallet=$row_M["tron_address"];} else{$my_staking='0';}

$sql_Q = $conn->query("SELECT * FROM dlike_staking_rewards where username='$dlike_user'");
if ($sql_Q->num_rows > 0){$row_Q = $sql_Q->fetch_assoc();$my_rewards=$row_Q["reward"];} else{$my_rewards='0';}
?>
<div class="working-process-section" style="padding: 40px 0 60px;">
    <div class="container">
        <div class="row row-cards" style="margin-top:40px;">
            <div class="col-sm-6 col-lg-3"><div class="queue-stats card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-blue mr-3"><i class="fa fa-check"></i></span>
                    <div style="width: 100%"><h4 class="m-0"><small>My Staking</small></h4>
                        <div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $my_staking; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-orange mr-3"><i class="fa fa-list"></i></span>
                    <div style="width: 100%"><h4 class="m-0"><small>Total Stakers</small></h4>
                        <div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $total_stakers; ?></strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="bot-power card p-3">
                <div id="voting-power" class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3"><i class="fa fa-cubes"></i></span>
                    <div style="width: 100%"><h4 class="m-0"><small>Staked Amount</small></h4>
                        <div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $total_staked_amount; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3"><i class="fa fa-exchange"></i></span>
                    <div style="width: 100%"><h4 class="m-0"><small>Yesterday Distributed</small></h4>
                        <div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $yesterday_distribution; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
        </div>
        <div class="row" style="margin-top: 70px;">
            <div class="col-lg-6  col-md-6">
                <div class="working-process">
                    <ul class="working-process-list">
                        <li><div class="working-process-step">
                                <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  DLIKE Staking</h4>
                                <div class="process-details"><p>20% reward out of every DLIKE token generated through likes on shared links is reserved for staking. This reward is distributed among tp 200 stakers by volume. This number will gradually grow to 1000.</p></div>
                        </div></li>
                        <li><div class="working-process-step">
                                <h4><span class="fas fa-hand-point-right" style="padding-right: 10px;"></span>  How to Stake?</h4>
                                <div class="process-details"><p>Simply login with Tronlink and stake the amount of tokens you want. You agree to freeze these tokens for 7 days as rewards on these staked tokens are distributed on daily basis.</p></div>
                        </div></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-6">
                <div class="ticker-head">
                    <ul class="nav nav-tabs ticker-nav prof-nav" role="tablist">
                        <li class="nav-item"><a class="nav-link active show" href="#stake_dlike" role="tab" data-toggle="tab" aria-selected="true"><h5>Stake</h5></a></li>
                        <li class="nav-item"><a class="nav-link" href="#unstake_dlike" role="tab" data-toggle="tab">Unstake</a></li>
                        <li class="nav-item"><a class="nav-link" href="#claim_dlike" role="tab" data-toggle="tab">Claim</a></li>
                        <li class="nav-item nav-item-last"></li>
                    </ul>
                </div>
                <div class="market-ticker-block" style="border: 1px solid #191d5d !important;border-top: none;padding-bottom: 50px;">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active show" id="stake_dlike">
                            <div class="container"><div class="row" style="margin-top:55px;justify-content: center;">
                                <div id="stake_sub" style="width: 90%;"> 
                                    <div class="form-group"><input type="number" class="form-control" name="stakeamount" id="stakeamount" placeholder="Amount to Stake"></div>
                                    <center><button type="button" class="btn btn-primary" id="stake_me" style="width: 30%;">Stake</button></center>
                                </div>
                        </div></div></div>
                        <div role="tabpanel" class="tab-pane fade" id="unstake_dlike">
                            <div class="container"><div class="row" style="margin-top: 55px;justify-content: center;">
                                <div id="stake_sub" style="width: 90%;">
                                    <div class="form-group"><input type="number" class="form-control" name="unstakeamount" id="unstakeamount" placeholder="Amount to UnStake"></div>
                                    <center><button type="button" class="btn btn-primary" id="unstake_me"style="width: 30%;">Unstake</button></center>
                                </div>
                        </div></div></div>
                        <div role="tabpanel" class="tab-pane fade" id="claim_dlike">
                            <div class="container"><div class="row" style="margin-top: 55px;justify-content: center;">
                                <div id="stake_sub" style="width: 90%;">
                                    <div class="form-group"><input type="number" class="form-control" name="claimamount" id="claimeamount" placeholder="Claim" readonly="readonly" value="<?php echo $my_rewards; ?>"></div>
                                    <center><button type="button" class="btn btn-primary" id="claim_stk_reward"style="width: 30%;">Claim</button></center>
                                </div>
                        </div></div></div>
                </div></div>
            </div>
        </div>
    </div>
</div>
<div class="latest-tranjections-area">
    <div class="latest-tranjections-block">
        <div class="container">
            <div class="latest-tranjections-block-inner">
                <div class="panel-heading-block"><h5>Transaction History</h5></div>
                <table class="table coin-list latest-tranjections-table">
                    <thead>
                        <tr>
                            <th scope="col">Amount Staked</th>
                            <th scope="col">Username</th>
                            <th scope="col">Type</th>
                            <th scope="col">Time Staked</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sql_st = $conn->query("SELECT * FROM dlike_staking_transactions where username = '$dlike_user' ORDER BY amount DESC Limit 30");
                            if ($sql_st->num_rows > 0) {
                                while($row_t = $sql_st->fetch_assoc()) {?> 
                        <tr>
                            <td><?php echo $row_t["amount"]; ?></td>
                            <td><?php echo $row_t["type"]; ?></td>
                            <td><?php echo '<a href="https://shasta.tronscan.org/#/transaction/'.$row_t["tron_trx"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($row_t["trx_time"])); ?></td> 
                        </tr>
                        <? } }?>
                    </tbody>
                </table>
            </div><!-- order-history-block-inner -->
        </div>
    </div>
</div>  
<? } ?>  
<div class="modal fade" id="stakingStatus" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom">
<div class="modal-body "><div class="mdStatusTitle sttError iconTitle"><i class="fa fa-spinner fa-pulse"></i></div><div class="mdStatusContent"><h3 id="alert-title-error"><span class="st_status_message">Waiting For Confirmation</span></h3><div id="alert-content-error"><b><span class="st_trx_link"></span></b></div><div class="actBtn"><button type="button" class="btn btn-danger st_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button></div></div></div>

</div></div></div>
<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
$('.st_btn').click(function() {setTimeout(function(){window.location.reload();}, 100);});
$('#stake_me').click(async function() {
    if (dlike_username != null) {
        let user_address =false;
        if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
            console.log(user_address)
        }else{toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');return false;}
        if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;} else {
            $("#stake_me").attr("disabled", true).html('staking...');
            let stk_amt = $('#stakeamount').val();let stk_wallet = '<?php echo $my_staking_wallet; ?>';
            if (stk_amt == "") {toastr.error('phew... Please enter the amount you want to stake');$("#stake_me").attr("disabled", false).html('stake');return false;}
            if (stk_amt < 1) {toastr.error('phew... Stake Minimum 1 Token');$("#stake_me").attr("disabled", false).html('stake');return false;}
            if(stk_wallet !=""){
            if (user_address != stk_wallet) {toastr.error('phew... You last stake is with different Tron address. Please unstake that or use same address for additional stake!');$("#stake_me").attr("disabled", false).html('stake');return false;}}
            $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'validate_add',wallet: user_address},
                success: async function(data) {var response = JSON.parse(data)
                if (response.error == true) {toastr.error(response.message);return false;
                } else {
                    var myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
                    var myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
                    var balanceof = await myContract.balanceOf(user_address).call();
                    balanceof = window.tronWeb.toDecimal(balanceof);
                    console.log(balanceof); 
                    stk_amt = stk_amt * 1e6;

                    if(parseFloat(stk_amt) <=balanceof){
                        await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                        let result = await myContract.stake(stk_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
                        console.log(result);
                        if(result){
                            $('#stakingStatus').modal('show');
                            $(".st_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                            var x = setInterval(function() {
                                $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                                    if(status=='success'){
                                        var tx_result = data.data[0].ret[0].contractRet;  
                                        if(tx_result=='SUCCESS'){
                                            $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'staking',amount: stk_amt,wallet: user_address,trx_id: result},
                                            });
                                            $(".st_status_message").html('Tokens Staked Successfully!');
                                            $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');
                                            setTimeout(function(){window.location.reload();}, 1000);
                                        }else{
                                            $(".st_status_message").html('Something Wrong ! Try Again.');
                                            $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');
                                            setTimeout(function(){window.location.reload();}, 1000);
                                        }
                                    } 
                                }); 
                            }, 15000);
                            //$.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'staking',amount: stk_amt,wallet: user_address,trx_id: result},
                              //  success: function(data) {
                                //    try { var response = JSON.parse(data)
                                //        if (response.error == true) {toastr.error(response.message);return false;
                                //        } else {toastr.success(response.message);setTimeout(function(){window.location.reload();}, 400);}
                                //    } catch (err) {toastr.error('Sorry. Server response is malformed.');}
                               // }
                            //});
                        //toastr.success('You Staked Token Successfully.');
                        } else {toastr.error('some issue in staking.');$("#stake_me").attr("disabled", false).html('stake');return false;}
                    }else{toastr.error('phew... Not enough amount you want to stake');$("#stake_me").attr("disabled", false).html('Stake');return false;}
                }}
            });
        }
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});

$('#unstake_me').click(function() {
    if (dlike_username != null) {
        let unstk_amt = $('#unstakeamount').val();
        if (unstk_amt == "") {toastr.error('phew... Please enter the amount you want to unstake');return false;}
         
        $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'unstaking',unstake_amount: unstk_amt},
            success: function(data) {
                try { var response = JSON.parse(data)
                    if (response.error == true) {toastr.error(response.message);return false;
                    } else {toastr.success(response.amt);
                        toastr.success(response.id);gettronweb();
                    }
                } catch (err) {toastr.error('Sorry. Server response is malformed.');}
            }
        });
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});


$('#claim_stk_reward').click(function() {
    if (dlike_username != null) {
        let claim_amt = $('#claimeamount').val();
        if (claim_amt == "") {toastr.error('phew... Claim amount not valid');return false;}
         
        $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'claim_stake',claim_amount: claim_amt},
            success: function(data) {
                try { var response = JSON.parse(data)
                    if (response.error == true) {toastr.error(response.message);return false;
                    } else {toastr.success(response.amt);
                        toastr.success(response.id);gettronweb();
                    }
                } catch (err) {toastr.error('Sorry. Server response is malformed.');}
            }
        });
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});
    
</script>