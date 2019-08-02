<?php
namespace dlike\signup;
class makeAccount
{

    //public function createAccount($created_by='', $user='', $owner_key='', $active_key='', $posting_key='', $memo_key='')
    public function createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key)
    {
        $active_owner=getenv('active_account');
        $create = [
            "operations" => [
                ["create_claimed_account", [
                    "creator" => $created_by,
                    "new_account_name" => $user,
                    "owner" => $owner_key,
                    "active" => $active_key,
                    "posting" => $posting_key,
                    "memo_key" => $memo_key,
                    "json_metadata" => '',
                    "extensions" => []
                ]]
            ]
        ];

        //$fixed_str = json_encode($create);
        //print($fixed_str);
        return $create;
    }
    
    public function sendOperations($create)
    {
       
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.steemit.com/broadcast/");
        //curl_setopt($ch, CURLOPT_URL, "https://steemconnect.com/api/broadcast/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($create));
        $response = curl_exec($ch);
        $err = curl_error($ch);
       


        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_encode($response);
        }
    }
}
