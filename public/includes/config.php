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


if(!isset($_COOKIE['usertoken'])) {
	echo 'not set';
  setcookie('usertoken', $_SESSION['usertoken'], time() + (86400 * 30), "/");
} else {
    echo "Cookie is set";
    echo $_COOKIE['usertoken'];
}


?>
