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

if (isset($_POST["post_permlink"]) && isset($_POST["post_author"])){

	$parent_permlink = validator($_POST["post_permlink"]);
	$parent_author = validator($_POST["post_author"]);

	$permlink = validator($_POST["cmt_permlink"]);
	$body = $_POST["cmt_body"];
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
    $state = $cmtGenerator->broadcast($publish);
	}

	if (isset($state->result)) { ?>
    <script type="text/javascript">
        location.reload();
    </script>
<? 	} else {
		echo $state->error_description;
	} 

} else {die('Some error');}
?>