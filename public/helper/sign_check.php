<?php

broadcast($trx);
    public function broadcast($trx)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.steemit.com/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $trx,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }

?>

if (isset($_POST['action'])  && $_POST['action'] == 'acc_create' && isset($_POST['user'])  && $_POST['user'] != ''){

	$return = array();
	$return['status'] = false;
	$return['message'] = '';

	$user =  $_POST['user'];
	$keys = $_POST['owner'];
	//$keys   = json_decode("$keys", true);
	//$active_key =  $keys["active"];


		if($user != ''){
			$return['status'] = true;
			$return['message'] = var_dump($keys);
		}
		else{
			$return['message'] = 'data not good.';
		}
	echo json_encode($return);
	exit;
}

?>


             $.ajax({
                url: '/helper/create_account.php',
                type: 'post',
                cache : false,
                dataType: 'json',
                data: {action : 'acc_create',user:my_name,myKeys:JSON.stringify(keys)},
                success:function(response){

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
