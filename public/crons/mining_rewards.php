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
        $minting_amount=$mining_reward * 1000000;
        $mint_amount=array($minting_amount);

        $defi_contract_wallet = $tron->address2HexString($defi_contract_acc);
        $lp_mining_wallet = $tron->address2HexString($dlike_mining_acc);
        $lp_mining_aff_wallet = $tron->address2HexString($dlike_mining_aff_acc);
        
        $abi = json_decode(ABI,true);

        $adminAddress=SIGNER;
        $signerAddress=$tron->address2HexString($adminAddress);
        $signerWallet = array($signerAddress);
        $tron->setAddress($adminAddress);
        $tron->setPrivateKey(SIGNER_PK);

        $contract = CONTRACT_ADDRESS;
        $function = 'transfer';
        $mintfunction = 'payToken';
        $widfunction = 'getToken';

        $params = array($lp_mining_aff_wallet , $lp_aff_amount );
        $lpparams = array($defi_contract_wallet , $lp_amount );
        $mintparams = array($signerWallet , $mint_amount );
        $widparams = array($minting_amount );

        $feeLimit = 1000000000;
        $callValue = 0;
       

        $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
        $signedTransaction = $tron->signTransaction($triggerContract);
        $response = $tron->sendRawTransaction($signedTransaction);
        if ($response['result'] == 1) {sleep(1);
            echo $trxid = $response['txid']; echo '<br>';


             $triggerLPContract = $tron->triggerContract($abi,$contract,$function,$lpparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
            $signedLPTransaction = $tron->signTransaction($triggerLPContract);
            $response_lp = $tron->sendRawTransaction($signedLPTransaction);
            if ($response_lp['result'] == 1) {sleep(1);
                echo $trxid_lp = $response_lp['txid'];


                $triggermintContract = $tron->triggerContract($abi,$contract,$mintfunction,$mintparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
                $signedmintTransaction = $tron->signTransaction($triggermintContract);
                $response_mint = $tron->sendRawTransaction($signedmintTransaction);
                if ($response_mint['result'] == 1) {sleep(3);
                    echo $trxid_mint = $response_mint['txid'];


                    $triggerwidContract = $tron->triggerContract($abi,$contract,$widfunction,$widparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
                    $signedwidTransaction = $tron->signTransaction($triggerwidContract);
                    $response_wid = $tron->sendRawTransaction($signedwidTransaction);
                    if ($response_wid['result'] == 1) {sleep(3);
                        echo $trxid_wid = $response_wid['txid'];


                    }

                }


            }
            //$sql_cur = $conn->query("INSERT INTO dlike_mining_rewards (trx_id, amount, trx_time) VALUES ('".$trxid."', '".$mining_reward."', now())");

            die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
        }else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}
    

    } else {die();}
?>+-