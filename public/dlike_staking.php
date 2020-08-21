<?php  include('template/header.php');
?> </div>
<?php if(isset($_COOKIE['dlike_username']) && !empty($_COOKIE['dlike_username'])) { $dlike_user =  $_COOKIE['dlike_username']; } else {$dlike_user='';}
if($dlike_user == '') { ?>
<div id="profile_miss"> <div class="container"> <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;"> <div class="modal-content" style="background: #1b1e63;border-radius:14px;"> <div class="modal-body"> <div class="share-block"><p style="font-size: 3rem;">ooops!</p></div> <div class="user-connected-form-block" style="background: #1b1e63;"> <center><i class="fas fa-frown" style="color: #ffff008a;font-size: 4rem;"></i></center> <div class="share-block"><p>You must login with your DLIKE username<br><b><a href="/welcome">Login</a></b></p></div> </div> </div> </div> </div> </div></div> 
<? } else {
$sql_C = $conn->query("SELECT count(*) as total_stakers, SUM(amount) as total_staked_amount FROM dlike_staking");
if ($sql_C->num_rows > 0){$row_C = $sql_C->fetch_assoc();
$total_stakers = $row_C["total_stakers"]; $total_staked_amount = $row_C["total_staked_amount"];
} else {$total_stakers = '0'; $total_staked_amount = '0';}

$sql_Y = $conn->query("SELECT * FROM dlike_rewards_history order by update_time desc limit 1");
if ($sql_Y->num_rows > 0){$row_Y = $sql_Y->fetch_assoc();$yesterday_distribution = $row_Y["dlike_staking"];} else {$yesterday_distribution = '0';}

$sql_M = $conn->query("SELECT * FROM dlike_staking where username='$dlike_user'");
if ($sql_M->num_rows > 0){$row_M = $sql_M->fetch_assoc();$my_staking=$row_M["amount"];$my_staking_wallet=$row_M["tron_address"];} else{$my_staking='0';$my_staking_wallet='';}

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
                    <div style="width: 100%"><h4 class="m-0"><small>Staked Amount</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $total_staked_amount; ?> DLIKE</strong></div></div>
                    </div>
                </div>
            </div></div>
            <div class="col-sm-6 col-lg-3"><div class="card p-3">
                <div class="d-flex align-items-center">
                    <span class="stamp stamp-md bg-green mr-3"><i class="fas fa-exchange-alt"></i></span>
                    <div style="width: 100%"><h4 class="m-0"><small>Yesterday Distributed</small></h4><div class="clearfix"><div class="float-left"><strong class="voting-power-display"><?php echo $yesterday_distribution; ?> DLIKE</strong></div></div>
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
                             <div class="container">
                                <div id="unskae_row" class="row" style="margin-top:55px;justify-content:center;">
                                    <div id="stake_sub" style="width: 90%;"><p>Loading...</p></div>
                                </div>
                                <div id="unstake_row" class="row" style="margin-top:55px;justify-content:center; display: none;">
                                    <div id="stake_sub" style="width: 90%;">
                                        <div class="form-group"><input type="number" class="form-control" name="unstakeamount" id="unstakeamount" placeholder="Amount to UnStake"></div>
                                        <center><button type="button" class="btn btn-primary" id="unstake_me"style="width: 30%;">Unstake</button></center>
                                    </div>
                                </div>
                                <div id="unstake_timer_row" class="row" style="margin-top: 55px;justify-content: center; display: none;">
                                    <div id="stake_sub" style="width: 90%;">
                                        <div class="form-group"><b>Pending Unstake Tokens: </b><span id="unstakingAmount">0</span> DLIKE</div>
                                        <div class="form-group"><b>Availble to claim after: </b><span id="unstakingTimer">00 : 00 : 00</span></div>
                                        <div style="color: #c51d24;"><b>You can initiate new unstake once old one is matured!</b></div>
                                    </div>
                                </div>
                                <div id="unstake_claim_row" class="row" style="margin-top: 55px;justify-content: center; display: none;">
                                    <div id="stake_sub" style="width: 90%;">
                                         <center><button type="button" class="btn btn-primary" id="claimback_tokens"><span class="claimback_tk">Claim Unstaked Tokens</span></button></center>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <thead><tr><th scope="col">Amount</th><th scope="col">Type</th><th scope="col">Trx ID</th><th scope="col">Time</th></tr></thead>
                    <tbody>
                        <?php $sql_st = $conn->query("SELECT * FROM dlike_staking_transactions where username = '$dlike_user' ORDER BY trx_time DESC Limit 30");
                            if ($sql_st->num_rows > 0) {
                                while($row_t = $sql_st->fetch_assoc()) {?> 
                        <tr>
                            <td><?php echo $row_t["amount"]; ?></td><td><?php echo $row_t["type"]; ?></td>
                            <td><?php echo '<a href="https://shasta.tronscan.org/#/transaction/'.$row_t["tron_trx"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>';?></td><td><?php echo date('Y-m-d', strtotime($row_t["trx_time"])); ?></td> 
                        </tr>
                        <? } }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  
<? } ?>  
<div class="modal fade" id="stakingStatus" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom">
<div class="modal-body "><div class="mdStatusTitle sttError iconTitle"><i class="fa fa-spinner fa-pulse"></i></div><div class="mdStatusContent"><h3 id="alert-title-error"><span class="st_status_message">Waiting For Confirmation</span></h3><div id="alert-content-error"><b><span class="st_trx_link"></span></b></div><div class="actBtn"><button type="button" class="btn btn-danger st_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button></div></div></div>
</div></div></div>
<?php include('template/footer.php'); ?>
<script type="text/javascript">
function enable_unstake(){$("#unstake_me").attr("disabled", false).html('Unstake');}
function enable_stake(){$("#stake_me").attr("disabled", false).html('Stake');}
function pad(n) {return (n < 10 ? '0' : '') + n;}
async function getUserStatus() {var user_address =false;
    if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        if(user_address!=false){     
            var myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
            var myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
            var isUnstaking = await myContract.isUnstaking(user_address).call();
            var unstakeTime = window.tronWeb.toDecimal(isUnstaking[0]);isUnstaking = isUnstaking[1]; 
            var unstakingAmount = await myContract.checkUnstake(user_address).call();
            unstakingAmount = window.tronWeb.toDecimal(unstakingAmount) / 1e6;
            if(isUnstaking==true){
                $('#unskae_row').hide();$('#unstake_timer_row').show();
                $('#unstakingAmount').html(unstakingAmount);
                $('.claimback_tk').html('Claim '+unstakingAmount+ ' unstaked Tokens');
                var days, hours, minutes, seconds; // variables for time units
                var countdown = document.getElementById("unstakingTimer"); // get tag element
                var countdownStart = setInterval(function(){getCountdown()}, 1000);
                countdownStart ;
                function getCountdown(){
                    var current_date = new Date().getTime();var target_date = unstakeTime * 1000;
                    if(current_date>target_date){$('#unstake_claim_row').show();$('#unstake_timer_row').hide();$('#unskae_row').hide();clearInterval(countdownStart);return false;}

                    var seconds_left = (target_date - current_date) / 1000;
                    days = pad( parseInt(seconds_left / 86400) );seconds_left = seconds_left % 86400;
                    hours = pad( parseInt(seconds_left / 3600) );seconds_left = seconds_left % 3600;      
                    minutes = pad( parseInt(seconds_left / 60) );seconds = pad( parseInt(seconds_left % 60));
                    
                    if(seconds_left<=0){clearInterval(countdownStart);
                        countdown.innerHTML = "<span>00</span> : <span>00</span> : <span>00</span>";
                        $('#unstake_claim_row').show();$('#unstake_timer_row').hide();
                    }else{$('#unskae_row').hide();$('#unstake_timer_row').show();  
                        countdown.innerHTML = "<span>" + days + " Day <span>" + hours + "</span> : <span>" + minutes + "</span> : <span>" + seconds + "</span>";    }
                }
            } else{$('#unskae_row').hide();$('#unstake_row').show();}         
        }
    }else{$('#unskae_row').hide();$('#unstake_row').show();} 
}
setTimeout(getUserStatus,600);
$('.st_btn').click(function() {setTimeout(function(){window.location.reload();}, 100);});

