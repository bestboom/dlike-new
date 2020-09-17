<?php 
require '../includes/config.php';
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

			$wallet="THaN8wCALGPtUtQEKmJ1xsN1TZ4MZ69BVJ";
			$dlkamount = "31";
			$amount = $dlkamount * 1000000;

	    	$wallets = array($tron->address2HexString($wallet));
	    	$amounts = array($amount);
	    	$abi = json_decode(ABI,true);

	    	$vAdminAddress=SIGNER;
	    	$vHExAddress=$tron->address2HexString($vAdminAddress);
	    	$tron->setAddress($vAdminAddress);
	    	$tron->setPrivateKey(SIGNER_PK);

	    	$contract = CONTRACT_ADDRESS;
	    	$function = 'payToken';

	    	$params = array($wallets , $amounts );
	    	$address =  $vHExAddress;
	    	$feeLimit = 1000000000;
	    	$callValue = 0;
	       
	        $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue ,$bandwidthLimit = 0);
	        $signedTransaction = $tron->signTransaction($triggerContract);
	        //$response = $tron->sendRawTransaction($signedTransaction);
	        //if ($response['result'] == 1) {
	            //die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
	        //}else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
?>