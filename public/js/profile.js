$('.prof_edit_btn').click(function() {
    $(".prof_edit_btn").attr("disabled", true);
    let profname = dlik_profname;let p_about=$('#profile_about').val();let p_website = $('#profile_website').val();
    let p_location = $('#profile_location').val();let p_cover_img = $('#cover_img').val();let p_img = $('#profile_img').val();let p_name = $('#profile_name').val();
    $.ajax({url: '/helper/profile_update.php', type: 'post',
        data: { name_profile: profname, acc_about:p_about, acc_website:p_website, acc_location:p_location, acc_cover_img:p_cover_img, acc_img:p_img, acc_name:p_name },
        success: function(data) {
                try { var response = JSON.parse(data)
                if (response.error == true) {toastr['error'](response.message);$(".prof_edit_btn").attr("disabled", false);return false;
                } else {$("#profile_edit").modal("hide");toastr['success'](response.message);setTimeout(function(){window.location.reload();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');}
        }
    });
});
$('.btn_edit').click(function(e) {	e.preventDefault();$("#profile_edit").modal("show");});
$('.btn_verify_email').click(function(e) {	e.preventDefault();$("#email_verify").modal("show");});

$('.email_pin_btn').click(function() {$(".email_pin_btn").attr("disabled", true).html('Verifying...');
    let pin_code = $('#email_pinit_code').val();
    if (pin_code == "") {toastr.error('phew... PIN value should not be empty');$(".email_pin_btn").attr("disabled", false).html('Verify');return false;}
    $.ajax({type:"POST",url:'/helper/email_signup.php',data:{action :'email_verify',email_pin_code: pin_code},
        success: function(data) {
            try {var response = JSON.parse(data);
                if(response.error == true){toastr['error'](response.message);$(".email_pin_btn").attr("disabled", false).html('Verify');return false;
                }else{toastr['success'](response.message);$("#email_verify").modal("hide");setTimeout(function(){window.location.reload ();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');console.log(err)}
        }
    });
});

$('.resend_pin').click(function() {$('.resend_pin').html("Sending...");
    $.ajax({type:"POST",url:'/helper/email_signup.php',data:{action :'resend_pin'},
        success: function(data) {
            try {var response = JSON.parse(data);
                if(response.error == true){toastr['error'](response.message);$(".email_pin_btn").attr("disabled", false);return false;
                }else{toastr['success'](response.message);$("#email_verify").modal("hide");setTimeout(function(){window.location.reload ();}, 400);}
            } catch (err) {toastr.error('Sorry. Server response is malformed');console.log(err)}
        }
    });
});