<?php


//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}
echo $ip = ip2long($ip);
echo '<br>';
echo $ip = sprintf('%u', ip2long($_SERVER['REMOTE_ADDR']));
echo '<br>';
echo $ip = long2ip('3065685839');


?>
