<?php include('template/header.php'); ?></div>

<div class="signup-container">
    <div class="signup">

        <section class="signup-signup">

            <div class="signup-signup-steemit">
                <h2>Create New Account</h2>
                <span class="signup-signup-icon">
                    <span class="fa fa-user"></span>
                </span>
                <p class="signup-signup-description">
                    Choose your username. This will be the name that you are called in DLIKE and other Steem-based apps.
                </p>
                <form name="signup">
                    <label>
                        <span class="input-username">
                            <input type="text" name="username" placeholder="Username"/>
                            <span class="fa fa-user"></span>

                            <span class="message" style="display: none"></span>
                            <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                        </span>
                        <button class="next btn btn-lime" disabled>
                            Continue
                        </button>
                    </label>
                </form>
            </div>

            <div class="signup-signup-phone" style="display: none">
                <h2>Create New Account</h2>
                <span class="signup-signup-icon">
                    <span class="fa fa-phone"></span>
                </span>
                <p class="signup-signup-description">
                    Enter your phone number. We will send you a text message with a verification code that you’ll need
                    to enter on the next screen.
                </p>
                <form name="signup-phone">
                    <label>
                        <span class="input-username">
                            <input type="tel" name="phone" placeholder="+1"/>
                            <span class="fa fa-phone"></span>

                            <span class="message" style="display: none"></span>
                            <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                        </span>
                        <button class="next btn btn-lime" disabled>
                            Send SMS
                        </button>
                    </label>
                </form>
            </div>
        </section>

        <section class="signup-login">
            <h2>Want to login?</h2>
            <span class="signup-login-icon">
                <span class="fa fa-sign-in-alt"></span>
            </span>
            <p>You already have a STEEM username?<br/>Then sign up with this one.</p>
            <div class="signup-login-footer">
                <a class="btn btn-azure"
                   href="https://app.steemconnect.com/oauth2/authorize?client_id=dlike.app&redirect_uri=https%3A%2F%2Fdlike.io%2Fsteemconnect&scope=login,vote,comment,delete_comment,comment_options,custom_json"
                >
                    Login via SteemConnect
                </a>
            </div>
        </section>

    </div>
    <script src="/js/signup.js"></script>
</div>

<?php include('template/footer.php'); ?>