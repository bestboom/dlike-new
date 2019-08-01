<?php

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
