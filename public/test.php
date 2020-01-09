<?php

$post_url = "https://steemd.minnowsupportproject.org/get_content?author=dlike&permlink=dlike-weekly-report-72-dliker-token-details";
$response = file_get_contents($post_url);
$result = json_decode($response);
$og_description = explode("\n\n#####\n\n",$result->body);
$og_description = $og_description[1];
echo $og_title = $result->title;
?>