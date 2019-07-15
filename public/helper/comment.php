<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_comment.php";
include('../functions/main.php');

$cmtGenerator = new dlike\comment\makeComment();

function validator($data){
    return htmlspecialchars(strip_tags($data));
}

if (isset($_POST["p_permlink"]) && isset($_POST["p_author"])){

	$parent_permlink = $_POST["p_permlink"];
	$parent_author = $_POST["p_author"];

	$permlink = $_POST["cmt_permlink"];

	$body = $_POST["comt_body"];

	$max_accepted_payout = '900.000 SBD';
	$_POST['benefactor'] = "dlike:9,dlike.fund:1";

	$json_metadata = [
    "community" => "dlike",
    "app" => "dlike/2",
    "format" => "html",
    "tags" => "dlike"
	];


	if (empty($errors)) {
    $publish = $cmtGenerator->createComment($parent_author, $parent_permlink, $body, $json_metadata, $permlink, genBeneficiaries($_POST['benefactor']), $max_accepted_payout);
    echo $state = $cmtGenerator->broadcast($publish);
	}

	if (isset($state->result)) { 
		die(json_encode([
			'error' => false,
            'message' => 'All fine', 
            'data' => 'Commenting'
        ]));  				
	} else {
			    die(json_encode([
            		'error' => true,
            		'message' => 'Sorry', 
            		'data' => 'There is some issue '. $state->error_description
        		]));
	} 	

} else {die('Some error');}
?>