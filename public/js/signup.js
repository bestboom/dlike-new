var domReady = (function () {
    var arrDomReadyCallBacks = [];

    function excuteDomReadyCallBacks() {
        for (var i = 0; i < arrDomReadyCallBacks.length; i++) {
            arrDomReadyCallBacks[i]();
        }
        arrDomReadyCallBacks = [];
    }

    return function (callback) {
        arrDomReadyCallBacks.push(callback);
        /* Mozilla, Chrome, Opera */
        if (document.addEventListener) {
            document.addEventListener('DOMContentLoaded', excuteDomReadyCallBacks, false);
        }
        /* Safari, iCab, Konqueror */
        if (/KHTML|WebKit|iCab/i.test(navigator.userAgent)) {
            browserTypeSet   = true;
            var DOMLoadTimer = setInterval(function () {
                if (/loaded|complete/i.test(document.readyState)) {
                    //callback();
                    excuteDomReadyCallBacks();
                    clearInterval(DOMLoadTimer);
                }
            }, 10);
        }
        /* Other web browsers */

        window.onload = excuteDomReadyCallBacks;
    }
})();

domReady(function () {
    var Client = new dsteem.Client('https://api.steemit.com');
    var creator = 'dlike';
    var check_pending_accounts = Client.database.call('get_accounts', [[creator]]).then(function (res) {
        pending_accounts = res[0].pending_claimed_accounts; 
        //console.log(res[0].pending_claimed_accounts);
        if(pending_accounts == 0) {
            $('.signup-signup-steemit').css('display','none');
            $('.signup-signup-disable').css('display','block');
        }
    });
    var FormSignUp = document.querySelector('form[name="signup"]');
    var Input      = FormSignUp.querySelector('[name="username"]');
    var Message    = FormSignUp.querySelector('.message');
    var Loader     = FormSignUp.querySelector('.loader');
    var Next       = FormSignUp.querySelector('.next');

    var msg_inuse       = 'This username is already in use.';
    var msg_notAllowed  = 'Not allowed (no capital letters, no characters).';
    var msg_tooLong     = 'Account name should be shorter.';
    var msg_isAvailable = 'This username is available.';
    var msg_error       = 'Unfortunately an error occurred. The name could not be checked :(';

    FormSignUp.addEventListener('submit', function (event) {
                event.stopPropagation();
                event.preventDefault();
                //signUpPhoneCheck();
                emailCheck();
                return false;
    });

    var Timeout = null;

    var showSuccessIcon = function () {
        Loader.classList.remove('fa-circle-notch');
        Loader.classList.remove('fa-spin');
        Loader.classList.add('fa-check');
    };

    var showErrorIcon = function () {
        Loader.classList.remove('fa-circle-notch');
        Loader.classList.remove('fa-spin');
        Loader.classList.add('fa-exclamation-circle');
    };

    var showLoader = function () {
        Loader.classList.add('fa-circle-notch');
        Loader.classList.add('fa-spin');
        Loader.classList.remove('fa-check');
        Loader.classList.remove('fa-exclamation-circle');
        Loader.style.display = '';
    };

    var checkUsername = function () {
        var username = Input.value;
        //var letterNumber = /^[0-9a-zA-Z]+$/;
        //var letterNumber = /^[0-9a-zA-Z]*\.?[0-9a-zA-Z]+$/;
        var letterNumber = /^[a-z0-9]+\.?[a-z0-9]{3,}$/;
        //var letterNumber = /^[\w]+\.?[\w]{3,}$/;

        if (username.length <= 2) {
            Message.innerHTML     = msg_notAllowed;
            Message.style.display = '';
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showLoader();
            showErrorIcon();
            return;
        }

        if(!(username.match(letterNumber))) {
            Message.innerHTML     = msg_notAllowed;
            Message.style.display = '';
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showLoader();
            showErrorIcon();
            Next.disabled = true;
            return;
        } 

        if (username.length > 16) {
            Message.innerHTML     = msg_tooLong;
            Message.style.display = '';
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showLoader();
            showErrorIcon();
            Next.disabled = true;
            return;
        }               

        Message.style.display = '';
        Message.innerHTML     = 'Checking username...';
        Message.classList.remove('signup-message-success');
        Message.classList.remove('signup-message-error');

        Next.disabled = true;
        showLoader();

        Client.database.call('get_accounts', [[username]]).then(function (result) {

            //Loader.style.display  = 'none';
            Message.style.display = '';

            if (result.length) {
                Message.innerHTML = msg_inuse;
                Message.classList.remove('signup-message-success');
                Message.classList.add('signup-message-error');
                showErrorIcon();
                return;
            }

            Message.innerHTML = msg_isAvailable;
            Message.classList.add('signup-message-success');
            Message.classList.remove('signup-message-error');

            Next.disabled = false;
            showSuccessIcon();
            $('#my_username').html(username);
            $('#my_username2').html(username);
            
        }, function (err) {
            //console.error(err);

            Message.innerHTML = msg_error;
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showErrorIcon();
        });
    };

    Input.addEventListener('keyup', function () {
        if (Timeout) {
            clearTimeout(Timeout);
        }

        Timeout = setTimeout(checkUsername, 250);
    });
// here ends dom

function pinVerify() {
    var Signit  = document.querySelector('.signup-signup');
    var pinit = Signit.querySelector('.signup-signup-verify');
    var Phoneit   = Signit.querySelector('.signup-signup-email');
    //$(".signup-signup-phone .loader.fa").insertAfter($("#phone"));
    jQuery(Phoneit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        Phoneit.style.display = 'none';

        pinit.style.opacity = 0;
        pinit.style.top     = '50px';
        pinit.style.display = '';

        jQuery(pinit).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function emailCheck() {

    var Signit  = document.querySelector('.signup-signup');
    var pinit = Signit.querySelector('.signup-signup-steemit');
    var successit   = Signit.querySelector('.signup-signup-email');

    jQuery(pinit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        pinit.style.display = 'none';

        successit.style.opacity = 0;
        successit.style.top     = '50px';
        successit.style.display = '';

        jQuery(successit).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function getSuccess2() {

    var Signit  = document.querySelector('.signup-signup');
    var pinit = Signit.querySelector('.signup-signup-verify');
    var successit   = Signit.querySelector('.signup-signup-success-2');

    jQuery(pinit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        pinit.style.display = 'none';

        successit.style.opacity = 0;
        successit.style.top     = '50px';
        successit.style.display = '';

        jQuery(successit).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}


function copyPassword() {

    var Signit  = document.querySelector('.signup-signup');
    var successit = Signit.querySelector('.signup-signup-success-2');
    var copyit   = Signit.querySelector('.signup-signup-copy');

    jQuery(successit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        successit.style.display = 'none';

        copyit.style.opacity = 0;
        copyit.style.top     = '50px';
        copyit.style.display = '';

        jQuery(copyit).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}


function passDone() {

    var Signit  = document.querySelector('.signup-signup');
    var doneit = Signit.querySelector('.signup-signup-done');
    var copyit   = Signit.querySelector('.signup-signup-copy');

    jQuery(copyit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        copyit.style.display = 'none';

        doneit.style.opacity = 0;
        doneit.style.top     = '50px';
        doneit.style.display = '';

        jQuery(doneit).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}


var reset = function() {
input.classList.remove("error");
errorMsg.innerHTML = "";
errorMsg.classList.add("hide");
validMsg.classList.add("hide");
};


//pin verify
    var inputpin = document.querySelector("#pin_code");
    inputpin.addEventListener('keyup', function(){
        if(inputpin.value.length == 6) {
            $(".signup-signup-verify .next.btn").prop('disabled',false);
        }
        if(inputpin.value.length < 6 || inputpin.value.length > 6) {
            $(".signup-signup-verify .next.btn").prop('disabled',true);
        }
    })

//email verify
    var email_check = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    $('.signup-signup-email input').keyup(function () {
        var email_address = this.value;    
        //console.log(email_address)
        if(email_check.test(email_address)) {
            $(".signup-signup-email .next.btn").prop('disabled',false);
        }
        if(email_address.length == 0 || email_address.length == "") {
            $(".signup-signup-email .next.btn").prop('disabled',true);
        }
    })    
// pin verify
    document.querySelector(".signup-signup-verify .next.btn").addEventListener('click',function(e){
        e.preventDefault();
        if(inputpin.value.length == 6){

            $(".signup-signup-verify .next.btn").prop('disabled',false);
            $(".signup-signup-verify .loader").removeClass('fa-circle-notch').addClass('fa-check'); 
            //$("#pin_code").prop('disabled',true);
 
            var pin_code = $("#pin_code").val();
            var my_email = $('#my_email').html();
            
             $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'verify_pin',mypin:pin_code,email:my_email},
                success:function(response){
                    //console.log(response);
                    if(response.status===true)
                    {
                        getSuccess2();
                        toastr['success'](response.message);
                    }
                    else{
                        toastr['error'](response.message);
                        $("#pin_code").prop('disabled',false);
                        return false;
                    }
                }
            });  
        }
    })

//email-verify
    document.querySelector(".signup-signup-email .next.btn").addEventListener('click',function(e){
        e.preventDefault();
        var inputemail = $('#email_id').val();
        //console.log(inputemail)
        if(email_check.test(inputemail)){
            $('#my_email').html(inputemail);
            let my_name = $('#my_username').html();
            $(".signup-signup-email .next.btn").html('Verifying...');
            $(".signup-signup-email .next.btn").prop('disabled',true);
            $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'verify_email',user:my_name,email:inputemail},
                success:function(response){
                    //console.log(response);
                    if(response.status===true)
                    {
                        pinVerify();
                        toastr['success'](response.message);
                    }
                    else{
                        toastr['error'](response.message);
                        $("#pin_code").prop('disabled',false);
                        $(".signup-signup-email .next.btn").html('Verify');
                        $(".signup-signup-email .next.btn").prop('disabled',false);
                        return false;
                    }
                }
            });  
        } else {toastr['error']("Email Not Valid"); return false;}
    })

//new success
    document.querySelector(".signup-signup-success-2 .next.btn").addEventListener('click',function(event){
        event.preventDefault();

        $('#set_pass').html('Generating...');
        $(".signup-signup-success-2 .next.btn").prop('disabled',true);
        let my_name = $('#my_username2').html();
        let my_email = $('#my_email').html();
        var refer_by = $('#refer_by').val();
        var loct = $('#user_loc').val();
        
         $.ajax({
            url: '/helper/signup_verify.php',
            type: 'post',
            cache : false,
            dataType: 'json',
            data: {action : 'acc_create2',user:my_name,email:my_email,loct:loct,refer_by:refer_by},
            success:function(response){
                //console.log(response);
                if(response.status===true)
                {
                   toastr['success'](response.message);
                   $('.password_container').html(response.password);
                   copyPassword();
                }
                else{
                    toastr['error'](response.message);
                    return false;
                }
            }
        });   
    })


//copy content
    $("a[name=copy_pre]").click(function() {
        var id = $(this).attr('id');
        var el = document.getElementById(id);
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
        document.execCommand('copy');
        toastr['success']("Password copied to clipboard.");
        return false;
    })
// private key modal
    $('.pass_modal').click(function () {
        $("#copy_pass").modal("show");
    });
    $('#pass_done').click(function () {
        $("#copy_pass").modal("hide");
        $(".signup-signup-copy").fadeOut('slow');
        passDone();
    });

});
