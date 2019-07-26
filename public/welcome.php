<?php 
if (isset($_GET["r"])){ $referrer = $_GET['r'];} else { $referrer = '';}
include('template/header6.php'); 

?>

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
    /* padding: 3rem; */
    text-align: center;
}

.signup-signup-icon {
    color: #ced4da;
    display: inline-block;
    font-size: 2rem;
    padding: 0.4rem 0;
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







// NOTE: by using !default on all variables, we're saying only declare the variable if it doesn't
// already exist, which allows devs to declare these variables themselves and assign them any value
// they want before importing this file

// rgba is needed for the selected flag hover state to blend in with
// the border-highlighting some browsers give the input on focus
$hoverColor: rgba(0, 0, 0, 0.05) !default;
$greyText: #999 !default;
$greyBorder: #CCC !default;

$flagHeight: 15px !default;
$flagWidth: 20px !default;
$flagPadding: 8px !default;
// this border width is used for the popup and divider, but it is also
// assumed to be the border width of the input, which we do not control
$borderWidth: 1px !default;

$arrowHeight: 4px !default;
$arrowWidth: 6px !default;
$triangleBorder: 3px !default;
$arrowPadding: 6px !default;
$arrowColor: #555 !default;

$inputPadding: 6px !default;
$selectedFlagWidth: $flagWidth + (2 * $flagPadding) !default;
$selectedFlagArrowWidth: $flagWidth + $flagPadding + $arrowWidth + (2 * $arrowPadding) !default;

// image related variables
$flagsImagePath: "../img/" !default;
$flagsImageName: "flags" !default;
$flagsImageExtension: "png" !default;

// enough space for them to click off to close
$mobilePopupMargin: 30px !default;

.iti {
  // need position on the container so the selected flag can be
  // absolutely positioned over the input
  position: relative;
  // keep the input's default inline properties
  display: inline-block;

  // paul irish says this is ok
  // http://www.paulirish.com/2012/box-sizing-border-box-ftw/
  * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
  }

  &__hide {
    display: none;
  }
  // need this during init, to get the height of the dropdown
  &__v-hide {
    visibility: hidden;
  }

  // specify types to increase specificity e.g. to override bootstrap v2.3
  input, input[type=text], input[type=tel] {
    position: relative;
    // input is bottom level, below selected flag and dropdown
    z-index: 0;

    // any vertical margin the user has on their inputs would no longer work as expected
    // because we wrap everything in a container div. i justify the use of !important
    // here because i don't think the user should ever have vertical margin here - when
    // the input is wrapped in a container, vertical margin messes up alignment with other
    // inline elements (e.g. an adjacent button) in firefox, and probably other browsers.
    margin-top: 0 !important;
    margin-bottom: 0 !important;

    // make space for the selected flag on right of input (if disabled allowDropdown)
    // Note: no !important here, as the user may want to tweak this so that the
    // perceived input padding matches their existing styles
    padding-right: $selectedFlagWidth;

    // any margin-right here will push the selected-flag away
    margin-right: 0;
  }

  &__flag-container {
    // positioned over the top of the input
    position: absolute;
    // full height
    top: 0;
    bottom: 0;
    right: 0;
    // prevent the highlighted child from overlapping the input border
    padding: $borderWidth;
  }

  &__selected-flag {
    // render above the input
    z-index: 1;
    position: relative;
    display: flex;
    align-items: center;
    // this must be full-height both for the hover highlight, and to push down the
    // dropdown so it appears below the input
    height: 100%;
    padding: 0 $arrowPadding 0 $flagPadding;
  }

  &__arrow {
    margin-left: $arrowPadding;

    // css triangle
    width: 0;
    height: 0;
    border-left: $triangleBorder solid transparent;
    border-right: $triangleBorder solid transparent;
    border-top: $arrowHeight solid $arrowColor;

    &--up {
      border-top: none;
      border-bottom: $arrowHeight solid $arrowColor;
    }
  }

  // the dropdown
  &__country-list {
    position: absolute;
    // popup so render above everything else
    z-index: 2;

    // override default list styles
    list-style: none;
    // in case any container has text-align:center
    text-align: left;

    // place menu above the input element
    &--dropup {
      bottom: 100%;
      margin-bottom: (-$borderWidth);
    }

    padding: 0;
    // margin-left to compensate for the padding on the parent
    margin: 0 0 0 (-$borderWidth);

    box-shadow: 1px 1px 4px rgba(0,0,0,0.2);
    background-color: white;
    border: $borderWidth solid $greyBorder;

    // don't let the contents wrap AKA the container will be as wide as the contents
    white-space: nowrap;
    // except on small screens, where we force the dropdown width to match the input
    @media (max-width: 500px) {
      white-space: normal;
    }

    max-height: 200px;
    overflow-y: scroll;

    // Fixes https://github.com/jackocnr/intl-tel-input/issues/765
    // Apple still hasn't fixed the issue where setting overflow: scroll on a div element does not use inertia scrolling
    // If this is not set, then the country list scroll stops moving after rasing a finger, and users report that scroll is slow
    // Stackoverflow question about it: https://stackoverflow.com/questions/33601165/scrolling-slow-on-mobile-ios-when-using-overflowscroll
    -webkit-overflow-scrolling: touch;
  }

  // dropdown flags need consistent width, so wrap in a container
  &__flag-box {
    display: inline-block;
    width: $flagWidth;
  }

  // the divider below the preferred countries
  &__divider {
    padding-bottom: 5px;
    margin-bottom: 5px;
    border-bottom: $borderWidth solid $greyBorder;
  }

  // each country item in dropdown (we must have separate class to differentiate from dividers)
  &__country {
    // Note: decided not to use line-height here for alignment because it causes issues e.g. large font-sizes will overlap, and also looks bad if one country overflows onto 2 lines
    padding: 5px 10px;
    outline: none;
  }

  // the dial codes after the country names are greyed out
  &__dial-code {
    color: $greyText;
  }
  &__country.iti__highlight {
    background-color: $hoverColor;
  }

  // spacing between country flag, name and dial code
  &__flag-box, &__country-name, &__dial-code {
    vertical-align: middle;
  }
  &__flag-box, &__country-name {
    margin-right: 6px;
  }

  // these settings are independent of each other, but both move selected flag to left of input
  &--allow-dropdown, &--separate-dial-code {
    input, input[type=text], input[type=tel] {
      padding-right: $inputPadding;
      padding-left: $selectedFlagArrowWidth + $inputPadding;
      margin-left: 0;
    }
    .iti__flag-container {
      right: auto;
      left: 0;
    }
  }

  &--allow-dropdown {
    // hover state - show flag is clickable
    .iti__flag-container:hover {
      cursor: pointer;
      .iti__selected-flag {
        background-color: $hoverColor;
      }
    }
    // disable hover state when input is disabled
    input[disabled] + .iti__flag-container:hover,
    input[readonly] + .iti__flag-container:hover {
      cursor: default;
      .iti__selected-flag {
        background-color: transparent;
      }
    }
  }

  &--separate-dial-code {
    .iti__selected-flag {
      // now that we have digits in this section, it needs this visual separation
      background-color: $hoverColor;
    }
    .iti__selected-dial-code {
      margin-left: $arrowPadding;
    }
  }

  // if dropdownContainer option is set, increase z-index to prevent display issues
  &--container {
    position: absolute;
    top: -1000px;
    left: -1000px;
    // higher than default Bootstrap modal z-index of 1050
    z-index: 1060;
    // to keep styling consistent with .flag-container
    padding: $borderWidth;
    &:hover {
      cursor: pointer;
    }
  }
}

