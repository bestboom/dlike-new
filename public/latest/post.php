<?php
include('../template/header5.php'); 
$ipInfo = file_get_contents('http://ip-api.com/json/' . $thisip);
$ipInfo = json_decode($ipInfo);
$timezone = $ipInfo->timezone;
date_default_timezone_set($timezone);
echo $mytimezone =  date_default_timezone_get();
?>