//var sc = require('steemconnect');

var api = sc2.Initialize({
  app: 'dlike.app',
  callbackURL: 'http://localhost:8000/steemconnect/',
  accessToken: 'access_token',
  scope: [ 'login', 'vote', 'comment', 'delete_comment', 'comment_options', 'custom_json' ],
});

api.me(function (err, res) {
  console.log(err, res)
});

if ($.cookie("access_token") != null) {
  api.setAccessToken($.cookie("access_token"));
  api.me(function (err, result) {
     console.log('/me', err, result); // DEBUG
    if (!err) {
      // Fill the steemconnect placeholder with results
      steemconnect.user = result.account;
      console.log(steemconnect.user);
      steemconnect.metadata = JSON.stringify(result.user_metadata, null, 2);
      steemconnect.profile_image = JSON.parse(steemconnect.user.json_metadata)['profile']['profile_image'];
    }
  });
};
var link = api.getLoginURL();
console.log(link);