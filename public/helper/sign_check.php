<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){


	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$user =  $_POST['user'];
	//$keys = $_POST['myKeys'];
	//$keys   = json_decode("$keys", true);
	//$active_key =  $keys["active"];
	//$ops = $_POST['ops'];
	//$opst = echo '<script>let ops = $ops;</script>';
	//$password = echo '';
	echo '<script>

				let ditp = (async function(){
				toastr.error("phew... You forgot to enter URL");

			})();</script>';
	if($user != ''){ 	

			$return['status'] = true;
			$return['message'] = 'Looks data done';
		}
		else{
			$return['message'] = 'data not good.';
		}
	echo json_encode($return);
	exit;
}

?>


<!--
            

            steem.api.broadcast.sendOperations(ops, activekeyhere)
            .then((r) => {
            console.log(r);
            })
            .catch(e => {
            console.log(e);
            });



            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://unpkg.com/dsteem@^0.10.1/dist/dsteem.js"></script>
<script type="text/javascript">
		
			var Client = new dsteem.Client('https://api.steemit.com');

		    function suggestPassword() {
		        const array = new Uint32Array(10);
		        window.crypto.getRandomValues(array);
		        return 'P' + dsteem.PrivateKey.fromSeed(array).toString();
		    }

		    function getPrivateKeys(username, password, roles = ['owner', 'active', 'posting', 'memo']) {
		        const privKeys = {};
		        roles.forEach((role) => {
		            privKeys[role] = dsteem.PrivateKey.fromLogin(username, password, role).toString();
		            privKeys[`${role}Pubkey`] = dsteem.PrivateKey.from(privKeys[role]).createPublic().toString();
		        });

		        return privKeys;
		    };
		    let password = suggestPassword();
            console.log(password);

            let created_by = 'dlike';

            const ops = [];

            let keys = getPrivateKeys(my_name, password);
            console.log(keys);

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
</script>
-->