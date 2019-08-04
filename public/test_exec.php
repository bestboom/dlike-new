<?
$user = 'fanfeox';
$here = dirname(__FILE__);
echo "here: $here\n";
$cmd = "/app/.heroku/node/bin/node {$here}/js/newAccount.js {$user}";
echo "cmd: $cmd\n";
$output = shell_exec($cmd); 
echo $output;
?>
