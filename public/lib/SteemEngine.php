<?php
/**
 * Created by PhpStorm.
 * User: Conor Howland
 * Date: 24/08/2019
 * Time: 16:36
 */
namespace SnaddyvitchDispenser\SteemEngine;
require "SteemEngineAPI.php";
class SteemEngine
{
    private $SteemEngineAPI;
    function __construct($rpc="https://api.steem-engine.com/rpc/")
    {
        $this->SteemEngineAPI = new SteemEngineAPI($rpc);
    }

    function get_user_balances($user = "null") {
        return $this->SteemEngineAPI->query_contract("tokens/balances", [ "account" => $user ]);
    }

    function get_market_sells($user = "null", $token = "") {
        $query = [];
        if (strlen($user) > 0) {
            $query["account"] = strtolower($user);
        }
        if (strlen($token) > 0) {
            $query["symbol"] = strtoupper($token);
        }
        return $this->SteemEngineAPI->query_contract("market/sellBook", $query);
    }

    function get_market_buys($user = "null", $token = "") {
        $query = [];
        if (strlen($user) > 0) {
            $query["account"] = strtolower($user);
        }
        if (strlen($token) > 0) {
            $query["symbol"] = strtoupper($token);
        }
        return $this->SteemEngineAPI->query_contract("market/buyBook", $query);
    }
    function get_tokens() {
        return $this->SteemEngineAPI->query_contract("tokens/tokens", []);
    }
    function get_undelegations($user = "", $token = "") {
        $query = [];
        if (strlen($user) > 0) {
            $query["account"] = strtolower($user);
        }
        if (strlen($token) > 0) {
            $query["symbol"] = strtoupper($token);
        }
        return $this->SteemEngineAPI->query_contract("tokens/pendingUndelegations", $query);
    }
    function get_delegations($query = []) {
        $finalQuery = [];
        foreach ($query as $item=>$value) {
            if (strlen($value) > 0) {
                $finalQuery[$item] = $value;
            }
        }
        return $this->SteemEngineAPI->query_contract("tokens/delegations", $finalQuery);
    }
    function get_user_balance_one($user = "NULL", $token="PAL") {
        return $this->SteemEngineAPI->query_contract("tokens/balances", ["account" => $user, "symbol" => $token]);
    }
}