<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../helper/publish_profile_update.php";
$profileGenerator = new dlike\updateProfile\makeProfile();
function validator($data){
    return htmlspecialchars(strip_tags(trim($data)));
}
$response = [];
//if (isset($_POST["profname"])) {

    echo $username = $_COOKIE['username'];
    $about = 'its me certseek';
    $name = 'certit';
    $website = 'https://dnom.io/';
    $profile_image = 'https://dnom.io/special/dnom-icon.png';
    $location = 'DLIKE';

        $_json = ["profile", [
                    "name" => $name,
                    "about" => $about,
                    "website" => $website,
                    "profile_image" => $profile_image,
                    "location" => $location
                ]];
        //if (!empty($username) && ($username != $follower )){
        //https://github.com/steemit/steem-js/issues/165  

        $publish = $profileGenerator->upProfile($username, $_json);
        $state = $profileGenerator->broadcast($publish);

            if (isset($state->error)){
                $response["status"] = false;
                $response["message"] = $state->error_description;  
                echo json_encode($response);die;  
                 
            }else{   
                $response["status"] = true;
                $response["message"] = "You updated Successfully";  
                echo json_encode($response);die;      
            }    
         
        //}

//} else {die('Invalid Data');}
?>