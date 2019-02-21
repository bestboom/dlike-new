//var sc = require('steemconnect');

var api = sc2.Initialize({
  app: 'techdev',
  callbackURL: 'http://localhost:8000/steemconnect/',
  accessToken: 'access_token',
  scope: [ 'login', 'vote', 'comment', 'delete_comment', 'comment_options', 'custom_json' ],
});



if ($.cookie("access_token") != null) {
var username = $.cookie("username");
var profile_image = "https://steemitimages.com/u/" + username + "/avatar";
$('#user_log').html(username);
$("#user_img").attr("src","https://steemitimages.com/u/" + username + "/avatar");
} else {
	$("#user_img").hide();
	var link = api.getLoginURL();
	$('.log_link').attr('href',link);
};