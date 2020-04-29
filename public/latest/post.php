<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../template/header6.php'); 
$ipInfo = file_get_contents('http://ip-api.com/json/' . $thisip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
echo $mytimezone =  date_default_timezone_get();

echo $link = $_GET['link'];
?>

