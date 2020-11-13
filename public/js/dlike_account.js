$(document).ready(function() {
    $.fn.regexMask = function(mask) {
        $(this).keypress(function (event) {
            if (!event.charCode) return true;
            var part1 = this.value.substring(0, this.selectionStart);
            var part2 = this.value.substring(this.selectionEnd, this.value.length);
            if (!mask.test(part1 + String.fromCharCode(event.charCode) + part2))
                return false;
        });
    };
    var mask = new RegExp('^[A-Za-z0-9_]*$')
    $("#username_signup_id").regexMask(mask) 
});
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
        //signin_email_section.classList.remove("not_me");
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

function signupemailverify() {

    var Signup_main_block  = document.querySelector('.signup-signup');
    var signup_email_block = Signup_main_block.querySelector('.signup-signup-email');
    var signup_verify_block   = Signup_main_block.querySelector('.signup-signup-email-verify');
    jQuery(signup_email_block).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        signup_email_block.style.display = 'none';
        signup_verify_block.style.opacity = 0;
        signup_verify_block.style.top     = '50px';
        signup_verify_block.style.display = '';
        jQuery(signup_verify_block).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

function resetemailpass() {
    var Signin_main_section  = document.querySelector('.signin_main_block');
    var signin_email_section = Signin_main_section.querySelector('.signin_email_block');
    var signin_forgot_section   = Signin_main_section.querySelector('.signin_forgot_block');

    jQuery(signin_email_section).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        signin_email_section.style.display = 'none';
        signin_forgot_section.style.opacity = 0;
        signin_forgot_section.style.top     = '50px';
        signin_forgot_section.style.display = '';
        jQuery(signin_forgot_section).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

$('.signin_email_btn').click(function() {emailLogin();});
$('.signup_steem_btn').click(function() {signupwithsteem();});
$('.signup_email_btn').click(function() {signupwithemail();});
$('.forgot_pass').click(function() {resetemailpass();});

$('.email_signup_btn').click(function() {$('.signup_loader').show();
    let signup_username = $('#username_signup_id').val();
    //console.log(signup_username);
    let signup_email = $('#signup_email').val();let gs_check = $('#gs_token').val();console.log(gs_check);
    let signup_pass = $('#signup_pass').val();
    let signup_refer_by = $('#refer_by_email').val();
    let signup_loct_ip = $('#user_loc_email').val();
    let emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

    if (signup_username == "") {toastr.error('phew... username should not be empty');$('.signup_loader').hide();return false;}
    var allowed_name = /^[\w]+$/; if (!allowed_name.test(signup_username)){toastr.error('UserName can only contain alphanumeric and underscore');$('.signup_loader').hide();return false;}
    if(signup_email==""){toastr.error('phew..Email should not be empty');$('.signup_loader').hide();return false;
    } else {if (!emailRegex.test(signup_email)) {toastr.error('phew... email address is not valid'); $('.signup_loader').hide();return false;}
    }
    if (signup_pass=="") {toastr.error('phew... Password should not be empty');$('.signup_loader').hide();return false; }

    $.ajax({type: "POST",url: "/helper/email_signup.php",data: {action :'signup',signup_username: signup_username,signup_email: signup_email,signup_pass: signup_pass,signup_refer_by: signup_refer_by,signup_loct_ip:signup_loct_ip,gs_check: gs_check},
        success: function(data) {
            try {var response = JSON.parse(data)
                if (response.error == true) {$('.signup_loader').hide();toastr['error'](response.message);return false;
                } else {toastr['success'](response.message);$('#my_signup_email').html(signup_email);signupemailverify();
                }
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});

$('.email_login_btn').click(function() {
    $('.login_loader').show();$('#email_login_txt').hide();$(".email_login_btn").attr("disabled", true);
    let login_user_id = $('#login_user_id').val();let login_pass = $('#email_pass').val();let g_catch = $('#g-token').val();
    if (login_user_id == "") {toastr.error('phew... Username should not be empty');$('.login_loader').hide();$('#email_login_txt').show();$(".email_login_btn").attr("disabled", false);return false;
    }
    if (login_pass == "") {toastr.error('phew... Password should not be empty');
        $('.login_loader').hide();$('#email_login_txt').show();$(".email_login_btn").attr("disabled", false);
        return false;}
    $.ajax({type: "POST",url: 'helper/email_login.php',data: { login_username: login_user_id,login_pass: login_pass, g_catch: g_catch },
        success: function(data) {
            try {var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);
                    $('.login_loader').hide();$('#email_login_txt').show();$(".email_login_btn").attr("disabled", false);return false;
                } else {toastr['success'](response.message);
                    $.cookie("dlike_username", response.dlikeuser, { expires: 7, path: '/' });
                    setTimeout(function(){window.location.href = response.redirect;}, 500);
                }
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});
$('.email_reset_pass_btn').click(function() {let reset_email_id = $('#email_reset_pass').val();
    if (reset_email_id == "") {toastr.error('phew... Email should not be empty');return false;}
    $.ajax({
        type: "POST",url: '/helper/email_signup.php',data:{action :'reset_pass',reset_email:reset_email_id },
        success: function(data) {
            try {var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);return false;
                } else {toastr['success'](response.message);$(".email_reset_pass_btn").html('Email Sent');$(".email_reset_pass_btn").prop('disabled',true);
                }
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});

//pin verify
let inputemailpin = document.querySelector("#email_pin_code");
inputemailpin.addEventListener('keyup', function(){
    if(inputemailpin.value.length == 6) {$(".signup-signup-email-verify .email_verify_pin_btn").prop('disabled',false);}
    if(inputemailpin.value.length < 6 || inputemailpin.value.length > 6) {$(".signup-signup-email-verify .email_verify_pin_btn").prop('disabled',true);}
});

$('.email_verify_pin_btn').click(function() {$(".email_verify_pin_btn").attr("disabled", true);
    $('.verify_pin_loader').show();$('.verify_email_txt').hide();
    let login_user_id = $('#login_user_id').val();let email_pin_code = $('#email_pin_code').val();
    let user_email = $('#my_signup_email').html();
    if (email_pin_code == "") {toastr.error('phew... PIN value should not be empty');$('.verify_pin_loader').hide();$('.verify_email_txt').show();$(".email_verify_pin_btn").attr("disabled", false);return false;}
    $.ajax({type: "POST",url: '/helper/email_signup.php',
        data: { action :'email_verify', email_pin_code: email_pin_code, user_email: user_email},
        success: function(data) {
            try {var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);$('.verify_pin_loader').hide();$('.verify_email_txt').show();$(".email_verify_pin_btn").attr("disabled", false);
                    return false;
                } else {toastr['success'](response.message);setTimeout(function(){window.location.href = response.redirect;}, 700);
                }
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});