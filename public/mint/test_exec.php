<?php
$user = 'fanfeox';
$here = dirname(__FILE__);
echo "here: $here\n";
$cmd = "node {$here}/js/newAccounts.js \"{$user}\"";
echo "cmd: $cmd\n";
$output = shell_exec($cmd); 
echo $output;

?>