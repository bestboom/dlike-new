<?php
session_start();

$url = parse_url(getenv("NEW_DATABASE_URL"));
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

$min_tip_withdraw = '3';

//time ago
function time_ago($timestamp)
{
    $etime = time() - $timestamp;
 
    if ($etime < 1)
    {
        return 'just now';
    }
 
    $a = array(12 * 30 * 24 * 60 * 60  =>  'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second');
 
    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}

$post_reward = '0.35';
$author_reward = '0.35';
$curator_reward = '0.30';
$affiliate_reward = '0.05';
?>