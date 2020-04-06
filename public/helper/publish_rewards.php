<?php
namespace SnaddyvitchDispenser\rewards;
class claim_rewards
{
    public function claim_all() {
        $get = $this->get_reward_balances($this->me());
        if ($get != null) {
            $claim = $this->raw_claim($get);
            $ret = $this->broadcast($claim);
            if (isset($ret->error_description) and $ret->error_description == "reward_steem.amount > 0 || reward_sbd.amount > 0 || reward_vests.amount > 0: Must claim something.") {
                return [true, $get];
            } else {
                return [!isset($ret->error), $get];
            }
        } else {
            return [false, []];
        }
    }
    public function raw_claim($claimobject)
    {
        $post = [
            "operations" => [
                ["claim_reward_balance", $claimobject]
            ]
        ];
        $fixed_str = json_encode($post);
        //print($fixed_str);
        return $fixed_str;
    }
    public function get_reward_balances($me) {
        if (isset($me->account->reward_vesting_balance)) {
            return [
                "account" => $me->user,
                "reward_steem" => $me->account->reward_steem_balance,
                "reward_sbd" => $me->account->reward_sbd_balance,
                "reward_vests" => $me->account->reward_vesting_balance,
                "reward_sp" => $me->account->reward_vesting_steem
            ];
        }
        return null;
    }
    public function me()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.steemlogin.com/api/me",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => "{}",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: " . $_COOKIE['access_token'],
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }
    public function broadcast($txn)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://steemconnect.com/api/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $txn,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: " . $_COOKIE['access_token'],
                "cache-control: no-cache",
                "content-type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }
}