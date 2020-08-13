<?php
error_reporting(E_ALL);
ini_set('display_errors',0);
include_once 'vendor/autoload.php';
include_once 'contract_config.php';
    //$wallets = array($tron->address2HexString('TXB9bvvvTWHTwVAJq4wuuMVCjYUbLhYAcz'));
    $wallets = array("41e89ccbbd23c0d0ecf24393865a41536fafd6db3d");
    $amounts = array("10000000");
    $abi = json_decode(ABI,true);

    $vAdminAddress=SIGNER;
    $vHExAddress=$tron->address2HexString($vAdminAddress);
    $tron->setAddress($vAdminAddress);
    $tron->setPrivateKey(SIGNER_PK);

    $vUserAddress=$data['userWallet'];
    //$vHExUser=$tron->address2HexString($vUserAddress);

    // write contract data
    $contract = CONTRACT_ADDRESS;
   
    $function = 'multiMintToken';
    //$vSendAmount  = $vSendAmount * 1e6;
    //$params= array($vHExUser, $vSendAmount);
    $params = array($wallets , $amounts );
    $address =  $vHExAddress;
    $feeLimit = 1000000000;
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

?>

