<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(0);
        require '../includes/config.php';


	if(isset($_POST['tag']) && $_POST['tag'] == "ads"){
			$ad_html = base64_encode($_POST['ad_html']);
		    $status = $_POST['status'];
			if(isset($_POST['a_id']) && !empty($_POST['a_id'])){
				 $ads = "UPDATE `ads` set `ad_html`= '".$ad_html."', `status`='".$status."' WHERE `id`= '".$_POST['a_id']."'";
				 $ads_q = $conn->query($ads);  
				 $strReturn['status'] = 'OK';
                 $strReturn['message'] = 'successfully updated.';
				 echo json_encode($strReturn);die;
			}
			else {
				$ads = "INSERT INTO `ads` (`ad_html`,`status`,`created_at`) VALUES ('".$ad_html."', '".$status."','".date("Y-m-d H:i:s")."')";
				$ads_q = $conn->query($ads);
				header("Location:/adminage/ads.php");    
			}
            

        }

        if(isset($_POST['tag']) && $_POST['tag'] == "events"){
            $file_name = $_POST['upload'];
            $title = $_POST['title'];
            $tags = $_POST['tags'];
            
            $events = "INSERT INTO events (`title`,`image`, `tags`,`created_at`) VALUES ('".$title."', '".$file_name."', '".$tags."','".date("Y-m-d H:i:s")."')";
            $events_q = $conn->query($events);
            header("Location:/adminage/events.php");

        }
        if(isset($_POST['tag']) && $_POST['tag'] == "settings"){
                if(isset($_POST['type']) && $_POST['type'] == "events"){
                        $s_sql = "SELECT * FROM `settings` where `type` = 'events'";
			$result_s = $conn->query($s_sql);
			if ($result_s->num_rows > 0) {
                                $events = "UPDATE settings set `options`= '".$_POST['option']."' WHERE `type`= 'events'";
                                $events_q = $conn->query($events);  
                        }
                        else {
                                $events = "INSERT INTO settings (`type`,`options`,`created_at`) VALUES ('".$_POST['type']."', '".$_POST['option']."','".date("Y-m-d H:i:s")."')";
                                $events_q = $conn->query($events);          
                        }
                        
                        $strReturn['status'] = 'OK';
                        $strReturn['message'] = 'successfully updated.';
                        
                }
                echo json_encode($strReturn);die;
        }
        
?>
