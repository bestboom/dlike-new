<?php 
if (isset($_COOKIE['username']) || $_COOKIE['username']) {
    die('<script>window.location.replace("https://dlike.io","_self")</script>');
} else {
include('template/header5.php');
if (isset($_GET["ref"])){ $referrer = $_GET['ref'];} else { $referrer = 'dlike';}
?>
</div>
<div class="container">
    <div class="contact-info-outer welcome">
        <div class="contact-info-wrap">
            <div class="row">
                <div class="col-md-6 signin_main_block">
                    <div class="row" style="margin: 0px;">
                        <div class="map-block signin_block">
                            <div class="contact-info-inner signin_inner">
                                <h4 class="signin_head">Existing User</h4>
                                <p>
                                    If you already have an account, login with your steem based username OR open login with email.
                                </p>
                                <button onclick="window.location.href='https://steemlogin.com/oauth2/authorize?client_id=dlike.app&redirect_uri=https%3A%2F%2Fdlike.io%2Fsteemlogin&scope=';" type="button" class="btn btn-default signin_btn">STEEM Login</button>
                                <button type="button" class="btn btn-default signin_btn signin_email_btn">Email Login</button>
                            </div>
                        </div>

                        <div class="map-block signin_email_block" style="display: none">
                            <div class="contact-info-inner" style="text-align: center;margin: 25px;margin-top: 15%;">
                                <h4 style="color: #0b132d;font-weight: 700;font-size: 24px;">Email Login</h4>
                                <p class="signup-signup-description">
                                    This is open email login (not steem blockchain).
                                </p>
                                <form name="email_login_form" style="margin-left: 15%;margin-right: 15%;">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-envelope"></span></div>
                                        </div>
                                        <input type="email" name="login_email" id="email_login_id" placeholder="Email Address" class="form-control" />
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-lock"></span></div>
                                        </div>
                                        <input type="password" name="email_pass" id="email_pass" placeholder="Password" class="form-control" />
                                    </div>
                                    <div class="error_message" style="display: none"></div>
                                    <button class="btn btn-primary" type="button" style="margin-top: 15px;">LOGIN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 signup_sec signup-signup">

                    <div class="row signup-signup-disable" style="display: none;">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Create Account</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-user"></span>
                                </span>
                                <p class="signup-signup-description">
                                     New signups through DLIKE are closed till further notice!
                                </p>
                                <button onclick="window.location.href='https://steemlogin.com/oauth2/authorize?client_id=dlike.app&redirect_uri=https%3A%2F%2Fdlike.io%2Fsteemlogin&scope=';" type="button" class="btn btn-success">Login</button>
                            </div>
                        </div>
                    </div>

                    <div class="row signup-signup-first" style="display: block;">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Create Account</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-user"></span>
                                </span>
                                <button type="button" class="btn btn-default signin_btn signup_steem_btn" style="color: #1b1e63;border-color: #1b1e63;">Create STEEM Account</button>
                                <h4 style="margin:1rem;">OR</h4>
                                <button type="button" class="btn btn-default signin_btn signup_email_btn" style="color: #1b1e63;border-color: #1b1e63;">Signup With Email</button>
                            </div>
                        </div>
                    </div>

                    <div class="signup-signup-email" style="display: none;">
                        <div class="signup_email_block">
                            <div class="contact-info-inner" style="margin-top: 10%;">
                                <h4  style="color: #0b132d;font-weight: 700;font-size: 24px;">Signup</h4>
                                <form name="email_signup" style="margin-top: 25px;margin-left: 16%;margin-right: 16%;width: unset;float: none;">
                                    <div class="form-group input-username">
                                        <input type="hidden" id="refer_by_email" value="<?php echo $referrer; ?>" />
                                        <input type="hidden" id="user_loc_email" value="<?php echo $thisip; ?>" />
                                    </div>
                                    <div class="input-group mb-3" style="padding: 3px;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-user"></span></div>
                                        </div>
                                        <input type="text" name="signup_username" id="username_signup_id" placeholder="Username" class="form-control" style="padding: 8px;" />
                                    </div>
                                    <div class="input-group mb-3" style="padding: 3px;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-envelope"></span></div>
                                        </div>
                                        <input type="email" name="signup_email" id="signup_email" placeholder="Email Address" class="form-control" style="padding: 8px;" />
                                    </div>
                                    <div class="input-group mb-3" style="padding: 3px;">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-lock"></span></div>
                                        </div>
                                        <input type="password" name="signup_pass" id="signup_pass" placeholder="Password" class="form-control" style="padding: 8px;" />
                                    </div>
                                    <p style="margin: 0px;"><?php if($referrer !='dlike'){ echo 'Referred By <span style="font-weight:600;color:#1b1e63;">' .$referrer.'</span>';} ?></p>
                                    <button class="btn btn-lime email_signup_btn" type="button" style="background-color: #1b1e63;border-color: #1b1e63;padding: 8px;width: 50%;margin-right:25%;margin-left:25%;">SIGNUP</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row signup-signup-steemit" style="display: none;">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4 class="sign_head">Create Account</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-user"></span>
                                </span>
                                <form name="signup" style="margin-top: 15px;">
                                    <div class="form-group input-username">
                                        <input type="hidden" id="refer_by" value="<?php echo $referrer; ?>" />
                                        <input type="hidden" id="user_loc" value="<?php echo $thisip; ?>" />
                                        <input type="text" name="username" class="form-control" id="user_name" placeholder="username">
                                        <span class="fa fa-user"></span>
                                        <span class="message" style="display: none"></span>
                                        <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                                    </div>
                                    <p style="margin: 0px;"><?php if($referrer !='dlike'){ echo 'Referred By <span style="font-weight:600;color:#1b1e63;">' .$referrer.'</span>';} ?></p>
                                    <button class="next btn btn-lime" disabled>
                                        <i class="fas fa-spinner" style="display:none;"></i>
                                        <span>Continue</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="signup-signup-email" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Add Email</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-envelope"></span>
                                </span>
                                <p class="signup-signup-description">
                                    Hello <b>@<span id="my_username"></span></b>! <br>
                                    Make sure to enter a valid email address.
                                </p>
                                <form name="signup-pin">
                                    <span class="input-username">
                                        <input type="email" name="email" id="email_id" placeholder="enter email address"class="form-control" />
                                        <span class="fa fas fa-envelope"></span>
                                        <span class="loader fa fas fa-circle-notch" style="display: none"></span>
                                    </span>
                                    <button class="next btn btn-lime" disabled>
                                        Verify Email
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
                                    Enter the confirmation code sent to <b><span id="my_email"></span></b>.
                                </p>
                                <form name="signup-pin">
                                    <span class="input-username">
                                        <input type="text" name="pin" id="pin_code" placeholder="confirmation code (6 digits)"class="form-control" />
                                        <span class="fa fas fa-search"></span>
                                        <span class="loader fa fas fa-circle-notch" style="display: none"></span>
                                    </span>
                                    <button class="next btn btn-lime" disabled>
                                        Verify PIN
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="signup-signup-success-2" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Generate Password</h4>
                                <span class="signup-signup-icon">
                                    <span class="fa fa-check"></span>
                                </span>
                                <p class="signup-signup-description">
                                    Hello  <b>@<span id="my_username2"></span></b>! <br>
                                    Welcome to STEEM Blockchain.
                                </p>
                                <form name="signup-pin">
                                    <button class="next btn btn-lime">
                                        <span id="set_pass">Set My Password</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>                  


                    <div class="signup-signup-copy" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Password</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-user"></span>
                                </span>
                                <p class="signup-signup-description" style="margin-bottom: 20px;">
                                     This is the password (private key) of your Steem account<span style="color:red;">
                                    Please keep it secured.</span>
                                </p>
                                <p style="margin-bottom: 20px;">
                                <span class="password_container" id="pw_contain" style="padding: 20px;border: 1px solid #92b2bb;background: #dbf3fa;"></span>
                                </p>
                                <a id="pw_contain"  href="#" name="copy_pre"><button class="next btn btn-danger">Copy Password</button></a>
                                <button class="next btn btn-lime pass_modal">Continue</button>
                            </div>
                        </div>
                    </div>

                    <div class="signup-signup-done" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>All Done!</h4>
                                <span class="signup-signup-icon">
                                    <span class="fas fa-heart"></span>
                                </span>
                                <p class="signup-signup-description">
                                     Now you can use DLIKE and all other Steem apps witht this account.
                                </p>
                                <button onclick="window.location.href='https://steemlogin.com/oauth2/authorize?client_id=dlike.app&redirect_uri=https%3A%2F%2Fdlike.io%2Fsteemlogin&scope=';" type="button" class="btn btn-success">Login</button>
                            </div>
                        </div>
                    </div>                               

                </div>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="copy_pass" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-custom">
            <?php include('template/modals/password_modal.php'); ?>
        </div>
    </div>
</div>
<?php include('template/footer.php'); } ?>
<script>
function emailLogin() {

    var Signin_main_section  = document.querySelector('.signin_main_block');
    var signin_text_section = Signin_main_section.querySelector('.signin_block');
    var signin_email_section   = Signin_main_section.querySelector('.signin_email_block');

    jQuery(signin_text_section).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        signin_text_section.style.display = 'none';

        signin_email_section.style.opacity = 0;
        signin_email_section.style.top     = '50px';
        signin_email_section.style.display = '';

        jQuery(signin_email_section).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function signupwithsteem() {

    var Signup_main_block  = document.querySelector('.signup-signup');
    var signup_first_block = Signup_main_block.querySelector('.signup-signup-first');
    var signup_steem_block   = Signup_main_block.querySelector('.signup-signup-steemit');

    jQuery(signup_first_block).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        signup_first_block.style.display = 'none';

        signup_steem_block.style.opacity = 0;
        signup_steem_block.style.top     = '50px';
        signup_steem_block.style.display = '';

        jQuery(signup_steem_block).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function signupwithemail() {

    var Signup_main_block  = document.querySelector('.signup-signup');
    var signup_first_block = Signup_main_block.querySelector('.signup-signup-first');
    var signup_email_block   = Signup_main_block.querySelector('.signup-signup-email');

    jQuery(signup_first_block).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        signup_first_block.style.display = 'none';

        signup_email_block.style.opacity = 0;
        signup_email_block.style.top     = '50px';
        signup_email_block.style.display = '';

        jQuery(signup_email_block).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}
$('.signin_email_btn').click(function() {
    emailLogin();
});
$('.signup_steem_btn').click(function() {
    signupwithsteem();
});
$('.signup_email_btn').click(function() {
    signupwithemail();
});
$('.email_signup_btn').click(function() {
    //toastr.error('phew... Ok Move on!');
    let signup_username = $('#username_signup_id').val();
    console.log(signup_username);
    let signup_email = $('#signup_email').val();
    let signup_pass = $('#signup_pass').val();
    let emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    if (signup_username == "") {
        toastr.error('phew... username should not be empty');
        return false;
    }
    if (signup_email == "") {
        toastr.error('phew... Email should not be empty');
        return false;
    } else {
        if (!emailRegex.test(signup_email)) {
            toastr.error('phew... email address is not valid');
            return false;
        }
    }
    if (signup_pass == "") {
        toastr.error('phew... Password should not be empty');
        return false;
    }
    toastr.success('Success now submit');
});
</script>

https://codeshack.io/secure-registration-system-php-mysql/