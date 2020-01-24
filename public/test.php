<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$link = $_GET['link'];
$user = $_GET['user'];
$auth = str_replace('@', '', $user);

$post_url = "https://tower.emrebeyler.me/api/v1/posts/?author=$user&permlink=$link";


$response = file_get_contents($post_url);
$result = json_decode($response, TRUE);


$og_res = $result['results'][0];
echo $og_title = $og_res['title']; 
echo '<br>';
echo 'description';
echo '<br>';
$body = $og_res['body'];
$og_description = explode("\n\n#####\n\n",$body);
$og_description = $og_description[0];
$og_description = str_replace(array('\'', '"'), '', $og_description); 
$og_description = strip_tags($og_description);
$og_description = implode(' ', array_slice(explode(' ', $og_description), 0, 23));
echo $og_description;

echo '<br>';
echo 'image here';
echo '<br>';
$meta_data = $result['results'][0]['json'];
$metadata = json_decode($meta_data, TRUE);
echo $og_image = $metadata['image'][0];
echo '<br>';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$uri = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
echo $og_url = $uri;

echo '<br>';
echo '<br>';

?>