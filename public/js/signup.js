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
    function suggestPassword() {
        const array = new Uint32Array(10);
        window.crypto.getRandomValues(array);
        return 'P' + dsteem.PrivateKey.fromSeed(array).toString();
    }

    function getPrivateKeys(username, password, roles = ['owner', 'active', 'posting', 'memo']) {
        const privKeys = {};
        roles.forEach((role) => {
            privKeys[role] = dsteem.PrivateKey.fromLogin(username, password, role).toString();
            privKeys[`${role}Pubkey`] = dsteem.PrivateKey.from(privKeys[role]).createPublic().toString();
        });

        return privKeys;
    };

    var FormSignUp = document.querySelector('form[name="signup"]');
    var Input      = FormSignUp.querySelector('[name="username"]');
    var Message    = FormSignUp.querySelector('.message');
    var Loader     = FormSignUp.querySelector('.loader');
    var Next       = FormSignUp.querySelector('.next');

    var msg_inuse       = 'This username is already in use.';
    var msg_notAllowed  = 'This username is not allowed.';
    var msg_isAvailable = 'This username is available.';
    var msg_error       = 'Unfortunately an error occurred. The name could not be checked :(';

    FormSignUp.addEventListener('submit', function (event) {
        event.stopPropagation();
        event.preventDefault();
        signUpPhoneCheck();
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

        if (username.length <= 2) {
            Message.innerHTML     = msg_notAllowed;
            Message.style.display = '';
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showLoader();
            showErrorIcon();
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
            var user_name = $('#user_name').val();
            console.log(username);
            let password = suggestPassword();
            console.log(password);
            let keys = getPrivateKeys(user_name, password);
            console.log(keys);
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
    var passit   = Signit.querySelector('.signup-signup-pass');

    jQuery(pinit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        pinit.style.display = 'none';

        passit.style.opacity = 0;
        passit.style.top     = '50px';
        passit.style.display = '';

        jQuery(passit).animate({
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

// Error messages based on the code returned from getValidationError
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



input.addEventListener('keyup', function(){
    //reset();
    if(input.value.trim()){
        if(intl.isValidNumber()){
            $("#phone").prop('disabled',true);
            $(".signup-signup-phone .next.btn").prop('disabled',true);
            $(".signup-signup-phone .message").text('checking number availability...');
            $(".signup-signup-phone .message").show();
            $(".signup-signup-phone .message").show();
            $(".signup-signup-phone .message").removeClass('signup-message-success').removeClass('signup-message-error');
            $(".signup-signup-phone .loader").removeClass('fa-check').removeClass('fa-times').addClass('fa-circle-notch').addClass('fa-spin');
            $(".signup-signup-phone .loader").show();
            var number = intl.getNumber();
            number = number.replace('+','');
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
                    if(response.status){
                        $(".signup-signup-phone .loader").addClass('fa-check').removeClass('fa-times').removeClass('fa-circle-notch').removeClass('fa-spin');
                        //validMsg.classList.remove("hide");
                        $(".signup-signup-phone .next.btn").prop('disabled',false);
                        $(".signup-signup-phone .message").addClass('signup-message-success');
                        $(".signup-signup-phone .message").text(response.message);
                    }
                    else{
                        $(".signup-signup-phone .next.btn").prop('disabled',true);
                        $(".signup-signup-phone .loader").removeClass('fa-check').addClass('fa-times').removeClass('fa-circle-notch').removeClass('fa-spin');
                        //toastr['error'](response.message);
                        $(".signup-signup-phone .message").addClass('signup-message-error');
                        $(".signup-signup-phone .message").text(response.message);
                    }
                }
            });
            /*verify number call*/
            
        }else{
            input.classList.add("error");
            var errorCode = intl.getValidationError();
            message.innerHTML = errorMap[errorCode];
            //errorMsg.classList.remove("hide");
            $(".signup-signup-phone .loader").removeClass('fa-check').addClass('fa-times').removeClass('fa-circle-notch').removeClass('fa-spin');        
            $(".signup-signup-phone .next.btn").prop('disabled',true);
            $(".signup-signup-phone .message").removeClass('signup-message-success').addClass('signup-message-error');
        }
    }
});
// Reset on keyup/change event
//input.addEventListener('change', reset);
//input.addEventListener('keyup', reset);

document.querySelector(".signup-signup-phone .next.btn").addEventListener('click',function(){
    if(intl.isValidNumber() && $("#phone").val() != ''){

        var get_number = intl.getNumber();
        var number = get_number.replace('+','');
        // console.log(number);

        $("#phone").prop('disabled',true);
        $(".signup-signup-phone .next.btn").prop('disabled',true);

        if(number != ''){
            $("#sms_number").html(get_number);
            //pinVerify();
            getSuccess();

            $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'send_sms',number:number},
                success:function(response){
                    
                    $("#phone").prop('disabled',false);
                    $(".signup-signup-phone .next.btn").prop('disabled',false);

                    if(response.status)
                    {
                       $(".signup-signup-phone").fadeOut('slow');
                       $(".signup-signup-verify").fadeIn('slow');
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

    document.querySelector(".signup-signup-verify .next.btn").addEventListener('click',function(){
        if(inputpin.value.length == 4){

            $(".signup-signup-verify .next.btn").prop('disabled',true);
            $(".signup-signup-verify .loader").removeClass('fa-circle-notch').addClass('fa-spin'); 
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

                    if(response.status)
                    {
                       $(".signup-signup-verify").fadeOut('slow');
                       $(".signup-signup-pass").fadeIn('slow');
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
});
