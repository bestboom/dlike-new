<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(0);
        require '../includes/config.php';
        if(isset($_POST['tag']) && $_POST['tag'] == "events"){
            $file_name = $_POST['upload'];
            $title = $_POST['title'];
            $tags = $_POST['tags'];
            
            $events = "INSERT INTO events (`title`,`image`, `tags`,`created_at`) VALUES ('".$title."', '".$file_name."', '".$tags."','".date("Y-m-d H:i:s")."')";
            $events_q = $conn->query($events);
            header("Location:/adminage/events.php");

        }
        if(isset($_POST['tag']) && $_POST['tag'] == "settings"){
                if(isset($_POST['type']) && $_POST['type'] == "settings"){
                        $events = "INSERT INTO settings (`type`,`options`,`created_at`) VALUES ('".$_POST['type']."', '".$_POST['option']."','".date("Y-m-d H:i:s")."')";
                        $events_q = $conn->query($events);  
                        $strReturn['status'] = 'OK';
                        $strReturn['message'] = 'successfully updated.';
                }
                
        }
        
?>
