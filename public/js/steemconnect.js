//var sc = require('steemconnect');

var api = sc2.Initialize({
  app: 'techdev',
  callbackURL: 'http://localhost:8000/steemconnect/',
  accessToken: 'access_token',
  scope: [ 'login', 'vote', 'comment', 'delete_comment', 'comment_options', 'custom_json' ],
});


var steemconnect = {};
steemconnect.user = null;
steemconnect.metadata = null;
steemconnect.profile_image = null;


if ($.cookie("access_token") != null) {
  api.setAccessToken($.cookie("access_token"));
  api.me(function (err, result) {
    if (!err) {
      // Fill the steemconnect placeholder with results
      steemconnect.user = result.name;
      console.log(steemconnect.user);
      steemconnect.metadata = JSON.stringify(result.user_metadata, null, 2);
      steemconnect.profile_image = JSON.parse(steemconnect.user.json_metadata)['profile']['profile_image'];
    }
  });
};
var link = api.getLoginURL();