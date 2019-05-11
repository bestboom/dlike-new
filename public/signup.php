<?php include('template/header.php'); ?></div>

<div class="signup-container">
    <div class="signup">
        <div class="signup-signup">
            <h2>Create New Account</h2>
            <span class="signup-signup-icon">
                <span class="fa fa-user"></span>
            </span>
            <p>Choose your username. This will be the name that you are called in DLIKE and other Steem-based apps.</p>
            <form name="signup">
                <label>
                    <div class="input-username">
                        <input type="text" name="username" placeholder="Username"/>
                        <span class="fa fa-user"></span>

                        <span class="message" style="display: none"></span>
                        <span class="loader fas fa-circle-notch fa-spin" style="display: none"></span>
                    </div>
                    <button class="next btn btn-secondary" disabled>
                        Continue
                    </button>
                </label>
            </form>
        </div>
        <div class="signup-login">
            <h2>Want to login?</h2>
            <span class="signup-login-icon">
                <span class="fa fa-sign-in-alt"></span>
            </span>
            <p>we're glad you're back.</p>
            <a class="btn btn-secondary"
               href="https://app.steemconnect.com/oauth2/authorize?client_id=dlike.app&redirect_uri=https%3A%2F%2Fdlike.io%2Fsteemconnect&scope=login,vote,comment,delete_comment,comment_options,custom_json"
            >
                Login via SteemConnect
            </a>
        </div>
    </div>
    <script src="https://unpkg.com/dsteem@^0.8.0/dist/dsteem.js"></script>
    <script src="/js/signup.js"></script>
</div>

<?php include('template/footer.php'); ?>