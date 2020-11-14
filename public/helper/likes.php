<?php
    
require '../includes/config.php';
include_once '../vendor/autoload.php';
include_once '../includes/contract_config.php';


    $wallet = "TJgDQeww1ca3q4CE1umEk3RtRLBD3G46aN";
    $dlkamount = "20";
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
    print_r($signedTransaction);echo "transaction here <br>";

    $response = $tron->sendRawTransaction($signedTransaction);
    print_r($response);
    if ($response['result'] == 1) {

        $status="In";
        echo "start db here";echo "<br>";
        $sql_cur = $conn->query("INSERT INTO dlike_tokens_mapping (username, tron_address, amount, status, update_time) VALUES ('".$username."', '".$wallet."', '".$dlkamount."', '".$status."', now())");

        echo "dataBASE entry here";
    }else{echo $e->getMessage();}


?>