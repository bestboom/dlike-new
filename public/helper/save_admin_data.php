<?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        require '../includes/config.php';
        if(isset($_POST['tag']) && $_POST['tag'] == "events"){
            if(!is_dir("/Uploads/events/")) {
                mkdir("/Uploads/events/", 0777);
            }
                

            // Move the uploaded file
            move_uploaded_file($_FILES["upload"]["tmp_name"], "/images/others/". "e_".$_FILES["upload"]["name"]);
die;
            $file_name = "Uploads/events/". $_FILES["upload"]["name"];
            $title = $_POST['title'];
            $tags = $_POST['tags'];
            
            $events = "INSERT INTO events (`title`,`image`, `tags`,`created_at`) VALUES ('".$title."', '".$file_name."', '".$tags."','".date("Y-m-d H:i:s")."')";
            $events_q = $conn->query($events);
            header("Location:/adminage/events.php");

        }
        
?>
