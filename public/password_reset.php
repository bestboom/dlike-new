<?php include('template/header.php'); if (isset($_GET['token']) && isset($_GET["email"])) {$token = $_GET['token'];$email = $_GET['email'];} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}
	$curDate = date("Y-m-d H:i:s");
	$check_link = $conn->query("SELECT * FROM dlikepasswordreset where token = '$token' and email = '$email'");
	if ($check_link->num_rows <= 0) {$errors = 'This is an invalid link for password reset';}
	$row = mysqli_fetch_assoc($result_link);$reset_date = $row['reset_time'];
  	if ($reset_date >= $curDate){$errors = 'The link to reset password has expired';}
?>
</div>
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block"><p>Reset Password</p></div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                    <?php if (empty($errors)) { ?>
                        <form class="user-connected-from password-reset-form">
                        	<input type="hidden" id="reset_email_id" value="<?php echo $email; ?>" />
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-lock"></span></div>
                                </div>
                                <input type="password" name="reset_pass" id="reset_pass" placeholder="New Password" class="form-control" style="padding: 8px;" />
                            </div>
                            <div class="input-group mb-3" style="padding: 3px;">
                                <div class="input-group-prepend">
                                    <div class="input-group-text mb-deck" style="background: #b6c9fb;"> <span class="fa fas fa-lock"></span></div>
                                </div>
                                <input type="password" name="confirm_reset_pass" id="confirm_reset_pass" placeholder="Confirm Password" class="form-control" style="padding: 8px;" />
                            </div>
                            <center>
                                <button type="button" class="btn btn-default" style="width: 40%;margin-top: 15px;" id="reset_pass_btn">Reset Password</button>
                            </center>
                        </form>
                    <? } else { echo '<h3 style="color: #e1ec31;">'.$errors.'</h3>'; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php include('template/footer.php'); ?>
<script type="text/javascript">
	$('#reset_pass_btn').click(function() {
		let reset_email = $('#reset_email_id').val();let reset_pass = $('#reset_pass').val();
    	let confirm_reset_pass = $('#confirm_reset_pass').val();let email_verify_url = '/helper/email_signup.php';

	    if (reset_pass == "") {toastr.error('phew... Password should not be empty');return false;}
	    if (confirm_reset_pass == "") {toastr.error('phew... Confirm Password should not be empty');return false;}
	    if (confirm_reset_pass !== reset_pass) {toastr.error('phew... Passwords do not match!');return false;}
	    var data_new_pass = {action :'set_new_pass',reset_email: reset_email,reset_pass: reset_pass,confirm_reset_pass: confirm_reset_pass};
	    $.ajax({type: "POST",url: email_verify_url,data: data_new_pass,
	        success: function(data) {
	            try {var response = JSON.parse(data)
	                if (response.error == true) {toastr['error'](response.message);
	                } else {
	                    toastr['success'](response.message);setTimeout(function(){window.location.href = response.redirect;}, 1000);
	                }
	            } catch (err) {toastr.error('Sorry. Server response is malformed');}
	        }
	    });
	});
</script>