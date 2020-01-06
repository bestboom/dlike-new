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
                //getSuccess2();
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
            console.error(err);

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
function signUpPhoneCheck() {
    var Signup  = document.querySelector('.signup-signup');
    var Steemit = Signup.querySelector('.signup-signup-steemit');
    var Phone   = Signup.querySelector('.signup-signup-phone');
    $(".signup-signup-phone .loader.fa").insertAfter($("#phone"));
    jQuery(Steemit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        Steemit.style.display = 'none';

        Phone.style.opacity = 0;
        Phone.style.top     = '50px';
        Phone.style.display = '';

        jQuery(Phone).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function pinVerify() {
    var Signit  = document.querySelector('.signup-signup');
    var pinit = Signit.querySelector('.signup-signup-verify');
    var Phoneit   = Signit.querySelector('.signup-signup-phone');
    $(".signup-signup-phone .loader.fa").insertAfter($("#phone"));
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


function getSuccess() {

    var Signit  = document.querySelector('.signup-signup');
    var pinit = Signit.querySelector('.signup-signup-verify');
    var successit   = Signit.querySelector('.signup-signup-success');

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
    var pinit = Signit.querySelector('.signup-signup-email');
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


/*new signup code*/
var input = document.querySelector("#phone"),
errorMsg = document.querySelector("#error-msg"),
validMsg = document.querySelector("#valid-msg");
var countryCode = '';

var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// Initialise plugin
    var intl = window.intlTelInput(input, {
        allowDropdown: true,
        separateDialCode: true,
        initialCountry: "auto",
    geoIpLookup: function(success, failure) {
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            countryCode = (resp && resp.country) ? resp.country : "";
            success(countryCode);
        });
    },
        utilsScript: "/js/phone_input.js"
    });

var reset = function() {
input.classList.remove("error");
errorMsg.innerHTML = "";
errorMsg.classList.add("hide");
validMsg.classList.add("hide");
};

var FormSignPhone = document.querySelector('form[name="signup-phone"]');
var message    = FormSignPhone.querySelector('.message');

//check if number already used
input.addEventListener('keyup', function(){
    //reset();
    if(input.value.trim()){
        if(intl.isValidNumber()){
            $("#phone").prop('disabled',true);
            $(".signup-signup-phone .next.btn").prop('disabled',true);
            $(".signup-signup-phone .message").text('checking number availability...');
            $(".signup-signup-phone .loader").removeClass('fa-exclamation-circle').addClass('fa-spin');
            $(".signup-signup-phone .message").show();
            $(".signup-signup-phone .message").show();
            $(".signup-signup-phone .message").removeClass('signup-message-success').removeClass('signup-message-error');
            $(".signup-signup-phone .loader").removeClass('fa-spin').addClass('fa-check');
            $(".signup-signup-phone .loader").show();
            var number = intl.getNumber();
            var number = number.replace('+','');
            //console.log(number);
            /*verify number call*/
            $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'check_number',number:number},
                success:function(response){
                    $("#phone").prop('disabled',false);
                    if(response.status===true){
                        $(".signup-signup-phone .loader").addClass('fa-check').removeClass('fa-spin').removeClass('fa-exclamation-circle');
                        //validMsg.classList.remove("hide");
                        $(".signup-signup-phone .next.btn").prop('disabled',false);
                        $(".signup-signup-phone .message").addClass('signup-message-success');
                        $(".signup-signup-phone .message").text(response.message);
                    }
                    else{
                        $(".signup-signup-phone .next.btn").prop('disabled',true);
                        $(".signup-signup-phone .loader").removeClass('fa-spin').addClass('fa-exclamation-circle').removeClass('fa-check');
                        //toastr['error'](response.message);
                        $(".signup-signup-phone .message").addClass('signup-message-error');
                        $(".signup-signup-phone .message").text(response.message);
                    }
                }
            });
        }else{
            input.classList.add("error");
            var errorCode = intl.getValidationError();
            message.innerHTML = errorMap[errorCode];
            //errorMsg.classList.remove("hide");
            $(".signup-signup-phone .loader").removeClass('fa-check').removeClass('fa-spin').addClass('fa-exclamation-circle');        
            $(".signup-signup-phone .next.btn").prop('disabled',true);
            $(".signup-signup-phone .message").removeClass('signup-message-success').addClass('signup-message-error');
        }
    }
});

