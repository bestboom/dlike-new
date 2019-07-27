<?php 
if (isset($_GET["r"])){ $referrer = $_GET['r'];} else { $referrer = '';}
include('template/header6.php'); 
?>

<style>
    .signup-container {
    padding: 5rem;
}

.signup {
    background: #fff;
    box-shadow: 0 0 16px 0 rgba(0, 0, 0, .4);
    border-radius: 3px;
    display: flex;
    margin: 0 auto;
    position: relative;
    width: 800px;
}

.signup h2 {
    font-size: 1.75rem;
    text-align: center;
}

.signup-signup,
.signup-login {
    width: 50%
}

/** SIGNUP
 =============================== */

.signup-signup {
    /* padding: 3rem; */
    text-align: center;
}

.signup-signup-icon {
    color: #ced4da;
    display: inline-block;
    font-size: 2rem;
    padding: 0.4rem 0;
    text-align: center;
    width: 100%;
}

.signup-signup form {
    display: flex;
    flex-direction: column;
    height: 80px;
    width: 100%;
}

.signup-signup form label {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.signup-signup form input {
    border: 1px solid #d9d9d9;
    border-radius: 0.25rem;
    padding: 0.25rem 0.25rem 0.25rem 2rem;
    width: 100%;
}

.signup-signup .input-username {
    position: relative;
}

.signup-signup .input-username .fa {
    left: 0;
    line-height: 2.5rem;
    position: absolute;
    text-align: center;
    top: 0;
    width: 2rem;
}

.signup-signup .input-username .loader {
    left: initial;
    line-height: 2.5rem;
    position: absolute;
    right: 0;
    text-align: center;
    top: -2px;
    width: 2rem;
}

.signup-signup .input-username .fa-exclamation-circle {
    color: #cd201f;
}

.signup-signup .input-username .fa-check {
    color: #5eba00;
}

.signup-signup button {
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

.signup-signup button:disabled {
    color: rgba(0, 0, 0, .25);
    background-color: #f5f5f5;
    border-color: #d9d9d9;
    text-shadow: none;
    box-shadow: none;
}

.signup-signup .message {
    display: block;
    text-align: left;
    width: 100%;
}

.signup-message-error {
    color: #cd201f;
}

.signup-message-success {
    color: #5eba00;
}

.signup-signup-steemit,
.signup-signup-phone {
    position: relative;
    top: 0;
}

/** LOGIN
 =============================== */

.signup-login {
    display: flex;
    flex-direction: column;
    padding: 3rem 0;
    text-align: center;
}

.signup-login a {
    /*background-color: #45aaf2;*/
    /*border-color: #45aaf2;*/
    /*color: #fff;*/
    cursor: pointer;
    font-size: 0.85rem;
    padding: .375rem 2rem;
}

.signup-login-icon {
    color: #ced4da;
    display: inline-block;
    font-size: 4rem;
    padding: 2rem 0;
    text-align: center;
    width: 100%;
}

.signup-login p {
    flex-grow: 1;
}

.signup-login-footer {
    height: 80px;
}


/** HELPER
 =============================== */

.btn-azure {
    color: #fff;
    background-color: #45aaf2;
    border-color: #45aaf2;
}

.btn-azure:hover {
    color: #fff;
    background-color: #219af0;
    border-color: #1594ef;
}

.btn-lime {
    color: #fff;
    background-color: #7bd235;
    border-color: #7bd235;
}

.btn-lime:hover {
    color: #fff;
    background-color: #69b829;
    border-color: #63ad27;
}
.hide{display: none;}
</style>

</div>
<div class="container">
    <div class="contact-info-outer welcome">
        <div class="contact-info-wrap">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="map-block signin_block">
                            <div class="contact-info-inner signin_inner">
                                <h4 class="signin_head">Existing User</h4>
                                <p>
                                    If you already have a steem account, login with your steem username through steemconnect.
                                </p>
                                <button class="btn btn-default signin_btn log_link">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 signup_sec signup-signup">
                    <div class="row signup-signup-steemit">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4 class="sign_head">Create Account</h4>
                                <form name="signup">
                                    <div class="form-group input-username">
                                        <input type="text" name="username" class="form-control" required="true" placeholder="username">
                                        <span class="fa fa-user"></span>

                                        <span class="message" style="display: none"></span>
                                        <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                                    </div>
                                    <p style="margin: 0px;"><?php if($referrer !=''){ echo 'Referred By '.$referrer; } ?></p>
                                    <button class="next btn btn-lime" disabled>
                                        <i class="fas fa-spinner" style="display:none;"></i>
                                        <span>Continue</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="signup-signup-phone" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Verify Phone</h4>
                                <span class="signup-signup-icon">
                                    <span class="fa fa-phone"></span>
                                </span>
                                <p class="signup-signup-description">
                                    Enter your phone number. We will send you a text message with a verification code that you’ll need to enter on the next screen.
                                </p>
                                <form name="signup-phone">
                                    <span class="input-username">
                                        <!-- <input type="tel" name="phone" placeholder="+1"/>
                                        <span class="fa fa-phone"></span>

                                        <span class="message" style="display: none"></span>
                                        <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span> -->
                                        <input id="phone" type="tel">
                                        <span id="valid-msg" class="hide">✓ Valid</span>
                                        <span id="error-msg" class="hide"></span>
                                    </span>
                                    <button class="next btn btn-lime" disabled>
                                        Send SMS
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="signup-signup-verify" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Verify PIN</h4>
                                <span class="signup-signup-icon">
                                    <span class="fa fa-phone"></span>
                                </span>
                                <p class="signup-signup-description">
                                    Enter the confirmation code. We sent the code to (phone number here) vis SMS.
                                </p>
                                <form name="signup-pin">
                                    <span class="input-username">
                                        <input type="text" name="pin" placeholder="confirmation code (4 digits)"/>
                                        <span class="fas fa-search"></span>
                                    </span>
                                    <button class="next btn btn-lime" disabled>
                                        Verify PIN
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>
    </div>
</div> 

<!--https://github.com/jackocnr/intl-tel-input -->
<?php include('template/footer4.php'); ?>
<script type="text/javascript">
    var input = document.querySelector("#phone"),
    errorMsg = document.querySelector("#error-msg"),
    validMsg = document.querySelector("#valid-msg");

// Error messages based on the code returned from getValidationError
var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// Initialise plugin
var intl = window.intlTelInput(input, {
    allowDropdown: true,
    separateDialCode: true,
    initialCountry: "auto",
    geoIpLookup: function(success, failure) {
        $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
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

// Validate on blur event
input.addEventListener('blur', function(){
    reset();
    if(input.value.trim()){
        if(intl.isValidNumber()){
            $("#phone").prop('disabled',true);
            var number = intl.getNumber();
            number = number.replace('+','');
            console.log(number);
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
                        validMsg.classList.remove("hide");
                        $(".signup-signup-phone .next.btn").prop('disabled',false);
                    }
                    else{
                        $(".signup-signup-phone .next.btn").prop('disabled',true);
                        toastr['error'](response.message);
                    }
                }
            });
            /*verify number call*/
            
        }else{
            input.classList.add("error");
            var errorCode = intl.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
        }
    }
});

// Reset on keyup/change event
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

$(document).on('click',".signup-signup-phone .next.btn",function(){
    if(intl.isValidNumber() && $("#phone").val() != ''){
        var number = $("#phone").val();//intl.getNumber();
        var countryCode = intl.intlTelInput("getSelectedCountryData").dialCode;
        //number = number.replace('+','');
        console.log(number);
        console.log(countryCode);
        $("#phone").prop('disabled',true);
        $(".signup-signup-phone .next.btn").prop('disabled',true);
        if(number != ''){
            /*verify number call*/
            $.ajax({
                url: '/helper/signup_verify.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'send_sms',countryCode:countryCode,number:number},
                success:function(response){
                    $("#phone").prop('disabled',false);
                    $(".signup-signup-phone .next.btn").prop('disabled',false);
                    if(response.status){
                       $(".signup-signup-phone").fadeOut('slow');
                       $(".signup-signup-verify").fadeIn('slow');
                       toastr['success'](response.message);
                    }
                    else{
                        toastr['error'](response.message);
                    }
                }
            });
            /*verify number call*/
        }
    }
})
</script>