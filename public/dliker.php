<?php
include "./template/header5.php"; 
$user_name = $_COOKIE['username'];

require_once "./lib/SteemEngine.php";
require_once "./lib/time_string.php";
use SnaddyvitchDispenser\SteemEngine\SteemEngine;
$_STEEM_ENGINE = new SteemEngine();

function getTokensToClaim($name) {
    $url="https://scot-api.steem-engine.com/@".$name."?v=".time()."000";
    $obj=json_decode(file_get_contents($url));
    $pendingTokens=array();
    foreach ($obj as $data) {
        if ($data->pending_token>0) {
            $pendingTokens[$data->symbol]=$data->pending_token;
        }
    }
    return $pendingTokens;
}
function getClaimDetails($name,$tokens) {
    if (count($tokens)>0) {
        $arr=[];
        foreach ($tokens as $token=>$value) {
            $arr[]=["symbol"=>$token];
        }
        $json=json_encode($arr);
        $url="https://steemconnect.com/sign/custom-json?required_posting_auths=".urlencode("[\"".$name."\"]")."&authority=active&id=scot_claim_token&json=".urlencode($json);
        return [$url,["scot_claim_token", $json, $name]];
    }
    return [];
}

function get_recent_transactions ($account = "null") {
    $recent = file_get_contents("https://api.steem-engine.com/accounts/history?account=$account&limit=100&offset=0&type=user&symbol=DLIKER");
    try {
        $json = json_decode($recent);
        return $json;
    } catch (Exception $exception) {
        return (object) [];
    }
}


?>
</div>
<div class="catagori-section">
    <div class="container">
        <div id="loadings"><img src="/images/loader.svg" width="100"></div>
        <div class="row" id="content">
        </div>
    </div>
</div>
<style>
.row-3 { justify-content: space-between;width: 98%;padding: 12px 18px 6px 8px;}
.row-2 {justify-content: space-between;background-color: #f4f4f4;width: 98%;padding: 12px 18px 12px 8px;}
</style>

<?php
include "./template/footer.php"; 
?>
<script type="text/javascript">
    $( document ).ready(function() {    
        $('#loadings').delay(6000).fadeOut('slow');
    })   
</script>