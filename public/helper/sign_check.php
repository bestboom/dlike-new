<?php

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$user =  $_POST['user'];
	//$keys = $_POST['myKeys'];
	//$keys   = json_decode("$keys", true);
	//$active_key =  $keys["active"];
	$ops = $_POST['ops'];
	$opst = echo '<script>let ops = $ops;</script>';

		if($user != ''){





			$return['status'] = true;
			$return['message'] = 'Looks data done'.$opst. $ops;
		}
		else{
			$return['message'] = 'data not good.';
		}
	echo json_encode($return);
	exit;
}

?>


/*
            

            steem.api.broadcast.sendOperations(ops, activekeyhere)
            .then((r) => {
            console.log(r);
            })
            .catch(e => {
            console.log(e);
            });
*/