// overrides for mobile popup (note: .iti-mobile class is applied on body)
.iti-mobile .iti {
  &--container {
    top: $mobilePopupMargin;
    bottom: $mobilePopupMargin;
    left: $mobilePopupMargin;
    right: $mobilePopupMargin;
    position: fixed;
  }
  &__country-list {
    max-height: 100%;
    width: 100%;
  }
  &__country {
    padding: 10px 10px;
    // increase line height because dropdown copy is v likely to overflow on mobile and when it does it needs to be well spaced
    line-height: 1.5em;
  }
}






@import "sprite";

.iti__flag {
  height: $flagHeight;
  box-shadow: 0px 0px 1px 0px #888;
  background-image: url("/images/flags/flags.png");
  background-repeat: no-repeat;
  // empty state
  background-color: #DBDBDB;
  background-position: $flagWidth 0;

  @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    background-image: url("/images/flags/flags@2x.png");
  }
}



// hack for Nepal which is the only flag that is not square/rectangle, so it has transparency, so you can see the default grey behind it
.iti__flag.iti__np {
  background-color: transparent;
}






</style>

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
                                <button class="btn btn-default signin_btn log_link">Login</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 signup_sec signup-signup">
                    <div class="row signup-signup-steemit">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4 class="sign_head">Create Account</h4>
                                <form name="signup">
                                    <div class="form-group input-username">
                                        <input type="text" name="username" class="form-control" required="true" placeholder="username">
                                        <span class="fa fa-user"></span>

                                        <span class="message" style="display: none"></span>
                                        <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                                    </div>
                                    <p style="margin: 0px;"><?php if($referrer !=''){ echo 'Referred By '.$referrer; } ?></p>
                                    <button class="next btn btn-lime" disabled>
                                        <i class="fas fa-spinner" style="display:none;"></i>
                                        <span>Continue</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="signup-signup-phone" style="display: none">
                        <div class="contact-info-block signup_block">
                            <div class="contact-info-inner signup_inner">
                                <h4>Verify Phone</h4>
                                <span class="signup-signup-icon">
                                    <span class="fa fa-phone"></span>
                                </span>
                                <p class="signup-signup-description">
                                    Enter your phone number. We will send you a text message with a verification code that you’ll need to enter on the next screen.
                                </p>
                                <form name="signup-phone">
                                    <span class="input-username">
                                        <input type="tel" name="phone" placeholder="+1"/>
                                        <span class="fa fa-phone"></span>

                                        <span class="message" style="display: none"></span>
                                        <span class="loader fa fas fa-circle-notch fa-spin" style="display: none"></span>
                                        <input id="phone" type="tel">
                                        <span id="valid-msg" class="hide">✓ Valid</span>
                                        <span id="error-msg" class="hide"></span>
                                    </span>
                                    <button class="next btn btn-lime" disabled>
                                        Send SMS
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> 
<script src="/js/signup.js"></script>
<script src="/js/intlTelInput.js"></script>
<!--https://github.com/jackocnr/intl-tel-input -->
<?php include('template/footer3.php'); ?>