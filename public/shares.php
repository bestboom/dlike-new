<?php include('template/header5.php'); ?>
</div>
<div style="background: #6747c7;">
    <div class="container" style="margin-top: 10rem;">
        <div class="user-login-signup-form-wrap">
            <div class="modal-content">
                <h3>User Login</h3>
                <div class="modal-body">
                    <div class="modal-info-block">
                        <p>Always ensure you're on the correct website</p>
                        <div class="block-inner">
                            <p>
                                <span>
                                    <i class="fas fa-lock"></i>
                                    https://
                                </span>
                                www.excoin.com
                            </p>
                        </div>
                    </div>
                    <div class="user-connected-form-block">
                        <form class="user-connected-from user-login-form">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email address">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group pass-remember-block">
                                <div class="custom-control custom-checkbox">
                                    <div class="custom-checkbox-wrap">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                        <label class="custom-control-label" for="customCheck">Remember me</label>
                                    </div>
                                </div>
                                <div>
                                    <a href="#">Forget password?</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                        <p>Don't have an account?  <a href="#"> Register</a></p>
                    </div><!-- create-account-block -->
                </div>
            </div>
        </div><!-- user-login-signup-form-wrap -->
    </div>
</div>
<div class="contact-form-section">
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 offset-md-1 col-md-9">
                <div class="contact-form-wrap">
                    <form class="contact-form share-form">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="url_field" required="true" placeholder="Enter URL">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="btn btn-default" id="share"><i class="fas fa-spinner fa-spin loader" style="display:none;"></i><span id="plus">Share</span></button>
                        </div>
                    </form><!-- contact-form -->
                    <div class="row d-flex justify-content-center share-pack">
                        <p>*Maximum 2 link shares allowed per user in 24 hours</p>
                        <p>*Do not share same link shared by someone else</p>
                        <p>*Do not share links which are not informative and useless</p>
                        <p>*We prefer English Language based articles to be shared</p>
                        <p>*Violation of rules will result in negative votes</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div><!-- contact-section -->
</div>    
<?php include('template/footer3.php'); ?>