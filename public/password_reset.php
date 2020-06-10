<?php include('template/header7.php'); 
	if (isset($_GET['token']) && isset($_GET["email"])) {
	     $token = $_GET['token'];
	     $email = $_GET['email'];
	} else {die('<script>window.location.replace("https://dlike.io","_self")</script>');}

	$curDate = date("Y-m-d H:i:s");

	$check_link = "SELECT * FROM dlikepasswordreset where token = '$token' and email = '$email'";
	$result_link = $conn->query($check_link);
	if ($result_link->num_rows <= 0) {
		$errors = 'This is an invalid link for password reset';
	}
	$row = mysqli_fetch_assoc($result_link);
	$reset_date = $row['reset_time'];
  	if ($reset_date >= $curDate){
  		$errors = 'The link to reset password has expired';
  	}
?>
</div>
    <div class="container">
        <div class="user-login-signup-form-wrap" style="padding: 7rem 0rem;">
            <div class="modal-content" style="background: #1b1e63;border-radius: 14px;">
                <div class="modal-body">
                    <div class="share-block">
                    	<?php echo $curDate; ?>
                        <p>Reset Password</p>
                        <?php echo $reset_date; ?>
                    </div>
                    <div class="user-connected-form-block" style="background: #1b1e63;">
                    <?php if (empty($errors)) { ?>
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
                                <button type="button" class="btn btn-default" style="width: 40%;padding-top: 15px;" id="reset_pass_btn">Reset Password</button>
                            </center>
                        </form>
                    <? } else { echo '<h3>'.$errors.'</h3>'; } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php include('template/footer.php'); ?>