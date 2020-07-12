<?php 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require '../includes/config.php';

//if (isset($_POST['profname'])  && $_POST['profname'] != '') { 

	$p_name = trim(mysqli_real_escape_string($_POST["p_name"]));
	$p_img = trim(mysqli_real_escape_string($_POST["p_img"]));
	$p_cover_img = trim(mysqli_real_escape_string($_POST["p_cover_img"]));
	$p_location = trim(mysqli_real_escape_string($_POST["p_location"]));
	$p_website = trim(mysqli_real_escape_string($_POST["p_website"]));
	$p_about = trim(mysqli_real_escape_string($_POST["p_about"]));
	$profname = trim(mysqli_real_escape_string($_POST["profname"]));

	$dlike_username = $_COOKIE['dlike_username'];

	if($dlike_username != $profname){
        $errors = "Some issue in profile updating. Please Try later";
    }

    if (empty($errors)) {
		$update_p = $conn->query("UPDATE dlikeaccounts SET full_name = '$p_name', profile_pic = '$p_img', profile_banner = '$p_cover_img', location = '$p_location', website = '$p_website', about = '$p_about' WHERE username = '$dlike_username'");
			if ($update_p === TRUE) {
	    		die(json_encode(['error' => false,'message' => 'Profile updated successfully!']));
			} else {
			    die(json_encode(['error' => true,'message' => 'Issue in updating. Please try later'])); 
			}
    } else { die(json_encode(['error' => true,'message' => $errors]));}
//} else {die('Some error');}

?>