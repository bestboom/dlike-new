var domReady = (function () {
    var arrDomReadyCallBacks = [];

    function excuteDomReadyCallBacks() {
        for (var i = 0; i < arrDomReadyCallBacks.length; i++) {
            arrDomReadyCallBacks[i]();
        }
        arrDomReadyCallBacks = [];
    }

    return function (callback) {
        arrDomReadyCallBacks.push(callback);
        /* Mozilla, Chrome, Opera */
        if (document.addEventListener) {
            document.addEventListener('DOMContentLoaded', excuteDomReadyCallBacks, false);
        }
        /* Safari, iCab, Konqueror */
        if (/KHTML|WebKit|iCab/i.test(navigator.userAgent)) {
            browserTypeSet   = true;
            var DOMLoadTimer = setInterval(function () {
                if (/loaded|complete/i.test(document.readyState)) {
                    //callback();
                    excuteDomReadyCallBacks();
                    clearInterval(DOMLoadTimer);
                }
            }, 10);
        }
        /* Other web browsers */

        window.onload = excuteDomReadyCallBacks;
    }
})();

domReady(function () {
    var Client = new dsteem.Client('https://api.steemit.com');

    var FormSignUp = document.querySelector('form[name="signup"]');
    var Input      = FormSignUp.querySelector('[name="username"]');
    var Message    = FormSignUp.querySelector('.message');
    var Loader     = FormSignUp.querySelector('.loader');
    var Next       = FormSignUp.querySelector('.next');

    var msg_inuse       = 'This username is already in use.';
    var msg_notAllowed  = 'This username is not allowed.';
    var msg_isAvailable = 'This username is available.';
    var msg_error       = 'Unfortunately an error occurred. The name could not be checked :(';

    FormSignUp.addEventListener('submit', function (event) {
        event.stopPropagation();
        event.preventDefault();
        signUpPhoneCheck();
        return false;
    });

    var Timeout = null;

    var showSuccessIcon = function () {
        Loader.classList.remove('fa-circle-notch');
        Loader.classList.remove('fa-spin');
        Loader.classList.add('fa-check');
    };

    var showErrorIcon = function () {
        Loader.classList.remove('fa-circle-notch');
        Loader.classList.remove('fa-spin');
        Loader.classList.add('fa-exclamation-circle');
    };

    var showLoader = function () {
        Loader.classList.add('fa-circle-notch');
        Loader.classList.add('fa-spin');
        Loader.classList.remove('fa-check');
        Loader.classList.remove('fa-exclamation-circle');
        Loader.style.display = '';
    };

    var checkUsername = function () {
        var username = Input.value;

        if (username.length <= 2) {
            Message.innerHTML     = msg_notAllowed;
            Message.style.display = '';
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showLoader();
            showErrorIcon();
            return;
        }

        Message.style.display = '';
        Message.innerHTML     = 'Checking username...';
        Message.classList.remove('signup-message-success');
        Message.classList.remove('signup-message-error');

        Next.disabled = true;
        showLoader();

        Client.database.call('get_accounts', [[username]]).then(function (result) {
            //Loader.style.display  = 'none';
            Message.style.display = '';

            if (result.length) {
                Message.innerHTML = msg_inuse;
                Message.classList.remove('signup-message-success');
                Message.classList.add('signup-message-error');
                showErrorIcon();
                return;
            }

            Message.innerHTML = msg_isAvailable;
            Message.classList.add('signup-message-success');
            Message.classList.remove('signup-message-error');

            Next.disabled = false;
            showSuccessIcon();
        }, function (err) {
            console.error(err);

            Message.innerHTML = msg_error;
            Message.classList.remove('signup-message-success');
            Message.classList.add('signup-message-error');
            showErrorIcon();
        });
    };

    Input.addEventListener('keyup', function () {
        if (Timeout) {
            clearTimeout(Timeout);
        }

        Timeout = setTimeout(checkUsername, 250);
    });
});
function signUpPhoneCheck() {
    var Signup  = document.querySelector('.signup-signup');
    var Steemit = Signup.querySelector('.signup-signup-steemit');
    var Phone   = Signup.querySelector('.signup-signup-phone');

    jQuery(Steemit).animate({
        opacity: 0,
        top    : -20
    }, 300, function () {
        Steemit.style.display = 'none';

        Phone.style.opacity = 0;
        Phone.style.top     = '50px';
        Phone.style.display = '';

        jQuery(Phone).animate({
            opacity: 1,
            top    : 0
        }, 300);
    });
}

var input = document.querySelector("#phone"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

// initialise plugin
var iti = window.intlTelInput(input, {
  utilsScript: "/js/phone_input.js"
});

var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);