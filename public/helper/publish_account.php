<?php
namespace dlike\signup;
class makeAccount
{

    public function createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key)
    {
        $active_owner='atit';
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
            ],
            "privatekry" => $active_owner,
        ];

        $fixed_str = json_encode($create);
        //print($fixed_str);
        return $fixed_str;
    }
    
    public function broadcast($create)
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: multipart/form-data"));
        curl_setopt($ch, CURLOPT_URL, "https://api.steemit.com/broadcast/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $create);
        $response = curl_exec($ch);
        echo $response;die();
        $err = curl_error($ch);
       


        if ($err) {
            return json_decode('{"error":"server_comms","error_description":"Failed to connect to the server!"}');
        } else {
            return json_decode($response);
        }
    }
}
