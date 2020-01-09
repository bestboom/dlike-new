<?php

$post_url = "https://steemd.minnowsupportproject.org/get_content?author=dlike&permlink=dlike-weekly-report-72-dliker-token-details";
$response = file_get_contents($post_url);
$result = json_decode($response);
$og_description = explode("\n\n#####\n\n",$result->body);
$og_description = $og_description[1];
echo $og_title = $result->title;
function removeTags($str) {  
	$str = preg_replace("#<(.*)/(.*)>#iUs", "", $str);
	return $str;
}
$og_description = removeTags($og_description);
$meta_data = json_decode($result->json_metadata);
echo $og_image = $meta_data->image;
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo $og_url = $uri;

echo "aq";
?>