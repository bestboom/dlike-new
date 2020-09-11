<?php
session_start();

$url = parse_url(getenv("NEW_DATABASE_URL"));
$server = $url["host"]; 
$username = $url["user"]; 
$password = $url["pass"];
$db = substr($url["path"], 1);

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);} 

function getUserIP()
{   if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP))
    {$ip = $client;}elseif(filter_var($forward, FILTER_VALIDATE_IP)){$ip = $forward;}else{$ip = $remote;}
    return $ip;
}

$thisip = getUserIP();
$ip = ip2long($thisip);

$_SESSION['usertoken'] = $ip;

if(!isset($_COOKIE['usertoken'])) {setcookie('usertoken', $_SESSION['usertoken'], time() + (86400 * 30), "/");
} else {$_COOKIE['usertoken'];}

function time_ago($timestamp)
{   $etime = time() - $timestamp;
    if ($etime < 1){return 'just now';}
    $a = array(12 * 30 * 24 * 60 * 60  =>  'year', 30 * 24 * 60 * 60 => 'month', 24 * 60 * 60 => 'day', 60 * 60 => 'hour', 60 => 'minute', 1 => 'second');
    foreach ($a as $secs => $str) {$d = $etime / $secs;
        if ($d >= 1){$r = round($d); return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';}
    }
}

$post_reward = '0.35';

$author_reward = '0.35';
$curator_reward = '0.30';
$affiliate_reward = '0.05';
$airdrop_reward = '0.05';
$staking_reward = '0.2';
$charity_reward = '0.01';
$dao_reward = '0.025';
$team_reward = '0.04';
$foundation_reward = '0.025';

$max_withdraw_limit = '5000';
$no_of_staking_rewards = '200';

$tron_contract = "TMw4Er1ZVMm6Z4QnE4fqU6xzT4G43HapWb";

$dlike_charity_acc="TCwS1TPfHvF1aL9BxvXMvp8mKcJr4fnP5x";
$dlike_daf_acc="TWTXTvXctXP7cP379nGMeEofGHiH42tstU";
$dlike_team_acc="TZFX4pbMV2Gb9qVrneT2z6FvRY6R7UjiZp";
$dlike_foundation_acc="TR8e71omi84YpJJNzDSShGvbNmeWcBVGDm";
$dlike_airdrop_acc="TPHiKY8sswCuD9wy1s6XM5C6e3R1iJnCqP";

$restricted_urls = array("dlike.io","steemit.com","wikipedia.org","facebook.com","youtube.com", "pinterest.com","twitter.com","bloomberg.com","youtu.be", "peakd.com", "steempeak.com", "hive.blog", "blurt.world","pornhub.com","youporn.com","airdroprating.io","playboy.com","icomarks.com","icobench.com","airdrops.io","airdropalert.com");
?>