const express = require('express');
const app = express();

const dsteem = require('dsteem');
const steem = require('steem');
const getRandomValues = require('get-random-values');
const client = new dsteem.Client('https://api.steemit.com');

const my_name = 'madmouse';
const created_by = 'dlike';
const creator_key = '5K8VEy24t3mB9yw9hPzkfFGeMkupnQmH3zfkuQC7JAFJJuwDDuY';

//lets generate password
function suggestPassword() {
  const array = new Uint8Array(10);
  getRandomValues(array);
  return 'P' + dsteem.PrivateKey.fromSeed(array).toString();
}

const password = suggestPassword();

// lets generate keys
const publicKeys = steem.auth.generateKeys(my_name, password, ['owner', 'active', 'posting', 'memo']);
const owner_key = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.owner, 1]] };
const active_key = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.active, 1]] };
const posting_key = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.posting, 1]] };
const memo_key = publicKeys.memo;

//now geenrate operation for api
const ops = [];
const create_op = [
  'create_claimed_account',
  {
    creator: created_by,
    new_account_name: my_name,
    extensions: [],
    json_metadata: '',
    active: active_key,
    memo_key: memo_key,
    owner: owner_key,
    posting: posting_key,
  },
];

ops.push(create_op);

app.set('port', (process.env.PORT || 3000));
app.use(express.static(__dirname + '/'));

app.get('/', function(request, response) {
  client.broadcast.sendOperations(ops, dsteem.PrivateKey.from(creator_key))
    .then((r) => {
      response.send(r)
    })
    .catch(e => {
      response.send(e)
    });
});

app.listen(app.get('port'), function() {
  console.log("Node app is running at localhost:" + app.get('port'))
});