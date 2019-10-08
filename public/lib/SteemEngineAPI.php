<?php
/**
 * Created by PhpStorm.
 * User: Conor Howland
 * Date: 25/08/2019
 * Time: 16:56
 */
namespace SnaddyvitchDispenser\SteemEngine;
class SteemEngineAPI
{
    private $RPC_URL;
    function __construct($rpc="https://api.steem-engine.com/rpc/")
    {
        $this->RPC_URL = $rpc;
    }

    function query_contract($location = "tokens/balances", $query = []) {
        try {
            $location = explode("/", $location);
            if (sizeof($location) < 2) {
                return false;
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->RPC_URL . "contracts",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode([["method" => "find", "jsonrpc" => "2.0", "params" => ["contract" =>  $location[0], "table" =>  $location[1], "query" => $query, "limit" => 1000, "offset " => 0, "indexes" => []],  "id" => 1]]),
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/json",
                    "User-Agent: steemengine v0.5.0"
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                return false;
            } else {
                $result = json_decode($response);
                if (isset($result[0]->result)) {
                    return $result[0]->result;
                } else {
                    return false;
                }
            }
        } catch (\Exception $exception) {
            return false;
        }
    }
}