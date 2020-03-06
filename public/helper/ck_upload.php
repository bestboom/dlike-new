<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo $_SERVER['DOCUMENT_ROOT'];
echo '<br>';
echo $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
echo '<br>';
echo $_SERVER['DOCUMENT_ROOT'].'/../vendor/autoload.php';
echo '<br>';
echo $_SERVER['DOCUMENT_ROOT'].'/helper/image_upload/B2.php';
echo '<br>';

require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/helper/image_upload/B2.php";

$appKeyId = "00063e4beabebed0000000003"; 
$appKey = "K000SsnlbgCLwONCLR5SH7GByCBHGy4"; 
$bucketId = "56b36e641bbeaabb7e0b0e1d"; 

use b2cloud\B2 as B2Client;
$b2 = new B2Client($appKeyId, $appKey, $bucketId);


define('PTK_URL', 'https://img.imageduck.org/file/dlktest/dlike/');
define('PTK_FNAME_SIZE', 7);

$ptk=array("uploaded"=>false);

//define('PTK_FILES', '../upload/');
//if (!file_exists('../upload')) {
//    mkdir('../upload', 0777, true);
//}


$limited_ext = array(".jpg",".jpeg",".png",".gif",".bmp");
$limited_type = array("image/jpg","image/jpeg","image/png","image/gif","image/bmp");
$not_allowed = array(".php", ".exe", ".zip", ".rar", ".js", ".txt", ".css", ".html", ".htm", ".doc", ".docx");

$nameUpload = strtolower(basename($_FILES['upload']['name']));
$typeUpload = strtolower($_FILES['upload']['type']);
$ptk['name']=$nameUpload;
$ptk['type']=$typeUpload;

if( isset($_FILES['upload']) && strlen($nameUpload) > 1 ) {
    
    if ( in_array($typeUpload,$limited_type) ) {
        if( $_FILES['upload']['size'] > 0 ) {
            $check = getimagesize($_FILES["upload"]["tmp_name"]);
            if( $check !== false && in_array($check['mime'],$limited_type) ) {
                $notAllowFlag = 0;
                foreach( $not_allowed as $notAllow ) {
                    $pos = strpos($nameUpload, $notAllow);
                    if( $pos !== false ) {
                        $notAllowFlag = 1;
                        $ptk['error']=array('message'=>'Restricted file type');    
                    }
                }
                if( $notAllowFlag == 0 ) {
                    $ext = strrchr($nameUpload,'.');
                    if ( in_array($ext,$limited_ext) ) {
                       
                        $uploadurl  = PTK_URL;
                        $ptk['uploadurl']=$uploadurl;
                        

                        //$uploaddir  =  PTK_FILES; //$uploaddir set permission 777 (unix)
                        //$ptk['uploaddir']=$uploaddir;

                        $randonname = getRandomName(PTK_FNAME_SIZE);
                        $new_file_name = $randonname . '-' . $ptk['name'];

                        //$new_file_name = getRandomName(PTK_FNAME_SIZE) . $ext;
                        //while ( is_file( $uploaddir . $new_file_name) ) {
                            //$new_file_name = getRandomName(PTK_FNAME_SIZE)-$ptk['name'] . $ext;
                        //    $new_file_name = $randonname . '-' . $ptk['name'];
                        //}
                        
                        $ptk['new_file_name']=$new_file_name;
                        //$new_file_name_full=$uploaddir . $new_file_name;
                        //$ptk['new_file_name_full']=$new_file_name_full;

                        $fileit = $_FILES['upload']['tmp_name'];

                        try {
                            $uploadbb = $b2->store($fileit, "/dlike/",  $new_file_name);
                        } catch (\Exception $e) {
                            echo $e->getMessage();
                            //exit;
                        }

                        // Process the response
                        // $upload is an instance of a guzzlehttp client request.
                        $response = json_decode($uploadbb->getBody());

                        // Get response code
                        $responseCode = $uploadbb->getStatusCode();

                        // Get remote file name
                        $remoteFilename = $response->fileName;

                        // Get file ID
                        $fileId = $response->fileId;

                        // Check upload status
                        // Backblaze returns 200, but this should really be 201
                        if ($responseCode == 200) {
                        //    echo 'Upload successful';
                        //} else {
                        //    echo 'Upload failed';
                        //}

                        //if ( move_uploaded_file($_FILES['upload']['tmp_name'], $new_file_name_full) ) {
                            $url = $uploadurl . $new_file_name;
                            $ptk['url']=$url;
                            $ptk["uploaded"]=true;
                        } else {
                            $ptk['error']=array('message'=>'Unable to upload the file' .$error);
                       }
                    } else {
                        $ptk['error']=array('message'=>'Please select an allowed files ( JPG, PNG, GIF, BMP)...');
                    }
                } else {
                        $ptk['error']=array('message'=>'Please select an allowed files ( JPG, PNG, GIF, BMP)...');
               }
            } else {
                        $ptk['error']=array('message'=>'Please select an allowed files ( JPG, PNG, GIF, BMP)...');
            }   
        } else {
                        $ptk['error']=array('message'=>'File size cannot be null!');
        }
    } else {
                            $ptk['error']=array('message'=>'Please select an allowed files ( JPG, PNG, GIF, BMP)...');
    }
} else {
    $ptk['error']=array('message'=>'Unexpected error');
}
echo json_encode($ptk);
?>
<?
function randomizer($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; 
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; 
    $bits = (int) $log + 1;
    $filter = (int) (1 << $bits) - 1;
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter;
    } while ($rnd > $range);
    return $min + $rnd;
}

function getRandomName($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); 

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[randomizer(0, $max-1)];
    }

    return $token;
}
?>