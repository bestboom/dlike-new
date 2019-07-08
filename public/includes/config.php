<?php
session_start();

$privkey=getenv('privkey');
$hashkey=getenv('hashkey');

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$server = $url["host"]; 
$username = $url["user"]; 
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//Test if it is a shared client

function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$thisip = getUserIP();
$ip = ip2long($thisip);

$_SESSION['usertoken'] = $ip;

if(!isset($_COOKIE['usertoken'])) {
  setcookie('usertoken', $_SESSION['usertoken'], time() + (86400 * 30), "/");
} else {$_COOKIE['usertoken'];}

$min_tip_withdraw = '0';


?>
