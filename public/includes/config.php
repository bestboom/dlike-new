<?php
session_start();

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
echo $ipst = long2ip($ip);
echo '<br>';
echo $_SESSION['token'] = sha1($ip);

echo '<br>';


if(!isset($_COOKIE[token])) {
    echo "Cookie named '" . token . "' is not set!";
  setcookie('token', $_SESSION['token'], time() + (86400 * 30), "/");
} else {
    echo "Cookie '" . token . "' is set!<br>";
    echo "Value is: " . $_COOKIE[token];
}




?>
