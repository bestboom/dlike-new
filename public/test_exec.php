<?
$user = 'fanfeox';
echo $here = dirname(__FILE__);
$cmd = "/app/.heroku/node/bin/node {$here}/js/newAccount.js {$user}";
echo $state = shell_exec($cmd); 
?>