document.querySelector(".signup-signup-phone .next.btn").addEventListener('click',function(e){
    e.preventDefault();
    if(intl.isValidNumber() && $("#phone").val() != ''){

        var get_number = intl.getNumber();
        var number = get_number.replace('+','');

        $("#phone").prop('disabled',true);
        $(".signup-signup-phone .next.btn").prop('disabled',true);

        if(number != ''){
            $("#sms_number").html(get_number);
            $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'send_sms',number:number},
                success:function(response){
                    
                    $("#phone").prop('disabled',false);
                    $(".signup-signup-phone .next.btn").prop('disabled',false);

                    if(response.status===true)
                    {
                        pinVerify();
                        toastr['success'](response.message);
                    }
                    else{
                        toastr['error'](response.message);
                        return false;
                    }
                }
            });
        }
    }
})

//pin verify
    var inputpin = document.querySelector("#pin_code");
    inputpin.addEventListener('keyup', function(){
        if(inputpin.value.length == 4) {
            $(".signup-signup-verify .next.btn").prop('disabled',false);
        }
        if(inputpin.value.length < 4 || inputpin.value.length > 4) {
            $(".signup-signup-verify .next.btn").prop('disabled',true);
        }
    })

//email verify
    var inputpin = document.querySelector("#email_id");
    inputpin.addEventListener('keyup', function(){
        if(inputpin.value.length == 4) {
            $(".signup-signup-verify .next.btn").prop('disabled',false);
        }
        if(inputpin.value.length < 4 || inputpin.value.length > 4) {
            $(".signup-signup-verify .next.btn").prop('disabled',true);
        }
    })    

    document.querySelector(".signup-signup-verify .next.btn").addEventListener('click',function(e){
        e.preventDefault();
        if(inputpin.value.length == 4){

            $(".signup-signup-verify .next.btn").prop('disabled',true);
            $(".signup-signup-verify .loader").removeClass('fa-circle-notch').addClass('fa-check'); 
            $("#pin_code").prop('disabled',true);
 
            var pin_code = $("#pin_code").val();
            var my_number = intl.getNumber();
            var number = my_number.replace('+','');
            
             $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'verify_pin',mypin:pin_code,number:number},
                success:function(response){
                    console.log(response);
                    if(response.status===true)
                    {
                        getSuccess();
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

    document.querySelector(".signup-signup-success .next.btn").addEventListener('click',function(event){
        event.preventDefault();

        $('#show_pass').html('Loading...');
        $(".signup-signup-success .next.btn").prop('disabled',true);
        let my_name = $('#my_username').html();
        let my_number = intl.getNumber();
        let number = my_number.replace('+','');
        var refer_by = $('#refer_by').val();
        
         $.ajax({
            url: '/helper/signup_verify.php',
            type: 'post',
            cache : false,
            dataType: 'json',
            data: {action : 'acc_create',user:my_name,number:number,refer_by:refer_by},
            success:function(response){
                console.log(response);
                if(response.status===true)
                {
                   toastr['success'](response.message);
                   //console.log(response.password);
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

//new success

    document.querySelector(".signup-signup-success-2 .next.btn").addEventListener('click',function(event){
        event.preventDefault();

        $('#set_pass').html('Generating...');
        $(".signup-signup-success-2 .next.btn").prop('disabled',true);
        let my_name = $('#my_username2').html();
        //let my_number = intl.getNumber();
        //let number = my_number.replace('+','');
        var refer_by = $('#refer_by').val();
        
         $.ajax({
            url: '/helper/signup_verify.php',
            type: 'post',
            cache : false,
            dataType: 'json',
            data: {action : 'acc_create2',user:my_name,refer_by:refer_by},
            success:function(response){
                console.log(response);
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
