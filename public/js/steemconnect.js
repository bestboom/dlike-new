var sc = require('steemconnect');

var api = sc.Initialize({
  app: 'busy',
  callbackURL: 'http://localhost:8000/demo/',
  accessToken: 'access_token',
  scope: ['vote', 'comment']
});

var link = api.getLoginURL(state);
console.log(link);