const dsteem = require('dsteem');
const steem = require('steem');
const client = new dsteem.Client('https://api.steemit.com');


const my_name = 'fanfeo';
console.log(my_name);
const created_by = 'dlike';
const getRandomValues = require('get-random-values');
const creator_key = process.env.active_account;

//lets generate password
    function suggestPassword() {
        const array = new Uint32Array(10);
        getRandomValues(array);
        return 'P' + dsteem.PrivateKey.fromSeed(array).toString();
    }

const password = suggestPassword();
console.log(password);

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
    console.log(ops);


//this code will send data to api and get back call
  client.broadcast.sendOperations(ops, dsteem.PrivateKey.from(creator_key))
  .then((r) => {
  console.log(r);
  })
  .catch(e => {
  console.log(e);
  });
