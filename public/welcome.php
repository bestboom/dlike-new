<?php include('template/header5.php'); ?>
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
                                <button class="btn btn-default signin_btn">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 signup_sec">
                    <div class="row">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4 class="sign_head">Create Account</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" required="true" placeholder="username">
                                </div>
                                <button type="button" class="btn btn-default signup_btn">
                                    <i class="fas fa-spinner" style="display:none;"></i>
                                    <span>Continue</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
<?php include('template/footer3.php'); ?>
<script type="text/javascript">
    var out = api.revokeToken();
    console.log(out);
    $('.signup_btn').click(function () {
        api.revokeToken();
    });
</script>