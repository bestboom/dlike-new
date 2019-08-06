<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_account.php";

function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}

$accountGenerator = new dlike\signup\makeAccount();

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){
 
    $active_owner=getenv('active_account');

  $user =  $_POST['user'];
    $created_by = 'dlike';
    $owner_key = $_POST['owner'];
    $active_key = $_POST['active'];
    $posting_key = $_POST['posting'];
    $memo_key = $_POST['memo'];

    $return = array();
    $return['status'] = false;
    $return['message'] = '';

  if (empty($errors)) {
    $publish = $accountGenerator->createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key);
    $state = $accountGenerator->sendOperations($publish);
  } 

  if (isset($state)) { 
    $retusn['data']=$state;
      $return['status'] = true;
            $return['message'] = $retusn['data'];
  } else {
      $return['message'] = var_dump($publish);

  } 

    echo json_encode($return);
    exit;

} else {die('Some error');}
?>



<<<<<<< HEAD
exec('node -v', $o);
print_r($o);
?>
=======
have you discord or telegram or some other direct way of communication

can you directly accpet payment in skrill? 
=====

Skype: jochem.stoel
Discord: jochemstoel#7529

I prefer Skype but both is fine.

I don't know about Skrill, I'll have to check it out.

By the way, we are not supposed to talk outside of Freelancer.com it is against the rules.
>>>>>>> 1f69ae32acdf518a9a266bf3e71961f836039b1d



document.querySelector(".signup-signup-success .next.btn").addEventListener('click',function(event){
            event.preventDefault();
            let my_name = $('#my_username').html();
            let password = suggestPassword();
            console.log(password);
            let created_by = 'dlike';

            var publicKeys = steem.auth.generateKeys(my_name, password, ['owner', 'active', 'posting', 'memo']);
            var owner = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.owner, 1]] };
            var active = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.active, 1]] };
            var posting = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.posting, 1]] };
            var memo = { weight_threshold: 1, account_auths: [], key_auths: [[publicKeys.memo, 1]] };
            //console.log(memo);

            

            

             $.ajax({
                url: '/helper/create_account.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'acc_create',user:my_name,owner:owner,active:active,posting:posting,memo:memo},
                success:function(response){
                    console.log(response);
                    if(response.status)
                    {
                       toastr['success'](response.message);
                    }
                    else{
                        toastr['error'](response.message);
                        return false;
                    }
                },
                error: function(xhr, textStatus, error){
                          console.log(xhr.statusText);
                          console.warn(xhr.responseText);
                           console.log(textStatus);
                            console.log(error);
                }
            }); 


            /* 
$.ajax({
url: 'http://localhost:3000',
type: 'get',
dataType: 'json',
data: {my_name:my_name},
success:function(response){
console.log(response);
},
error: function(xhr, textStatus, error){
console.log(error);
}
}); 
           
            //let keys = getPrivateKeys(my_name, password);
            //console.log(keys);
            const ops = [];

            const create_op = [
              'create_claimed_account',
              {
                
                creator: created_by,
                new_account_name: my_name,
                extensions: [],
                json_metadata: '',
                active: dsteem.Authority.from(keys.activePubkey),
                memo_key: keys.memoPubkey,
                owner: dsteem.Authority.from(keys.ownerPubkey),
                posting: dsteem.Authority.from(keys.postingPubkey),
              },
            ];

            ops.push(create_op);
            console.log(ops);



            //myKeys:JSON.stringify(keys)
            steem.api.broadcast.sendOperations(ops, activekeyhere)
            .then((r) => {
            console.log(r);
            })
            .catch(e => {
            console.log(e);
            });
*/
             
/*