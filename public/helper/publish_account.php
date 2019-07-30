<?php
namespace dlike\signup;
class makeAccount
{

    public function createAccount($user, $owner_key, $active_key, $posting_key, $memo_key)
    {
            $create = [
            "operations" => [
                ["create_claimed_account", [
                    "creator" => $_COOKIE['username'],
                    "newAccountName" => $user,
                    "owner" => $owner_key,
                    "active" => $active_key,
                    "posting" => $posting_key,
                    "memoKey" => $memo_key,
                    "jsonMetadata" => '',
                    "extensions" => []
                ]]
            ]
        ];

        $fixed_str = json_encode($create);
        //print($fixed_str);
        return $fixed_str;
    }
    
    public function broadcast($create)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://steemconnect.com/api/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $create,
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