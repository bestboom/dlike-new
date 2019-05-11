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
    var Client  = new dsteem.Client('https://api.steemit.com');
    var Input   = document.querySelector('form[name="signup"] [name="username"]');
    var Message = document.querySelector('form[name="signup"] .message');
    var Loader  = document.querySelector('form[name="signup"] .loader');
    var Next    = document.querySelector('form[name="signup"] .next');

    var msg_inuse       = 'This username is already in use.';
    var msg_notAllowed  = 'This username is not allowed.';
    var msg_isAvailable = 'This username is is available.';

    var Timeout = null;

    var checkUsername = function () {
        var username = Input.value;

        if (username.length <= 2) {
            Message.innerHTML     = msg_notAllowed;
            Message.style.display = '';
            return;
        }

        Message.style.display = '';
        Message.innerHTML     = 'Checking username...';
        Loader.style.display  = '';

        Next.disabled = true;

        Client.database.call('get_accounts', [[username]]).then(function (result) {
            Loader.style.display  = 'none';
            Message.style.display = '';

            if (result.length) {
                Message.innerHTML = msg_inuse;
                return;
            }

            Message.innerHTML = msg_isAvailable;
            Next.disabled     = false;
        });
    };

    Input.addEventListener('keyup', function () {
        if (Timeout) {
            clearTimeout(Timeout);
        }

        Timeout = setTimeout(checkUsername, 250);
    });
});
