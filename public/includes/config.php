<?php
session_start();

$privkey=getenv('privkey');
$hashkey=getenv('hashkey');

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
echo $_SESSION['usertoken'] = $ip;

echo '<br>';


if(!isset($_COOKIE[usertoken])) {
	echo 'not set';
  setcookie('usertoken', $_SESSION['usertoken'], time() + (86400 * 30), "/");
} else {
    echo "Cookie is set";
    echo $_COOKIE[usertoken];
}




?>
