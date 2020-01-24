<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$link = "dlike-affiliate-program-dlike-staking-rewards-and-dliker-delegations-for-pro-users";
$user = "dlike";
$post_url = "https://tower.emrebeyler.me/api/v1/posts/?author=$user&permlink=$link";


$response = file_get_contents($post_url);
$result = json_decode($response, TRUE);

function removeTags($str) {  
	$str = preg_replace("#<(.*)/(.*)>#iUs", "", $str);
	return $str;
}
$og_res = $result['results'][0];
print_r($og_res);
echo '<br>';
echo '<br>';
echo '<br>';
echo $og_title = $result['results'][0]['title'];
echo '<br>';
echo '<br>';
echo 'second title';
echo $og_title = $og_res['title']; 
echo '<br>';
echo '<br>';
echo 'description';
echo '<br>';
$og_description = explode("\n\n#####\n\n",$og_res['body']);
//$og_description = $og_description[1];
echo $og_description = removeTags($og_description);
//echo $og_description = implode(' ', array_slice(explode(' ', $og_description), 0, 23));



//$pending_amount = ($result['DLIKER']['pending_token'])/1000;


//$response = file_get_contents($post_url);
//$result = json_decode($response);
//$og_description = explode("\n\n#####\n\n",$result->body);
//$og_description = $og_description[1];
//echo $og_title = $result->title;

//echo $og_description = removeTags($og_description);

echo '<br>';
echo 'image here';
$meta_data = $result['results'][0]['json'];
$meta_data = json_decode($meta_data, true);
print_r($meta_data);
echo '<br>';
echo '<br>';
echo $og_image = $meta_data->image;
echo 'or this works';
echo $og_image = $meta_data['image'];
echo '<br>';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo $og_url = $uri;

echo "aq";

?>