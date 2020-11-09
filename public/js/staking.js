function enable_unstake(){$("#unstake_me").attr("disabled", false).html('Unstake');}
function enable_stake(){$("#stake_me").attr("disabled", false).html('Stake');}
function enable_claim(){$("#claim_stk_reward").attr("disabled", false).html('Claim');}
function pad(n) {return (n < 10 ? '0' : '') + n;}
async function getUserStatus() {var user_address =false;
    if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
        if(user_address!=false){     
            var myContract = await tronWeb.contract().at(mainContractAddress);
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
        }else{$('#unskae_row').hide();$('#unstake_row').show();}
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
            let stk_amt = $('#stakeamount').val();
            if (stk_amt == "") {toastr.error('phew... Please enter the amount you want to stake');enable_stake();return false;}
            if (stk_amt < 1) {toastr.error('phew... Min 1 tokens should be staked!');enable_stake();return false;}
            if(stk_wallet !=""){
                if (user_address != stk_wallet) {toastr.error('phew... You last stake is with different Tron address. Please unstake that or use same address for additional stake!');enable_stake();return false;}
            }
            var myContract = await tronWeb.contract().at(mainContractAddress);
            var balanceof = await myContract.balanceOf(user_address).call();
            balanceof = window.tronWeb.toDecimal(balanceof);stk_amt = stk_amt * 1e6;

            if(parseFloat(stk_amt) <=balanceof){
                await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                let result = await myContract.stakeIn(stk_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
                if(result){
                    $('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                        $.get("https://api.trongrid.io/wallet/gettransactioninfobyid?value="+result, function(data, status){
                            if(status=='success'){var stake_output = JSON.parse(data);
                                var tx_result = stake_output.receipt["result"];  
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
        }else{ $("#unstake_me").attr("disabled", true).html('unstaking...');let unstk_amt = $('#unstakeamount').val();
            if (unstk_amt=="") {toastr.error('phew... Please enter the amount you want to unstake');enable_unstake();return false;}
            if(stk_wallet==""){toastr.error('Hey ' +dlike_username +'! It seems you have not staked any tokens yet!');enable_unstake();return false;}
            var myContract = await tronWeb.contract().at(mainContractAddress);
            var stakedAmount = await myContract.checkStake(user_address).call();
            stakedAmount = window.tronWeb.toDecimal(stakedAmount);unstk_amt = unstk_amt * 1e6;
            if(parseFloat(unstk_amt) <=stakedAmount){
                if (user_address != stk_wallet) {toastr.error('Hey ' +dlike_username +'! You are staking with a different Tron address');enable_unstake();return false;}
                await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                    var result = await myContract.stakeOut(unstk_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
                    if(result){$('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                    $.get("https://api.trongrid.io/wallet/gettransactioninfobyid?value="+result, function(data, status){
                        if(status=='success'){var unstake_output = JSON.parse(data);
                            var tx_result = unstake_output.receipt["result"];  
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
            var myContract = await tronWeb.contract().at(mainContractAddress);
            var unstakingAmount = await myContract.checkUnstake(user_address).call();
            unstakingAmount = window.tronWeb.toDecimal(unstakingAmount);
            await new Promise((resolve, reject) => setTimeout(resolve, 400));
            var result = await myContract.claimStakeOut(unstakingAmount).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });
            if(result){$('#stakingStatus').modal('show');
                $(".st_trx_link").html('<a href="https://tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                var x = setInterval(function() {
                $.get("https://api.trongrid.io/wallet/gettransactioninfobyid?value="+result, function(data, status){
                    if(status=='success'){var claimback_tokens = JSON.parse(data);
                        var tx_result = claimback_tokens.receipt["result"];
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


$('#claim_stk_reward').click(async function() {$("#claim_stk_reward").attr("disabled", true).html('claiming...');
    if (dlike_username != null) {let claim_amt = $('#claimeamount').val();
        if (claim_amt == "") {toastr.error('phew... Claim amount not valid');enable_claim();return false;}
         
        async function doAjax() {return $.ajax({type: 'post',url: '/helper/staking.php',data: { action : 'claim_stake',claim_amount: claim_amt },datatype: 'json',});}
        doAjax().then(async function(data) { var response = JSON.parse(data);
            if (response.error == true) {toastr['error'](response.message);enable_claim();return false;}
            else{let user_address =false;
                if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
                }else{toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');return false;}
                if(stk_wallet==""){toastr.error('Hey ' +dlike_username +'! It seems you have not staked any tokens yet!');return false;}
                if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');enable_claim();return false;
                } else { 
                    $.ajax({type: 'post',url:'/helper/staking.php',data:{action : 'pay_staking_reward',claim_amount: claim_amt,wallet: user_address},});
                    claim_amt = claim_amt * 1e6;
                    let myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
                    let myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
                    //var myContract = await tronWeb.contract().at(mainContractAddress);
                    if (user_address != stk_wallet) {toastr.error('Hey ' +dlike_username +'! You are staking with a different Tron address');enable_claim();return false;}
                    await new Promise((resolve, reject) => setTimeout(resolve, 1000));
                    let result = await myContract.getReward(claim_amt).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });console.log(result);
                    if(result){$('#stakingStatus').modal('show');
                    $(".st_trx_link").html('<a href="https://tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                    $.get("https://api.trongrid.io/wallet/gettransactioninfobyid?value="+result, function(data, status){
                        if(status=='success'){var claim_reward = JSON.parse(data);
                            var tx_result = claim_reward.receipt["result"];
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
    } else {toastr.error('You must be login with DLIKE username!');enable_claim();return false;}
});