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
        $abilp = json_decode(ABILP,true);

        $adminAddress=SIGNER;
        $signerAddress=$tron->address2HexString($adminAddress);
        $signerWallet = array($signerAddress);
        $tron->setAddress($adminAddress);
        $tron->setPrivateKey(SIGNER_PK);

        $contract = CONTRACT_ADDRESS;
        $nfcontract="410aa5bc10d5837c78120bc1a25945a6aab227d424";
        $function = 'transfer';
        $mintfunction = 'payToken';
        $widfunction = 'getToken';
        $nffunction = 'notifyRewardAmount';

        $params = array($lp_mining_aff_wallet , $lp_aff_amount );
        $lpparams = array($defi_contract_wallet , $lp_amount );
        $mintparams = array($signerWallet , $mint_amount );
        $widparams = array($minting_amount );
        $nfparams = array($lp_amount );

        $feeLimit = 1000000000;
        $callValue = 0;
       

        $triggerContract = $tron->triggerContract($abi,$contract,$function,$params,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
        $signedTransaction = $tron->signTransaction($triggerContract);
        $response = $tron->sendRawTransaction($signedTransaction);
        if ($response['result'] == 1) {sleep(1);
            $trxid = $response['txid']; $status = "Affiliate Transfer";
            $sql_cur = $conn->query("INSERT INTO dlike_mining_rewards (trx_id, to_address, amount, status, trx_time) VALUES ('".$trxid."', '".$dlike_mining_aff_acc."', '".$lp_aff_reward."', '".$status."', now())");


            $triggerLPContract = $tron->triggerContract($abi,$contract,$function,$lpparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
            $signedLPTransaction = $tron->signTransaction($triggerLPContract);
            $response_lp = $tron->sendRawTransaction($signedLPTransaction);
            if ($response_lp['result'] == 1) {sleep(1);
                $trxid_lp = $response_lp['txid'];$lpstatus="DeFi Contract Transfer";
                $sql_lp=$conn->query("INSERT INTO dlike_mining_rewards (trx_id, to_address, amount, status, trx_time) VALUES ('".$trxid_lp."', '".$defi_contract_acc."', '".$lp_reward."', '".$lpstatus."', now())");


                $triggerNFContract = $tron->triggerContract($abilp,$nfcontract,$nffunction,$nfparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
                $signedNFTransaction = $tron->signTransaction($triggerNFContract);
                $response_nf = $tron->sendRawTransaction($signedNFTransaction);
                if ($response_nf['result'] == 1) {sleep(1);
                    $trxid_nf = $response_nf['txid'];$nfstatus="Notify Reward Amount";
                    $sql_nf=$conn->query("INSERT INTO dlike_mining_rewards (trx_id, to_address, amount, status, trx_time) VALUES ('".$trxid_nf."', '".$defi_contract_acc."', '".$lp_reward."', '".$nfstatus."', now())");


                    $triggermintContract = $tron->triggerContract($abi,$contract,$mintfunction,$mintparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
                    $signedmintTransaction = $tron->signTransaction($triggermintContract);
                    $response_mint = $tron->sendRawTransaction($signedmintTransaction);
                    if ($response_mint['result'] == 1) {sleep(3);
                        $trxid_mint = $response_mint['txid'];$mintstatus = "Tokens Minted";
                        $sql_mint=$conn->query("INSERT INTO dlike_mining_rewards (trx_id, to_address, amount, status, trx_time) VALUES ('".$trxid_mint."', '".$adminAddress."', '".$mining_reward."', '".$mintstatus."', now())");


                        $triggerwidContract = $tron->triggerContract($abi,$contract,$widfunction,$widparams,$feeLimit,$signerAddress,$callValue ,$bandwidthLimit = 0);
                        $signedwidTransaction = $tron->signTransaction($triggerwidContract);
                        $response_wid = $tron->sendRawTransaction($signedwidTransaction);
                        if ($response_wid['result'] == 1) {sleep(3);
                            $trxid_wid = $response_wid['txid'];$widstatus="Tokens Withdrawan";
                            $sql_wid=$conn->query("INSERT INTO dlike_mining_rewards (trx_id, to_address, amount, status, trx_time) VALUES ('".$trxid_wid."', '".$adminAddress."', '".$mining_reward."', '".$widstatus."', now())");

                        }

                    }
                } 
            }

            die(json_encode(['error' => false,'message' => 'All is fine to withdraw!']));
        }else{die(json_encode(['error' => true,'message' => $e->getMessage()]));}

    } else {die();}
?>