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
    async function doAjax() {return $.ajax({type: 'post',url: '/helper/dlk_withdraw.php',data: { action : 'withdraw',dlk_out_amount: out_amount },datatype: 'json',});
    }
    doAjax().then(async function(data) { var response = JSON.parse(data);
        if (response.error == true) {toastr['error'](response.message);enable_draw();return false;}
        else{ let user_address =false;
            if (window.tronWeb!=undefined) {user_address= await window.tronWeb.defaultAddress.base58;
            }else{toastr.error('Non-Tronlink browser detected. You should consider trying Tronlink Wallet!');return false;}
            if(user_address != my_wallet) {toastr.error('You are trying to withdraw with a different tron address which is not in your DLIKE wallet!');enable_draw();return false;}
            if(user_address==false){toastr.error('Please Login to Tronlink Wallet.');return false;
            } else { 
                $.ajax({type: 'post',url:'helper/dlk_withdraw.php',data:{action : 'pay_user',dlk_out_amount: out_amount,wallet: user_address},});
                let payout_amount = out_amount * 1e6;
                let myContractInfo = await tronWeb.trx.getContract(mainContractAddress);
                let myContract = await tronWeb.contract(myContractInfo.abi.entrys, mainContractAddress);
                let result = await myContract.getToken(payout_amount).send({ shouldPollResponse: false, feeLimit: 15000000, callValue: 0, from: user_address });console.log(result);
                if(result){
                    $("#dlike_tok_with").modal("hide");$('#withdrawStatus').modal('show');
                    $(".wd_trx_link").html('<a href="https://tronscan.org/#/transaction/'+result+'" target="_blank">Check Transaction Here</a>');
                    var x = setInterval(function() {
                        $.get("https://api.trongrid.io/v1/transactions/"+result, function(data, status){
                            if(status=='success'){var tx_result = data.data[0].ret[0].contractRet;  
                                if(tx_result=='SUCCESS'){
                                    $.ajax({type: 'post',url:'helper/dlk_withdraw.php',data:{action : 'paid',dlk_out_amount: out_amount,wallet: user_address,trx_id: result},});
                                    $(".wd_status_message").html('Tokens Withdraw Successfully!');
                                    $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-check-circle');setTimeout(function(){window.location.reload();}, 1000);
                                }else{
                                    $(".wd_status_message").html('Something Wrong! Try Again.');
                                    $(".iconTitle").find($(".fa")).removeClass('fa-spinner fa-pulse').addClass('fa-times-circle');setTimeout(function(){window.location.reload();}, 1000);
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
    $.ajax({type: "POST", url: '/helper/dlk_withdraw.php',data:{ action :'address',offchain_address: offchain_add },
        success: function(data) {
            try {var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);return false;
                } else {$(".add_address").removeClass('fa-plus').addClass('fas fa-circle-notch fa-spin');
                    toastr['success'](response.message);setTimeout(function(){window.location.reload();}, 300);
                }
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});