$('#stake_me').click(async function() {
    if (dlike_username != null) {
        let user_address =false;
        if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        }else{toastr.error('Non-Tronlink browser detected. You should use Tronlink Wallet!');return false;}
        if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;} else {
            $("#stake_me").attr("disabled", true).html('staking...');
            let stk_amt = $('#stakeamount').val();let stk_wallet = '<?php echo $my_staking_wallet; ?>';
            if (stk_amt == "") {toastr.error('phew... Please enter the amount you want to stake');enable_stake();return false;}
            if(stk_wallet !=""){
                if (user_address != stk_wallet) {toastr.error('phew... You last stake is with different Tron address. Please unstake that or use same address for additional stake!');enable_stake();return false;}
            }
            var myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
            var myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
            var balanceof = await myContract.balanceOf(user_address).call();
            balanceof = window.tronWeb.toDecimal(balanceof);stk_amt = stk_amt * 1e6;

            if(parseFloat(stk_amt) <=balanceof){
                await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                let result = await myContract.stakeIn(stk_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
                if(result){
                    $('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                        $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                            if(status=='success'){var tx_result = data.data[0].ret[0].contractRet;  
                                if(tx_result=='SUCCESS'){
                                    $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'staking',amount: stk_amt,wallet: user_address,trx_id: result},});
                                    $(".st_status_message").html('Tokens Staked Successfully!');
                                    $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');setTimeout(function(){window.location.reload();}, 1000);
                                }else{$(".st_status_message").html('Something Wrong ! Try Again.');
                                    $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');setTimeout(function(){window.location.reload();}, 1000);}
                            } 
                        }); 
                    }, 12000);
                } else {toastr.error('some issue in staking.');enable_stake();return false;}
            }else{toastr.error('phew... Not enough amount you want to stake');enable_stake();return false;}
        }
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});



