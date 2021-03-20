<?php
require '../includes/config.php';

$sql_D=$conn->query("SELECT * FROM dlike_rewards_history where DATE(update_time) = CURDATE()");
    if ($sql_D->num_rows > 0) {$row_D = $sql_D->fetch_assoc();$mining_reward = $row_D["dlike_mining"];
    $lp_percentage = '0.9';
    $lp_aff_percentage = '0.1';
    $lp_reward = $mining_reward * $lp_percentage;
    $lp_aff_reward = $mining_reward * $lp_aff_percentage;

    include_once '../vendor/autoload.php';
    include_once '../includes/contract_config.php';


        $lp_amount = $lp_reward * 1000000;
        $lp_aff_amount = $lp_aff_reward * 1000000;
        $amounts = array($lp_amount, $lp_aff_amount);

        $lp_mining_wallet = $tron->address2HexString($dlike_mining_acc);
        $lp_mining_aff_wallet = $tron->address2HexString($dlike_mining_aff_acc);
        $wallets = array($lp_mining_wallet, $lp_mining_aff_wallet);
        
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
        $response = $tron->sendRawTransaction($signedTransaction);
        if ($response['result'] == 1) {
            $trxid = $response['txid'];
            $sql_cur = $conn->query("INSERT INTO dlike_mining_rewards (trx_id, amount, trx_time) VALUES ('".$trxid."', '".$mining_reward."', now())");


            $mining_pk = getenv("MINING_PK");
            //$miningaff_pk = getenv("MININGAFF_PK");

            $lpaddress=$tron->address2HexString($dlike_mining_acc);
            $tron->setAddress($dlike_mining_acc);
            $tron->setPrivateKey($mining_pk);
            $lpfunction = 'getToken';
            $lpparams=array($lp_amount);

            $triggerLPContract = $tron->triggerContract($abi,$contract,$lpfunction,$lpparams,$feeLimit,$lpaddress,$callValue ,$bandwidthLimit = 0);
            $signedLPTransaction = $tron->signTransaction($triggerLPContract);
            $response_lp = $tron->sendRawTransaction($signedLPTransaction);
            if ($response_lp['result'] == 1) {
            echo $trxidlp=$response_lp['txid'];}else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

            die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
        }else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
    

    } else {die();}
?>