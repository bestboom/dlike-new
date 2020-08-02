<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';

if(isset($_POST['userwallet']) && isset($_POST['amount']) && $_POST['userwallet']!="" && $_POST['amount']!=0){
$amount = $_POST['amount'];
$wallet = $_POST['userwallet'];

//$amount = '2';
//$wallet = 'THaN8wCALGPtUtQEKmJ1xsN1TZ4MZ69BVJ';

    $addressValidate =  $tron->validateaddress($wallet);
      if( $addressValidate['result'] == false){
          die(json_encode(['error' => true,'message' => $addressValidate['message']]));
          //$result = array('Message'=>'Error! '.$addressValidate['message'] ,'Response'=>'failure', 'Hash' => '-');
          //echo json_encode($result);
          //exit;
      }

    $vSendAmount=$amount; 
    $abi = json_decode(ABI,true);
    $vAdminAddress=SIGNER;
    $vHExAddress=$tron->address2HexString($vAdminAddress);
    $tron->setAddress($vAdminAddress);
    $tron->setPrivateKey(SIGNER_PK);

    $vUserAddress=$wallet;
    $vHExUser=$tron->address2HexString($vUserAddress);

    // write contract data
    $contract = CONTRACT_ADDRESS;
   
    $function = 'mintToken';
    $vSendAmount  = $vSendAmount * 1e6;
    $params= array($vHExUser, $vSendAmount);
    $address =  $vHExAddress;
    $feeLimit = 10000000;
    $callValue = 0;

    //try {
       
          $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue ,$bandwidthLimit = 0);
          $signedTransaction = $tron->signTransaction($triggerContract);
          $response = $tron->sendRawTransaction($signedTransaction);
          if ($response['result'] == 1) {
            die(json_encode(['error' => false,'message' => 'Success!', 'hash' => $triggerContract['txID']]));
            //die(json_encode(['error' => false,'message' => 'Success!']));
            //$result = array('Message'=>'Success !','Response'=>'success', 'Hash' => $triggerContract['txID']);
            //echo json_encode($result);
          } else {die(json_encode(['error' => true,'message' => 'it seems some issue in token withdraw on tron end!']));}
    //} catch (\IEXBase\TronAPI\Exception\TronException $e) {
      //die(json_encode(['error' => true,'message' => $e->getMessage()]));
      //$result = array('Message'=>'Error! '.$e->getMessage(),'Response'=>'failure', 'Hash' => '-');
      //echo json_encode($result);
    //}      
      
}else{die(json_encode(['error' => true,'message' => 'Error! Wallet address or amount is missing']));
//      $result = array('Message'=>'Error! Wallet address or amount is missing','Response'=>'failure', 'Hash' => '');
//        echo json_encode($result);
//        exit;
}


?>