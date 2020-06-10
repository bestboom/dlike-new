<?php include('template/header7.php'); 
	if (isset($_GET['token'])) {
	     $token = $_GET['token'];
	} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}

	$check_email = "SELECT email FROM dlikepasswordreset where token = '$token'";
	$result_email = $conn->query($check_email);
	if ($result_email->num_rows > 0) {
		echo 'this email exist';
	}


?>
</div>
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block">
                        <p>Reset Password</p>
                    </div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                        <form class="user-connected-from share-form">
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
                                <button type="button" class="btn btn-default" style="width: 40%;padding-top: 5px;" id="reset_pass_btn">Reset Password</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php include('template/footer.php'); ?>