<?php include('template/header7.php'); 
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/","_self")</script>');
} else {
    $dlike_user = $_COOKIE['dlike_username'];
}
?>
<style type="text/css">
    .stamp-md {min-width: 2rem;height: 2rem;line-height: 2rem;}
    .stamp {color: #fff;background: #868e96;display: inline-block;padding: 0 .2rem;text-align: center;border-radius: 3px;font-weight: 600;}
    .mr-3, .mx-3 {margin-right: 0.75rem !important;}
    .bg-orange {background-color: #fd9644 !important;}
    .bg-green {background-color: #5eba00 !important;}
    .bg-blue {background-color: #467fcf !important;}
</style>
</div>
<?php
$sql_B = $conn->query("SELECT amount FROM dlike_wallet where username='$dlike_user'");
$row_B = $sql_B->fetch_assoc();
$my_bal = $row_B["amount"];

$sql_A = $conn->query("SELECT count( DISTINCT(username) ) as rferrals FROM dlikeaccounts where refer_by='$dlike_user'");
$row_A = $sql_A->fetch_assoc();
$my_affiliates = $row_A["rferrals"];

$sql_I = $conn->query("SELECT sum(amount) as total_income FROM dlike_transactions where username='$dlike_user' and  DATE(trx_time) = CURDATE()");
$row_I = $sql_I->fetch_assoc();
$today_income = $row_I["total_income"];
if($today_income > 0) {$today_income = $today_income;}else{$today_income='0';}

$sql_J = $conn->query("SELECT * FROM dlikeaccounts where username='$dlike_user'");
$row_J = $sql_J->fetch_assoc();$offchain_address = $row_J["offchain_address"];
?>
<div class="working-process-section" style="padding-top: 80px;">
    <div class="container"><div class="row">
        <div class="offset-lg-1 col-lg-5 col-md-6">
            <div class="user-connected-form-block" style="box-shadow: 0px 0px 10px 1px #cccccc;">
                <h3 style="text-align: center;"><div style="font-size: 1.1rem;">DLIKE Wallet</div></h3>
                <form class="user-connected-from create-account-form reward_form" />
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | My Balance" readonly>
                    <span class="fas fa-database inp_icon"></span>
                    <span class="inp_text"><?php echo $my_bal; ?></span>
                </div>
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | Income Today" readonly>
                    <span class="fas fa-bolt inp_icon"></span>
                    <span class="inp_text"><?php echo $today_income; ?></span>
                </div>
                <div class="form-group reward_fileds">
                    <input type="text" class="form-control reward_input" value=" | My Affiliates" readonly>
                    <span class="fas fa-flask inp_icon"></span>
                    <span class="inp_text"><?php echo $my_affiliates; ?></span>
                </div><br>
                <p>One Withdrawal per 24 hours!</p>
                <button type="button" class="btn btn-default withd_btn">Withdraw</button>
                <p class="DlikeComments">Max Daily withdrawal limit 5000 DLIKE</p>
                </form>
            </div>
        </div>
        <div class="col-lg-6  col-md-6">
            <div class="working-process">
                <h4 class="pool_head">Tools</h4>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-orange mr-3"><i class="fas fa-money-bill-alt"></i></span>
                            <div>
                                <h4 class="m-0"><small>Off-Chain Wallet Address</small></h4>
                                <small class="row queue-stats-display text-muted" style="margin: 0px !important;">
                                    <?php if(!empty($offchain_address)){ echo $offchain_address; } else { ?>
                                    <span><input type="text" class="form-control" style="border:none;border-bottom: 1px solid #ccc;" id="offchain_add" value="" /></span><span class="stamp stamp-md bg-green mr-3" style="margin-left: 10px;"><i class="fa fa-plus add_address" style="cursor: pointer;"></i></span> <? } ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-blue mr-3"><i class="fa fa-list"></i></span>
                            <div>
                                <h4 class="m-0"><small>My Affiliate Link</small></h4>
                                <small class="queue-stats-display text-muted"><b><?php echo '<a href="https://dlike.io/welcome/'.$dlike_user.'" style="color: #467fcf;">https://dlike.io/welcome/'.$dlike_user.'</a>'; ?></b></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-12" style="margin-bottom: 25px;">
                    <div class="queue-stats card p-3"><div class="d-flex align-items-center">
                            <span class="stamp stamp-md bg-green mr-3"><i class="fa fa-battery-full"></i></span>
                            <div>
                                <h4 class="m-0"><small>Boost Posts</small></h4>
                                <small class="queue-stats-display text-muted">Post boost feature will be available soon</small>
                            </div>
                    </div></div>
                </div>
            </div>
        </div>
    </div></div>
</div>
<div class="container"><div class="row">
<div class="col-md-6"><div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>Transactions</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr>
                <th scope="col">Amount</th><th scope="col">Type</th><th scope="col">For</th><th scope="col" style="float:right;">Time</th>
            </tr></thead>
            <tbody>
                <?php $sql_T = $conn->query("SELECT * FROM dlike_transactions where username ='$dlike_user' ORDER BY trx_time DESC LIMIT 30");
                    if ($sql_T->num_rows > 0) { while($row_T = $sql_T->fetch_assoc()) { 
                        $entry_date = strtotime($row_T["trx_time"]); 
                        $tx_type = $row_T["type"];
                        if($tx_type == 'a'){$trx_type = 'author';}elseif($tx_type == 'b'){$trx_type = 'curation';}elseif($tx_type == 'c'){$trx_type = 'affiliate';}?> 
                <tr>
                    <td><?php echo $row_T["amount"]; ?></td>
                    <td><?php echo $trx_type ?></td>
                    <td><?php echo '<a href="https://dlike.io/post/'.$row_T["reason"].'"><i class="fas fa-globe"></i></a>'; ?></td>
                    <td style="float:right;"><?php echo time_ago($entry_date); ?></td> 
                </tr><? } }?>
            </tbody>
        </table>
    </div>
</div></div></div></div>
<div class="col-md-6"><div class="latest-tranjections-area"><div class="latest-tranjections-block"><div class="container">
    <div class="latest-tranjections-block-inner">
        <div class="panel-heading-block"><h5>Withdrawals</h5></div>
        <table class="table coin-list latest-tranjections-table">
            <thead><tr>
                <th scope="col">Amount</th><th scope="col">Status</th><th scope="col" style="float:right;">Time</th>
            </tr></thead>
            <tbody>
                <?php $sql_P = $conn->query("SELECT * FROM dlike_withdrawals where username ='$dlike_user' ORDER BY req_on DESC LIMIT 30");
                    if ($sql_P->num_rows > 0) { while($row_P = $sql_P->fetch_assoc()) { 
                        $entry_date = strtotime($row_P["req_on"]); ?> 
                <tr>
                    <td><?php echo $row_P["amount"]; ?></td>
                    <td><?php echo '<a href="https://shasta.tronscan.org/#/transaction/'.$row_P["status"].'" target="_blank"><i class="fas fa-exchange-alt"></i></a>'; ?></td>
                    <td style="float:right;"><?php echo time_ago($entry_date); ?></td> 
                </tr><? } }?>
            </tbody>
        </table>
    </div>
</div></div></div></div>
</div></div>
<div class="modal fade" id="dlike_tok_with" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document"><div class="modal-content modal-custom"><div class="modal-body ">
        <div class="transfer-respond">
            <h4>Withdraw DLIKE Tokens</h4>
            <label><b>Balance: </b><span class="user_bal"><?php echo $my_bal;; ?></span> DLIKE</label>
            <div class="row line"><div class="col-md-12"><div class="form-group"><div class="input-group mb-3">
                <div class="input-group-prepend"><div class="input-group-text mb-deck"> Amount</div></div><input type="text" class="form-control" name="amt" id="withdraw_amount" placeholder="Enter Amount to Withdraw">
            </div> </div></div></div>
            <center><button type="submit" class="btn btn-default tok_out_btn">Withdraw</button></center>
        </div>
     </div></div></div>
</div>

<div class="modal fade" id="withdrawStatus" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog modal-dialog-custom modalStatus" role="document"><div class="modal-content modal-custom">
<div class="modal-body "><div class="mdStatusTitle sttError iconTitle"><i class="fa fa-spinner fa-pulse"></i></div><div class="mdStatusContent"><h3 id="alert-title-error"><span class="wd_status_message">Waiting For Confirmation</span></h3><div id="alert-content-error"><b><span class="wd_trx_link"></span></b></div><div class="actBtn"><button type="button" class="btn btn-danger wd_btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Close</span></button></div></div></div>
</div></div></div>

<?php include('template/dlike_footer.php'); ?>
<script type="text/javascript">
    function enable_draw(){$(".tok_out_btn").attr("disabled", false).html('Withdraw');}
    let withdraw_val = document.getElementById('withdraw_amount');
    withdraw_val.onkeydown = function(e) {
        if(!((e.keyCode > 95 && e.keyCode < 106) || (e.keyCode > 47 && e.keyCode < 58) || e.keyCode == 8)) {return false;}
    }
    $('.withd_btn').click(function(e) {  e.preventDefault();$("#dlike_tok_with").modal("show");});

    $('.tok_out_btn').click(async function() {
        $(".tok_out_btn").attr("disabled", true).html('Processing...');;
        let out_amount = $('#withdraw_amount').val();let dlk_amount = $('.user_bal').html();
        if (out_amount == "") {toastr.error('phew... Please enter valid amount to withdraw');enable_draw();return false;
        }
        if (parseFloat(out_amount) > parseFloat(dlk_amount)) {toastr.error('phew... Not enough balance');enable_draw();return false;
        }
        if ((parseFloat(dlk_amount) <= 0) ||  (parseFloat(out_amount) <= 0)){toastr.error('phew... Not a valid withdraw amount!');enable_draw();return false;
        }
        async function doAjax() {return $.ajax({type: 'post',url: 'helper/dlk_withdraw.php',data: { action : 'withdraw',dlk_out_amount: out_amount },datatype: 'json',});
        }
        doAjax().then(async function(data) { var response = JSON.parse(data);
            if (response.error == true) {toastr['error'](response.message);enable_draw();return false;}
            else{ let user_address =false;
                if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
                    console.log(user_address)
                }else{toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');return false;}
                let my_wallet = '<?php echo $offchain_address;?>';
                if(user_address != my_wallet) {toastr.error('You are trying to withdraw with a different tron address which is not in your DLIKE wallet!');enable_draw();return false;}
                if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;
                } else { 
                    // $.ajax({ type: "POST",url: "/helper/staking.php", data: {action : 'unstaking',amount: stk_amt,wallet: user_address,trx_id: result},
                    // });
                    let payout_amount = out_amount * 1e6;
                    let myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
                    let myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
                    let result = await myContract.withdrawCommon(payout_amount).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });console.log(result);
                    if(result){
                        $("#dlike_tok_with").modal("hide");$('#withdrawStatus').modal('show');
                        $(".wd_trx_link").html('<a href="https://shasta.tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                        var x = setInterval(function() {
                            $.get("https://api.shasta.trongrid.io/v1/transactions/"+result, function(data, status){
                                if(status=='success'){
                                    $.ajax({type: 'post',url:'helper/dlk_withdraw.php',data:{action : 'paid',dlk_out_amount: out_amount,wallet: user_address,trx_id: result},});
                                    var tx_result = data.data[0].ret[0].contractRet;  
                                    if(tx_result=='SUCCESS'){
                                        $(".wd_status_message").html('Tokens Withdraw Successfully!');
                                        $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');
                                        setTimeout(function(){window.location.reload();}, 1000);
                                    }else{
                                        $(".wd_status_message").html('Something Wrong! Try Again.');
                                        $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');
                                        setTimeout(function(){window.location.reload();}, 1000);
                                    }
                                } 
                            }); 
                        }, 15000);
                    }
                }
            }
        })
    });
    $('.add_address').click(function() { let offchain_add = $('#offchain_add').val();
        if (offchain_add == "") { toastr.error('phew... You forgot to enter address');return false;}
        $.ajax({type: "POST", url: 'helper/dlk_withdraw.php',data:{ action :'address',offchain_address: offchain_add },
            success: function(data) {
                try {var response = JSON.parse(data)
                    if (response.error == true) {toastr['error'](response.message);return false;
                    } else {toastr['success'](response.message);setTimeout(function(){window.location.reload();}, 300);
                    }
                } catch (err) {toastr.error('Sorry. Server response is malformed');}
            }
        });
    });
</script>
