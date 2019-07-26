<?php include('template/header5.php'); ?></div>
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
    padding: 3rem;
    text-align: center;
}

.signup-signup-icon {
    color: #ced4da;
    display: inline-block;
    font-size: 4rem;
    padding: 2rem 0;
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
</style>
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

<?php include('template/footer3.php'); ?>