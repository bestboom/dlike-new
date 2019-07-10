//var sc = require('steemconnect');

var api = steemconnect.Initialize({
    app        : 'dlike.app',
    callbackURL: 'https://dlike.io/steemconnect',
    accessToken: 'access_token',
    scope      : ['vote', 'comment', 'comment_options', 'offline', 'custom_json', 'claim_reward_balance'],
});


if ($.cookie("access_token") != null) {
    var username  = $.cookie("username");
    var user_auth = $.cookie("access_token");

    var profile_image = "https://steemitimages.com/u/" + username + "/avatar";

    $('#user_log').html(username);
    $("#user_img").attr("src", "https://steemitimages.com/u/" + username + "/avatar").show();
    $("#user_label").html('<b>Steem UserName is</b>');
} else {
    var link = api.getLoginURL();
    $('.log_link').attr('href', link);
    $("#user_label").html('<b>Enter Some UserName</b>');
}
