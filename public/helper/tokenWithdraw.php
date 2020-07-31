<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';

if(isset($_POST['userwallet']) && isset($_POST['amount']) && $_POST['userwallet']!="" && $_POST['amount']!=0){

      $addressValidate =  $tron->validateaddress($_POST['userwallet']);
        if( $addressValidate['result'] == false){
            $result = array('Message'=>'Error! '.$addressValidate['message'] ,'Response'=>'failure', 'Hash' => '-');
            echo json_encode($result);
            exit;
        }
    $vSendAmount=$_POST['amount']; 
    $abi = json_decode(ABI,true);
    $vAdminAddress=SIGNER;
    $vHExAddress=$tron->address2HexString($vAdminAddress);
    $tron->setAddress($vAdminAddress);
    $tron->setPrivateKey(SIGNER_PK);

    $vUserAddress=$_POST['userwallet'];
    $vHExUser=$tron->address2HexString($vUserAddress);

    // write contract data
    $contract = CONTRACT_ADDRESS;
   
    $function = 'mintToken';
    $params= array($vHExUser, $vSendAmount);
    $address =  $vHExAddress;
   

    $feeLimit = 10000000;
    $callValue = 0;

      try {
       
          $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$address,$callValue ,$bandwidthLimit = 0);
          $signedTransaction = $tron->signTransaction($triggerContract);
          $response = $tron->sendRawTransaction($signedTransaction);
          if ($response['result'] == 1) {
             $result = array('Message'=>'Success !','Response'=>'success', 'Hash' => $triggerContract['txID']);
              echo json_encode($result);
          }
    } catch (\IEXBase\TronAPI\Exception\TronException $e) {
        $result = array('Message'=>'Error! '.$e->getMessage(),'Response'=>'failure', 'Hash' => '-');
        echo json_encode($result);
    }      
      
}else{
        $result = array('Message'=>'Error! Wallet address or amount is missing','Response'=>'failure', 'Hash' => '');
        echo json_encode($result);
        exit;
}
?>