$('#unstake_me').click(async function() {
if (dlike_username != null) {var user_address =false;
    if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;            
        }else{ $("#unstake_me").attr("disabled", true).html('unstaking...');let unstk_amt = $('#unstakeamount').val();let stk_wallet = '<?php echo $my_staking_wallet; ?>';
            if (unstk_amt=="") {toastr.error('phew... Please enter the amount you want to unstake');enable_unstake();return false;}
            if(stk_wallet==""){toastr.error('Hey ' +dlike_username +'! It seems you have not staked any tokens yet!');enable_unstake();return false;}
            var myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
            var myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
            var stakedAmount = await myContract.checkStake(user_address).call();
            stakedAmount = window.tronWeb.toDecimal(stakedAmount);unstk_amt = unstk_amt * 1e6;
            if(parseFloat(unstk_amt) <=stakedAmount){
                if (user_address != stk_wallet) {toastr.error('Hey ' +dlike_username +'! You are staking with a different Tron address');enable_unstake();return false;}
                await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                    var result = await myContract.stakeOut(unstk_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
                    if(result){$('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                    $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                        if(status=='success'){var tx_result = data.data[0].ret[0].contractRet;  
                            if(tx_result=='SUCCESS'){
                                $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'unstaking',amount: unstk_amt,wallet: user_address,trx_id: result},});
                                $(".st_status_message").html('UnStaking Initiated Successfully!');
                                $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');setTimeout(function(){window.location.reload();}, 1000);
                            }else{$(".st_status_message").html('Something Wrong! Try Again.');
                                $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');setTimeout(function(){window.location.reload();},1000);}
                        }
                    }); 
                    }, 12000);}
            }else{toastr.error('phew... Not enough amount you want to unstake');enable_unstake();return false;}
        }
    }else{ toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');}
} else {toastr.error('You must be login with DLIKE username!');return false;}
});


$('#claimback_tokens').click(async function() {var user_address =false;
    if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;                
        }else{ $("#claimback_tokens").attr("disabled", true).html('processing...');
            var myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
            var myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
            var unstakingAmount = await myContract.checkUnstake(user_address).call();
            unstakingAmount = window.tronWeb.toDecimal(unstakingAmount);
            await new Promise((resolve, reject) => setTimeout(resolve, 400));
            var result = await myContract.claimStakeOut(unstakingAmount).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
            if(result){$('#stakingStatus').modal('show');
                $(".st_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                var x = setInterval(function() {
                $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                    if(status=='success'){var tx_result = data.data[0].ret[0].contractRet;  
                        if(tx_result=='SUCCESS'){
                            $(".st_status_message").html('Tokens Claimed Successfully!');
                            $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');setTimeout(function(){window.location.reload();}, 1000);
                        }else{$(".st_status_message").html('Something Wrong! Try Again.');
                            $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');setTimeout(function(){window.location.reload();}, 1000);
                        }
                    }
                }); 
                }, 11000);
            }
        }
    }else{toastr.error('Non-Tronlink browser detected. You should use Tronlink Wallet!');}
});


$('#claim_stk_reward').click(async function() {
    if (dlike_username != null) {
        let claim_amt = $('#claimeamount').val();
        if (claim_amt == "") {toastr.error('phew... Claim amount not valid');return false;}
         
        async function doAjax() {return $.ajax({type: 'post',url: '/helper/staking.php',data: { action : 'claim_stake',claim_amount: claim_amt },datatype: 'json',});
        }
        doAjax().then(async function(data) { var response = JSON.parse(data);
            if (response.error == true) {toastr['error'](response.message);return false;}
            else{let user_address =false;
                if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
                }else{toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');return false;}
                let my_wallet = '<?php echo $my_staking_wallet; ?>';
                if(my_wallet==""){toastr.error('Hey ' +dlike_username +'! It seems you have not staked any tokens yet!');return false;}
                if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;
                } else { 
                    $.ajax({type: 'post',url:'/helper/staking.php',data:{action : 'pay_staking_reward',claim_amount: claim_amt,wallet: user_address},});
                    claim_amt = claim_amt * 1e6;
                    let myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
                    let myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
                    if (user_address != my_wallet) {toastr.error('Hey ' +dlike_username +'! You are staking with a different Tron address');return false;}
                    await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                    let result = await myContract.getReward(claim_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });console.log(result);
                    if(result){$('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                    $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                        if(status=='success'){var tx_result = data.data[0].ret[0].contractRet;  
                            if(tx_result=='SUCCESS'){
                                $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'reward_paid',amount: claim_amt,wallet: user_address,trx_id: result},});
                                $(".st_status_message").html('Stakign Reward Claimed Successfully!');
                                $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');setTimeout(function(){window.location.reload();}, 1000);
                            }else{$(".st_status_message").html('Something Wrong! Try Again.');
                                $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');setTimeout(function(){window.location.reload();}, 1000);
                            }
                        }
                    }); 
                    }, 12000);}
                }

            }
        });
    } else {toastr.error('You must be login with DLIKE username!');return false;}
});
</script>