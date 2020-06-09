<?php
if (!isset($_COOKIE['dlike_username']) || !$_COOKIE['dlike_username']) {
    die('<script>window.location.replace("https://dlike.io/share","_self")</script>');
} else {
    $user_wallet = $_COOKIE['dlike_username'];
}

echo $user_wallet;

?>