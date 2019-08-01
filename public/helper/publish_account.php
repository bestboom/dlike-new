<?php
namespace dlike\signup;
class makeAccount
{

    public function createAccount($created_by, $user, $owner_key, $active_key, $posting_key, $memo_key)
    {
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

        $fixed_str = json_encode($create);
        print($fixed_str);
        return $fixed_str;
    }
    
    public function broadcast($create)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.steemit.com/broadcast",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_POSTFIELDS => $create,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
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